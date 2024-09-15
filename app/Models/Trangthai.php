<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trangthai extends Model
{
    use HasFactory;
    protected $fillable = [
        'tentrangthai',
        'mota',
    ];
    protected $primaryKey = 'id_trangthai';

    public function donhangs()
    {
        return $this->hasMany(Donhang::class, 'id_trangthai');
    }
}
