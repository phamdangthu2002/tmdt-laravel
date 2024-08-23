<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_slider';

    protected $fillable = [
        'name',
        'url',
        'hinhanh',
        'sort_by',
        'trangthai',
    ];
}
