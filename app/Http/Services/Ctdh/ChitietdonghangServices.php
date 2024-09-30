<?php
namespace App\Http\Services\Ctdh;

use App\Models\Chitietdonghang;

class ChitietdonghangServices
{
    public function getCart()
    {
        return Chitietdonghang::all();
    }

    public function getDonhangById($id)
    {
        return Chitietdonghang::where('id_donhang', $id)
            ->with('sanpham') // Lấy thông tin sản phẩm liên quan
            ->get();
    }

}