<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trangthaidonhang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_donhang',
        'id_trangthai',
        'ngaycapnhat',
    ];


    protected $primaryKey = 'id_trangdonhang';


    public function trangthai()
    {
        return $this->belongsTo(TrangThai::class, 'id_trangthai');
    }

}
