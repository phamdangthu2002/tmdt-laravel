<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_size';

    protected $fillable = [
        'tensize',
    ];

    // Quan hệ với model Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_size');
    }
    public function chitietdonghangs()
    {
        return $this->hasMany(Chitietdonghang::class, 'id_size');
    }
}
