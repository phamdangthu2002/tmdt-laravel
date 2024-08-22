<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Danhmuc\DanhmucFormRequest;
use App\Http\Services\Danhmuc\DanhmucServices;
use Illuminate\Http\Request;


class DanhmucController extends Controller
{
    protected $danhmucServices;
    public function __construct(DanhmucServices $danhmucServices)
    {
        $this->danhmucServices = $danhmucServices;
    }
    public function create()
    {
        return view('Admin.danh-muc.add', [
            'title' => 'Thêm danh mục',
        ]);
    }
    public function store(DanhmucFormRequest $danhmucFormRequest)
    {
        $this->danhmucServices->create($danhmucFormRequest);
        return redirect()->back();
    }
    public function show()
    {
        $danhmucs = $this->danhmucServices->showAllDanhmuc();
        return view('Admin.danh-muc.show', [
            'title' => 'Danh sách danh mục',
            'danhmucs' => $danhmucs,
        ]);
    }
    public function __store($id_danhmuc)
    {
        $danhmucs = $this->danhmucServices->showAllDanhmuc();
        $danhmucedits = $this->danhmucServices->getDanhmucById($id_danhmuc);
        return view('Admin.danh-muc.store', [
            'title' => 'Sửa danh mục',
            'danhmucedits' => $danhmucedits,
            'danhmucs' => $danhmucs,
        ]);
    }
    public function edit(Request $request, $id_danhmuc)
    {
        $this->danhmucServices->update($request, $id_danhmuc);
        return redirect()->route('admin.show-danh-muc')->with('success', 'Cập nhật danh mục thành công.');
    }
    public function destroy($id_danhmuc)
    {
        $this->danhmucServices->delete($id_danhmuc);
        return redirect()->route('admin.show-danh-muc')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
