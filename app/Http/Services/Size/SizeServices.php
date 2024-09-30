<?php
namespace App\Http\Services\Size;

use App\Models\Size;
use Exception;
use Illuminate\Support\Facades\Log;

class SizeServices
{
    public function add_size($request)
    {
        try {
            Size::create([
                'tensize' => (string) $request->input('sizeName'),
                'trangthai' => (int) $request->input('sizeStatus'), // Chuyển đổi thành số nguyên

            ]);
            // size::create($sizeFormRequest->all());
            session()->flash('success', 'Thêm size thành công');
        } catch (Exception $e) {
            session()->flash('error', 'Thêm size thất bại: ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function get_size()
    {
        $sizes = Size::all(); // Lấy tất cả các bản ghi trong bảng size
        return $sizes;
    }

    public function update_size($id)
    {
        $size = Size::find($id);
        return $size;
    }

    public function edit_size($request, $id)
    {
        $size = Size::find($id);
        if (!$size) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // Cập nhật thông tin danh mục
        $size->tensize = $request->input('sizeName');
        $size->trangthai = $request->input('sizeStatus');

        // Lưu lại thay đổi
        if ($size->isDirty()) {
            $size->save();
            return redirect()->back()->with('success', 'Size đã được cập nhật.');
        } else {
            return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
        }
    }

    public function delete_size($id)
    {
        $size = Size::find($id);
        if (!$size) {
            return redirect()->back()->with('error', 'Size không tồn tại.');
        }
        $size->delete();
        return redirect()->back()->with('success', 'Size đã được xóa.');
    }
}