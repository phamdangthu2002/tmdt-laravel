<?php
namespace App\Http\Services\Danhmuccon;

use App\Models\DanhmucCon;

class DanhmucConServices
{
    public function create($danhmucFormRequest)
    {
        try {
            DanhmucCon::create([
                'id_danhmuc' => $danhmucFormRequest->input('id_danhmuc'),
                'tendanhmuccon' => (string) $danhmucFormRequest->input('categoryName'),
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
        $danhmucs = DanhmucCon::orderByDesc('id_danhmuccon')->paginate(15);
        return $danhmucs;
    }
    public function getAllDanhmuc()
    {
        $danhmucs = DanhmucCon::all();
        return $danhmucs;
    }
    
    public function delete($id_danhmuccon)
    {
        $danhmucs = DanhmucCon::where('id_danhmuccon', $id_danhmuccon)->firstOrFail()->delete();
        return $danhmucs;
    }

    public function getDanhmucById($id_danhmuccon)
    {
        // Tìm danh mục với trạng thái 1 và id_danhmuccon tương ứng
        $danhmuc = DanhmucCon::where('id_danhmuccon', $id_danhmuccon)->first();

        return $danhmuc;
    }
    public function update($request, $id_danhmuccon)
    {
        // Tìm danh mục cần cập nhật
        $danhmuc = DanhmucCon::find($id_danhmuccon);

        // Kiểm tra xem danh mục có tồn tại không
        if (!$danhmuc) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // Cập nhật thông tin danh mục
        $danhmuc->id_danhmuc = $request->input('id_danhmuccon');
        $danhmuc->tendanhmuccon = $request->input('categoryName');
        $danhmuc->trangthai = $request->input('categoryStatus');
        $danhmuc->mota = $request->input('categoryDescription', ''); // Nếu không có mô tả thì để rỗng

        // Lưu lại thay đổi
        $danhmuc->save();
    }
}