<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhmucCon extends Model
{
    use HasFactory;
    protected $table = 'danhmuc_cons';

    // Cột khóa chính
    protected $primaryKey = 'id_danhmuccon';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'tendanhmuccon',
        'id_danhmuc',
        'mota',
        'slug',
        'trangthai',
    ];

    // Nếu bạn không sử dụng timestamps
    public $timestamps = true; // Thay đổi thành false nếu không sử dụng timestamps
    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class, 'id_danhmuc', 'id_danhmuc');
    }
}
