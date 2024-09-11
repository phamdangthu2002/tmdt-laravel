<?php
namespace App\Http\Services\Users;

use App\Models\anhsp;
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

    public function update($request)
    {
        Session::put('giohang', $request->input('quantity_product'));
        return true;
    }

    public function getAllAnh(){
        return anhsp::all();
    }
}