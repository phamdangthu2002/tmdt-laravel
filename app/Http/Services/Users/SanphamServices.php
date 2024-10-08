<?php
namespace App\Http\Services\Users;

use App\Models\Anhsp;
use App\Models\Sanpham;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class SanphamServices
{
    const LIMIT = 8;
    public function __construct()
    {

    }
    public function random()
    {
        $LIMIT = 4;
        $sanpham = Sanpham::where('trangthai', 1)->get();
        $random = $sanpham->random($LIMIT);
        return $random;
    }
    public function getAll($page = null)
    {
        return Sanpham::select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh', 'trangthai', 'created_at')
            ->orderByDesc('id_sanpham')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function getSale($page = null)
    {
        return Sanpham::select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh', 'trangthai', 'created_at')
            ->whereNotNull('sale') // Kiểm tra trường 'sale' không phải là null
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

    public function update($request)
    {
        Session::put('giohang', $request->input('quantity_product'));
        return true;
    }

    public function getAnhID($id)
    {
        return Anhsp::where('id_sanpham', $id)->get();
    }

    public function getByDanhmuc($id_danhmuc, $currentProductId)
    {
        return Sanpham::select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh', 'trangthai')
            ->where('id_danhmuc', $id_danhmuc)
            ->where('id_sanpham', '!=', $currentProductId) // Không lấy sản phẩm hiện tại
            ->where('trangthai', 1)
            ->orderByDesc('id_sanpham')
            ->take(4)
            ->get();
    }
}