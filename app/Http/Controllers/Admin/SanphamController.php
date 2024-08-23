<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sanpham\SanphamRequest;
use App\Http\Services\Danhmuc\DanhmucServices;
use App\Http\Services\Sanpham\SanphamServices;
use App\Models\Sanpham;
use Illuminate\Http\Request;

class SanphamController extends Controller
{
    protected $danhmucServices;
    protected $sanphamServices;
    public function __construct(DanhmucServices $danhmucServices, SanphamServices $sanphamServices)
    {
        $this->danhmucServices = $danhmucServices;
        $this->sanphamServices = $sanphamServices;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $danhmucs = $this->danhmucServices->showAllDanhmuc();
        return view('Admin.san-pham.add', [
            'title' => 'Thêm sản phẩm',
            'danhmucs' => $danhmucs,
        ]);
    }


    public function store(SanphamRequest $sanphamRequest)
    {
        $this->sanphamServices->create($sanphamRequest);
        return redirect()->back();
    }

    public function show()
    {
        $sanphams = $this->sanphamServices->getAll();
        return view('Admin.san-pham.show', [
            'title' => 'Chi tiết sản phẩm',
            'sanphams' => $sanphams,
        ]);
    }

    public function __store($id_sanpham)
    {
        $sanphams = $this->sanphamServices->getAll();
        $sanphamedits = $this->sanphamServices->getByidsanpham($id_sanpham);
        $danhmucs = $this->danhmucServices->showAllDanhmuc();
        return view('Admin.san-pham.store', [
            'title' => 'Chỉnh sửa sản phẩm',
            'sanphams' => $sanphams,
            'sanphamedits' => $sanphamedits,
            'danhmucs' => $danhmucs,
        ]);
    }

    public function edit(Request $request, $id_sanpham)
    {
        $sanpham = $this->sanphamServices->update($request, $id_sanpham);
        if ($sanpham) {
            return redirect()->route('admin.show-san-pham');
        }
    }


    public function destroy($id_sanpham)
    {
        $this->sanphamServices->delete($id_sanpham);
        return redirect()->back();
    }
}
