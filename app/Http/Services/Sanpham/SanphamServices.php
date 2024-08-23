<?php
namespace App\Http\Services\Sanpham;

use App\Models\Sanpham;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SanphamServices
{
    public function __construct()
    {

    }
    public function getByidsanpham($id_sanpham)
    {
        $sanpham = Sanpham::with('danhmuc')->where('id_sanpham', $id_sanpham)->first();
        return $sanpham;
    }
    public function getAll()
    {
        return Sanpham::with('danhmuc')->orderByDesc('id_sanpham')->paginate(15);
    }
    protected function kiemtraGia($sanphamRequest)
    {
        if ($sanphamRequest->input('gia') != 0 && $sanphamRequest->input('sale') != 0 && $sanphamRequest->input('sale') >= $sanphamRequest->input('gia')) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if ($sanphamRequest->input('sale') != 0 && (int) $sanphamRequest->input('gia') == 0) {
            Session::flash('error', 'Giá gốc không được để trống');
            return false;
        }
        return true;
    }
    public function create($sanphamRequest)
    {
        $kiemtraGia = $this->kiemtraGia($sanphamRequest);
        if ($kiemtraGia == false) {
            return false;
        }
        try {
            Sanpham::create([
                'tensanpham' => $sanphamRequest->input('tensanpham'),
                'mota' => $sanphamRequest->input('mota'),
                'id_danhmuc' => $sanphamRequest->input('id_danhmuc'),
                'gia' => $sanphamRequest->input('gia'),
                'sale' => $sanphamRequest->input('sale'),
                'soluong' => $sanphamRequest->input('soluong'),
                'trangthai' => $sanphamRequest->input('trangthai'),
                'hinhanh' => $sanphamRequest->input('file'),
            ]);
            // Sanpham::create($sanphamRequest->all());
            Session::flash('success', 'Thêm sản phẩm thành công');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function update($sanphamRequest, $id)
    {
        // Tìm danh mục cần cập nhật
        $sanpham = Sanpham::find($id);

        // Cập nhật thông tin danh mục
        $sanpham->mota = $sanphamRequest->input('mota', '');
        $sanpham->tensanpham = $sanphamRequest->input('tensanpham', '');
        $sanpham->id_danhmuc = $sanphamRequest->input('id_danhmuc', '');
        $sanpham->gia = $sanphamRequest->input('gia', '');
        $sanpham->sale = $sanphamRequest->input('sale', '');
        $sanpham->soluong = $sanphamRequest->input('soluong', '');
        $sanpham->trangthai = $sanphamRequest->input('trangthai', '');
        // Kiểm tra nếu có tệp hình ảnh mới
        if ($sanphamRequest->hasFile('file')) {
            // Lưu trữ tệp mới và cập nhật đường dẫn hình ảnh
            $sanpham->hinhanh = $sanphamRequest->file('file');
        }
        // Lưu lại thay đổi
        if ($sanpham->isDirty()) {
            $sanpham->save();
            return redirect()->back()->with('success', 'Sản phẩm đã được cập nhật.');
        } else {
            return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
        }
    }

    public function delete($id_sanpham)
    {
        $sanphams = Sanpham::where('id_sanpham', $id_sanpham)->first();
        if($sanphams){
            $sanphams->delete();
            Session::flash('success', 'Xóa sản phẩm thành công');
        }else{
            Session::flash('error', 'Xóa sản phẩm thất bại');
        }
    }
}