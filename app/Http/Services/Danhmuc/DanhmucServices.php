<?php
namespace App\Http\Services\Danhmuc;

use App\Models\Danhmuc;

class DanhmucServices
{
    public function create($danhmucFormRequest)
    {
        try {
            Danhmuc::create([
                'tendanhmuc' => (string) $danhmucFormRequest->input('categoryName'),
                'mota' => (string) $danhmucFormRequest->input('categoryDescription'),
                'trangthai' => (int) $danhmucFormRequest->input('categoryStatus'), // Chuyển đổi thành số nguyên
            ]);
            session()->flash('success', 'Thêm danh mục thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Thêm danh mục thất bại: ' . $e->getMessage());
            return false;
        }
        return true;
    }
    public function showAllDanhmuc()
    {
        $danhmucs = Danhmuc::all();
        return $danhmucs;
    }
    public function delete($id_danhmuc)
    {
        $danhmucs = Danhmuc::where('id_danhmuc', $id_danhmuc)->firstOrFail()->delete();
        return $danhmucs;
    }

    public function getDanhmucById($id_danhmuc)
    {
        // Tìm danh mục với trạng thái 1 và id_danhmuc tương ứng
        $danhmuc = Danhmuc::where('id_danhmuc', $id_danhmuc)->first();

        if ($danhmuc) {
            return $danhmuc;
        } else {
            // Xử lý khi không tìm thấy danh mục
            return null; // Hoặc bạn có thể ném một ngoại lệ hoặc trả về thông báo lỗi
        }
    }
    public function update($request, $id_danhmuc)
    {
        // Tìm danh mục cần cập nhật
        $danhmuc = Danhmuc::find($id_danhmuc);

        // Kiểm tra xem danh mục có tồn tại không
        if (!$danhmuc) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // Cập nhật thông tin danh mục
        $danhmuc->tendanhmuc = $request->input('categoryName');
        $danhmuc->trangthai = $request->input('categoryStatus');
        $danhmuc->mota = $request->input('categoryDescription', ''); // Nếu không có mô tả thì để rỗng

        // Lưu lại thay đổi
        $danhmuc->save();
    }


}