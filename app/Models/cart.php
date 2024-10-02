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
        'id_size',
        'id_color',
        'quantity',
        'gia',
        'dadathang',
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

    // Quan hệ với model Size (Kích thước)
    public function size()
    {
        return $this->belongsTo(Size::class, 'id_size');
    }
    // Quan hệ với model Size (Kích thước)
    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color');
    }
}
