<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonghang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_donhang',
        'id_user',
        'id_sanpham',
        'soluong',
        'gia',
    ];
    protected $primaryKey = 'id_ctdh'; // Đặt khóa chính là id_donhang

    public function donhang()
    {
        return $this->belongsTo(Donhang::class, 'id_donhang', 'id_donhang');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function trangthaiDonHangs()
    {
        return $this->hasMany(TrangThaiDonHang::class, 'id_donhang');
    }

    public function trangthais()
    {
        return $this->belongsTo(Trangthai::class, 'id_trangthai');
    }
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'id_sanpham');
    }
    // Định nghĩa quan hệ với màu sắc
    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color');
    }

    // Định nghĩa quan hệ với kích thước
    public function size()
    {
        return $this->belongsTo(Size::class, 'id_size');
    }
}
