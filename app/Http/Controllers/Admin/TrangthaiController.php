<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Trangthai\TrangthaiServices;
use Illuminate\Http\Request;

class TrangthaiController extends Controller
{
    protected $trangthaiServices;
    public function __construct(TrangthaiServices $trangthaiServices)
    {
        $this->trangthaiServices = $trangthaiServices;
    }

    public function create()
    {
        return view('Admin.trang-thai.add', [
            'title' => 'Thêm trạng thái',
        ]);
    }

    public function store(Request $request)
    {
        $this->trangthaiServices->add($request);
        return redirect()->back();
    }

    public function show()
    {
        $trangthais = $this->trangthaiServices->show();
        return view('Admin.trang-thai.show', [
            'title' => 'Danh sách trạng thái',
            'trangthais' => $trangthais,
        ]);
    }

    public function __store($id)
    {

        $trangthais = $this->trangthaiServices->show();
        $trangthaiedits = $this->trangthaiServices->__store($id);
        return view('Admin.trang-thai.store', [
            'title' => 'Sửa trạng thái',
            'trangthaiedits' => $trangthaiedits,
            'trangthais' => $trangthais,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $this->trangthaiServices->edit($request, $id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->trangthaiServices->delete($id);
        return redirect()->route('admin.show.trangthai')->with('success', 'Trạng thái đã được xóa thành công.');
    }
    public function updateStatus(Request $request)
    {
       $this->trangthaiServices->updateStatus($request);
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}
