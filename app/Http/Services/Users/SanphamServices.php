<?php
namespace App\Http\Services\Users;

use App\Models\Sanpham;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class SanphamServices
{
    const LIMIT = 8;
    public function __construct()
    {

    }
    public function get($page = null)
    {
        return Sanpham::select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh', 'trangthai')
            ->orderByDesc('id_sanpham')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function getProductByDanhmuc($menus, $request)
    {
        $query = $menus->sanphams()
            ->select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh')
            ->where('trangthai', 1);
        if ($request->input('gia')) {
            $query->orderBy('gia', $request->input('gia'));
        }
        return $query->orderByDesc('id_sanpham')->paginate()->withQueryString();
    }
    public function getProductByDanhmucCon($menus, $request)
    {
        return $menus->sanphamcons()
            ->select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh')
            ->where('trangthai', 1)
            ->orderByDesc('id_sanpham')
            ->paginate()->withQueryString();
    }
    public function showSanpham($id)
    {
        return Sanpham::where('id_sanpham', $id)
            ->where('trangthai', 1)
            ->with('danhmuc')
            ->firstOrFail();
    }

    public function more($id)
    {
        return Sanpham::select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh', 'trangthai')
            ->where('trangthai', 1)
            ->where('id_sanpham', '!=', $id)
            ->orderByDesc('id_sanpham')
            ->limit(4)
            ->get();
    }

    // public function add_cart($request)
    // {
    //     // Lấy thông tin từ request
    //     $id_sanpham = (int) $request->input('id_sanpham');
    //     $color = (string) $request->input('color');
    //     $size = (string) $request->input('size');
    //     $quantity = (int) $request->input('quantity');

    //     // Kiểm tra dữ liệu đầu vào
    //     if ($id_sanpham <= 0) {
    //         Session::flash('error', 'Lỗi sản phẩm không hợp lệ.');
    //         return false;
    //     }
    //     if (empty($size)) {
    //         Session::flash('error', 'Vui lòng chọn kích thước.');
    //         return false;
    //     }
    //     if (empty($color)) {
    //         Session::flash('error', 'Vui lòng chọn màu sắc.');
    //         return false;
    //     }
    //     if ($quantity <= 0) {
    //         Session::flash('error', 'Vui lòng chọn số lượng.');
    //         return false;
    //     }

    //     // Lấy giỏ hàng từ session, nếu chưa có thì tạo mảng rỗng
    //     $giohang = Session::get('giohang');
    //     $new_giohang = [
    //         $id_sanpham => [
    //             'id_sanpham' => $id_sanpham,
    //             'size' => $size,
    //             'color' => $color,
    //             'quantity' => $quantity
    //         ]
    //     ];

    //     if (is_null($giohang)) {
    //         Session::put('giohang', [
    //             $id_sanpham => $new_giohang,
    //         ]);
    //         return true;
    //     }
    //     $exists = Arr::exists($giohang, $id_sanpham);

    //     if ($exists) {

    //         $quantityNew = $giohang[$id_sanpham]['quantity'] += $quantity;
    //         Session::put('giohang', [
    //             $id_sanpham => $quantityNew,
    //         ]);
    //     }
    //     // Kiểm tra kết quả
    //     dd($giohang);
    // }
    public function add_cart($request)
    {
        // Lấy thông tin từ request
        $id_sanpham = (int) $request->input('id_sanpham');
        $color = (string) $request->input('color');
        $size = (string) $request->input('size');
        $quantity = (int) $request->input('quantity');

        // Kiểm tra dữ liệu đầu vào
        if ($id_sanpham <= 0) {
            Session::flash('error', 'Lỗi sản phẩm không hợp lệ.');
            return false;
        }
        if (empty($size)) {
            Session::flash('error', 'Vui lòng chọn kích thước.');
            return false;
        }
        if (empty($color)) {
            Session::flash('error', 'Vui lòng chọn màu sắc.');
            return false;
        }
        if ($quantity <= 0) {
            Session::flash('error', 'Vui lòng chọn số lượng.');
            return false;
        }

        // Lấy giỏ hàng từ session, nếu chưa có thì tạo mảng rỗng
        $giohang = Session::get('giohang', []);

        // Tạo một mục giỏ hàng mới
        $new_giohang = [
            'id_sanpham' => $id_sanpham,
            'size' => $size,
            'color' => $color,
            'quantity' => $quantity
        ];

        if (is_null($giohang)) {
            // Nếu giỏ hàng chưa có, thêm sản phẩm mới vào giỏ hàng
            $giohang = [
                $id_sanpham => $new_giohang
            ];
        } else {
            // Nếu sản phẩm đã có trong giỏ hàng
            if (isset($giohang[$id_sanpham])) {
                // Cập nhật số lượng của sản phẩm
                $giohang[$id_sanpham]['quantity'] = $quantity;
                $giohang[$id_sanpham]['color'] = $color;
                $giohang[$id_sanpham]['size'] = $size;
            } else {
                // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
                $giohang[$id_sanpham] = $new_giohang;
            }
        }
        // dd($giohang);
        // Cập nhật giỏ hàng trong session
        Session::put('giohang', $giohang);
    }
    public function show_cart()
    {
        $giohang = Session::get('giohang');
        if (is_null($giohang))
            return [];

        $id_sanpham = array_keys($giohang);
        return Sanpham::select('id_sanpham', 'tensanpham', 'hinhanh', 'mota', 'motachitiet', 'gia', 'sale')
            ->where('trangthai', 1)
            ->whereIn('id_sanpham', $id_sanpham)
            ->get();
    }
    public function update($request)
    {
        Session::put('giohang', $request->input('quantity_product'));
        return true;
    }
}