<?php
namespace App\Http\Services\Color;

use App\Models\Color;
use Exception;
use Illuminate\Support\Facades\Log;

class ColorServices
{
    public function add_color($request)
    {
        $tencolor = $request->input('colorName');
        $trangthai = $request->input('colorStatus');
        if (empty($tencolor)) {
            return redirect()->back()->with('error', 'Bạn chưa nhập tên Color');
        }
        try {
            Color::create([
                'tencolor' => $tencolor,
                'trangthai' => $trangthai, // Chuyển đổi thành số nguyên

            ]);
            session()->flash('success', 'Thêm color thành công');
        } catch (Exception $e) {
            session()->flash('error', 'Thêm color thất bại: ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function get_color()
    {
        $colors = Color::all();
        return $colors;
    }

    public function getColorid($id)
    {
        $color = Color::find($id);
        return $color;
    }

    public function update_color($id)
    {
        $color = Color::find($id);
        return $color;
    }

    public function edit_color($request, $id)
    {
        $color = Color::find($id);
        if (!$color) {
            return redirect()->back()->with('error', 'Color không tồn tại.');
        }

        // Cập nhật thông tin danh mục
        $color->tencolor = $request->input('colorName');
        $color->trangthai = $request->input('colorStatus');

        // Lưu lại thay đổi
        if ($color->isDirty()) {
            $color->save();
            return redirect()->back()->with('success', 'Color đã được cập nhật.');
        } else {
            return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
        }
    }

    public function delete_color($id)
    {
        $color = Color::find($id);
        if (!$color) {
            return redirect()->back()->with('error', 'Color không tồn tại.');
        }
        $color->delete();
        return redirect()->back()->with('success', 'Color đã được xóa.');
    }
}