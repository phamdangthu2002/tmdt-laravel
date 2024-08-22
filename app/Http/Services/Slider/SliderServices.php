<?php
namespace App\Http\Services\Slider;

use App\Models\Slider;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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
}