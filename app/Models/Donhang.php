<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_donhang',
        'id_user',
        'id_trangthai',
        'id_size',
        'id_color',
        'tong',
    ];
    protected $primaryKey = 'id_donhang'; // Đặt khóa chính là id_donhang

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function trangthais()
    {
        return $this->belongsTo(Trangthai::class, 'id_trangthai');
    }
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'id_sanpham', 'id_sanpham');
    }
    public function trangthaiDonHangs()
    {
        return $this->hasMany(TrangThaiDonHang::class, 'id_donhang');
    }
    public function ctdh()
    {
        return $this->hasMany(Chitietdonghang::class, 'id_donhang', 'id_donhang');
    }
    public function chitietdonghangs()
    {
        return $this->hasMany(Chitietdonghang::class, 'id_donhang');
    }
    public function sizes()
    {
        return $this->hasMany(Size::class, 'id_size');
    }

    public function colors()
    {
        return $this->hasMany(Color::class, 'id_color');
    }

}
