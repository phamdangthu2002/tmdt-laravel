<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Danhmuc\DanhmucServices;
use App\Http\Services\Danhmuccon\DanhmucConServices;
use Illuminate\Http\Request;

class DanhmucConController extends Controller
{
    protected $danhmucConServices;
    protected $danhmucServices;
    public function __construct(DanhmucConServices $danhmucConServices, DanhmucServices $danhmucServices)
    {
        $this->danhmucConServices = $danhmucConServices;
        $this->danhmucServices = $danhmucServices;
    }
    public function create()
    {
        $danhmucs = $this->danhmucServices->getAllDanhmuc();
        return view('Admin.danh-muc-con.add', [
            'title' => 'Thêm danh mục con',
            'danhmucs' => $danhmucs,
        ]);
    }
    public function store(Request $request)
    {
        $this->danhmucConServices->create($request);
        return redirect()->back();
    }
    public function show()
    {
        $danhmucs = $this->danhmucConServices->showAllDanhmuc();
        return view('Admin.danh-muc-con.show', [
            'title' => 'Danh sách danh mục',
            'danhmucs' => $danhmucs,
        ]);
    }
    public function __store($id_danhmuccon)
    {
        $danhmucs = $this->danhmucConServices->getAllDanhmuc();
        $menus = $this->danhmucServices->getAllDanhmuc();
        $danhmucedits = $this->danhmucConServices->getDanhmucById($id_danhmuccon);
        return view('Admin.danh-muc-con.store', [
            'title' => 'Sửa danh mục',
            'danhmucedits' => $danhmucedits,
            'danhmucs' => $danhmucs,
            'menus' => $menus,
        ]);
    }
    public function edit(Request $request, $id_danhmuc)
    {
        $this->danhmucConServices->update($request, $id_danhmuc);
        return redirect()->route('admin.show-danh-muc-con')->with('success', 'Cập nhật danh mục thành công.');
    }
    public function destroy($id_danhmuc)
    {
        $this->danhmucConServices->delete($id_danhmuc);
        return redirect()->route('admin.show-danh-muc-con')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
