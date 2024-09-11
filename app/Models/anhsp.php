<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anhsp extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_hinhanh',
        'hinhanh',
        'id_sanpham',
    ];
    // Quan hệ với model Sanpham (Sản phẩm)
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'id_sanpham', 'id_sanpham');
    }
}
