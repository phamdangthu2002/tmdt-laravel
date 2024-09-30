<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_color';

    protected $fillable = [
        'tencolor',
    ];
}