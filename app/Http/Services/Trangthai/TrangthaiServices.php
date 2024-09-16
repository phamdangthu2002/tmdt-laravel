<?php
namespace App\Http\Services\Trangthai;

use App\Models\Donhang;
use App\Models\Trangthai;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TrangthaiServices
{
    public function add($request)
    {
        $tentrangthai = $request->input('tentrangthai');
        $mota = $request->input('mota');
        $trangthai = $request->input('trangthai');

        try {
            // $request->except('_token');
            Trangthai::create(
                [
                    'tentrangthai' => $tentrangthai,
                    'mota' => $mota,
                    'trangthai' => $trangthai,
                ]
            );
            Session::flash('success', 'Thêm trạng thái thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Thêm trạng thái thất bại. ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function show()
    {
        $trangthai = Trangthai::all();
        return $trangthai;
    }

    public function __store($id)
    {
        $trangthai = Trangthai::find($id);
        return $trangthai;
    }

    public function edit($request, $id)
    {
        $model = Trangthai::find($id);
        $model->tentrangthai = $request->input('tentrangthai');
        $model->mota = $request->input('mota');
        $model->trangthai = $request->input('trangthai');

        if ($model->isDirty()) {
            $model->save();
            return redirect()->back()->with('success', 'Trạng thái đã được cập nhật.');
        } else {
            return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
        }
    }

    public function delete($id)
    {
        return Trangthai::where('id_trangthai', $id)->firstOrFail()->delete();
    }

    public function updateStatus($request)
    {
        $id_donhang = $request->input('id_donhang');
        $id_trangthai = $request->input('id_trangthai');

        DB::transaction(function () use ($id_donhang, $id_trangthai) {
            // Cập nhật trạng thái đơn hàng trong bảng donhang
            $donhang = Donhang::find($id_donhang);
            if ($donhang) {
                $donhang->id_trangthai = $id_trangthai;
                $donhang->save();
            }

            // Lưu lịch sử trạng thái đơn hàng
            DB::table('trangthaidonhangs')->insert([
                'id_donhang' => $id_donhang,
                'id_trangthai' => $id_trangthai,
                'ngaycapnhat' => Carbon::now(),
            ]);
        });

        // Redirect hoặc trả về thông báo thành công
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }
}