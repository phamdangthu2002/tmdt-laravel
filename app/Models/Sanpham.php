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

}
