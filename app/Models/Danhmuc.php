<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'danhmucs';

    // Cột khóa chính
    protected $primaryKey = 'id_danhmuc';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'tendanhmuc',
        'mota',
        'hinhanh',
        'slug',
        'trangthai',
    ];

    // Nếu bạn không sử dụng timestamps
    public $timestamps = true; // Thay đổi thành false nếu không sử dụng timestamps
    public function sanphams()
    {
        return $this->hasMany(Sanpham::class, 'id_danhmuc', 'id_danhmuc');
    }
}
