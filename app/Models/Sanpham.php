<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_sanpham',
        'tensanpham',
        'mota',
        'motachitiet',
        'id_danhmuc',
        'gia',
        'sale',
        'luotxem',
        'luotmua',
        'soluong',
        'hinhanh',
        'trangthai'
    ];
    protected $primaryKey = 'id_sanpham';  // Khai báo khóa chính

    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class, 'id_danhmuc', 'id_danhmuc');
    }
    // Quan hệ với bảng 'Anhsp' (nhiều ảnh cho một sản phẩm)
    public function anhsp()
    {
        return $this->hasMany(Anhsp::class, 'id_sanpham', 'id_sanpham');
    }
    public function donhangs()
    {
        return $this->hasMany(Donhang::class, 'id_sanpham', 'id_sanpham');
    }
}
