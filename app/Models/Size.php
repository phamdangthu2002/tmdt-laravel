<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_size';

    protected $fillable = [
        'tensize',
    ];
}
