<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_sanpham',
        'id_user',
        'size',
        'color',
        'quantity',
        'gia',
    ];
    protected $primaryKey = 'id_giohang';

    // Quan hệ với model Sanpham (Sản phẩm)
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'id_sanpham');
    }

    // Quan hệ với model User (Người dùng)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
