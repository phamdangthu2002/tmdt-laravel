<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anhsp extends Model
{
    use HasFactory;
    protected $fillable = [
        'hinhanh',
        'id_sanpham',
    ];
    protected $primaryKey = 'id_anh';

    // Quan hệ với model Sanpham (Sản phẩm)
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'id_sanpham', 'id_sanpham');
    }
}
