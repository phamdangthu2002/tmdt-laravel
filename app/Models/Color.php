<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_color';

    protected $fillable = [
        'tencolor',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_color');
    }
    public function chitietdonghangs()
    {
        return $this->hasMany(Chitietdonghang::class, 'id_color');
    }
}