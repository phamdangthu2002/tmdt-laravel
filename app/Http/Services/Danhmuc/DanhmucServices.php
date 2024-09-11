<?php
namespace App\Http\Services\Danhmuc;

use App\Models\Danhmuc;
use App\Models\DanhmucCon;
use Exception;
use Illuminate\Support\Facades\Log;

class DanhmucServices
{
    public function create($danhmucFormRequest)
    {
        try {
            Danhmuc::create([
                'tendanhmuc' => (string) $danhmucFormRequest->input('categoryName'),
                'mota' => (string) $danhmucFormRequest->input('categoryDescription'),
                'hinhanh' => $danhmucFormRequest->input('file'),
                'trangthai' => (int) $danhmucFormRequest->input('categoryStatus'), // Chuyển đổi thành số nguyên

            ]);
            // Danhmuc::create($danhmucFormRequest->all());
            session()->flash('success', 'Thêm danh mục thành công');
        } catch (Exception $e) {
            session()->flash('error', 'Thêm danh mục thất bại: ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function show()
    {
        $LIMIT = 3;
        $danhmucs = Danhmuc::select('id_danhmuc', 'tendanhmuc','hinhanh')->orderByDesc('id_danhmuc')->limit($LIMIT)->get();
        return $danhmucs;
    }
    public function showAllDanhmuc()
    {
        $danhmucs = Danhmuc::orderByDesc('id_danhmuc')->paginate(15);
        return $danhmucs;
    }
    public function getAllDanhmuc()
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
        $danhmuc = Danhmuc::where('id_danhmuc', $id_danhmuc)->where('trangthai', 1)->firstOrFail();
        return $danhmuc;
    }
    public function getDanhmucByIdCon($id_danhmuccon)
    {
        // Tìm danh mục với trạng thái 1 và id_danhmuc tương ứng
        $danhmuccon = DanhmucCon::where('id_danhmuccon', $id_danhmuccon)->where('trangthai', 1)->firstOrFail();
        return $danhmuccon;
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
        // Kiểm tra xem có file mới không
        if ($request->input('file')) {
            // Lấy đường dẫn file từ input ẩn
            $danhmuc->hinhanh = $request->input('file');
        }

        // Lưu lại thay đổi
        if ($danhmuc->isDirty()) {
            $danhmuc->save();
            return redirect()->back()->with('success', 'Slider đã được cập nhật.');
        } else {
            return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
        }
    }


}