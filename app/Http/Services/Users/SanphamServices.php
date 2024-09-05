<?php
namespace App\Http\Services\Users;

use App\Models\Sanpham;

class SanphamServices
{
    const LIMIT = 12;
    public function __construct()
    {

    }
    public function get()
    {
        return Sanpham::select('id_sanpham', 'tensanpham', 'mota', 'id_danhmuc', 'gia', 'sale', 'hinhanh', 'trangthai')->orderByDesc('id_sanpham')->limit(self::LIMIT)->get();
    }
}