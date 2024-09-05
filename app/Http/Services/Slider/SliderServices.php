<?php
namespace App\Http\Services\Slider;

use App\Models\Slider;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderServices
{
    public function insert($request)
    {
        try {
            // $request->except('_token');
            Slider::create(
                [
                    'name' => $request->input('name'),
                    'url' => $request->input('url'),
                    'hinhanh' => $request->input('file'),
                    'sort_by' => $request->input('sort_by'),
                    'trangthai' => $request->input('trangthai'),
                ]
            );
            // Slider::create($request->input());
            Session::flash('success', 'Thêm slider thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Thêm slider thất bại. ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }
    public function getAll()
    {
        return Slider::orderByDesc('id_slider')->paginate(15);
    }

    public function show(){
        return Slider::where('trangthai',1)->orderByDesc('sort_by')->get();
    }

    public function getSliderById($id_slider)
    {
        return Slider::where('id_slider', $id_slider)->first();
    }

    public function update($request, $id_slider)
    {
        try {
            // Tìm slider cần cập nhật
            $slider = Slider::find($id_slider);

            // Cập nhật các thông tin khác
            $slider->name = $request->input('name', '');
            $slider->url = $request->input('url', '');
            $slider->sort_by = $request->input('sort_by', '');
            $slider->trangthai = $request->input('trangthai', '');

            // Kiểm tra xem có file mới không
            if ($request->input('file')) {
                // Lấy đường dẫn file từ input ẩn
                $slider->hinhanh = $request->input('file');
            }

            // Lưu lại thay đổi
            if ($slider->isDirty()) {
                $slider->save();
                return redirect()->back()->with('success', 'Slider đã được cập nhật.');
            } else {
                return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
            }
        } catch (Exception $e) {
            Session::flash('error', 'Cập nhật slider thất bại. ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
    }

    public function delete($id_slider)
    {
        $sliders = Slider::where('id_slider', $id_slider)->first();
        if($sliders){
            $path = str_replace('storage', 'public', $sliders->hinhanh);
            Storage::delete($path);
            $sliders->delete();
            Session::flash('success', 'Sản phẩm đã được xóa thành công.');
        }else{
            Session::flash('error', 'Xóa sản phẩm thất bại.');
        }
    }
}