<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Anhsp\AnhspServices;
use App\Http\Services\Sanpham\SanphamServices;
use Illuminate\Http\Request;

class AnhController extends Controller
{
    protected $sanphamServices;
    protected $anhspServices;
    public function __construct(SanphamServices $sanphamServices, AnhspServices $anhspServices)
    {
        $this->sanphamServices = $sanphamServices;
        $this->anhspServices = $anhspServices;
    }

    public function add($id)
    {
        $sanphams = $this->sanphamServices->getByidsanpham($id);
        $anhs = $this->anhspServices->get($id);

        // Tạo mảng các số trang
        return view('Admin.anhsp.add', [
            'title' => 'Thêm ảnh sản phẩm',
            'sanphams' => $sanphams,
            'anhs' => $anhs,
        ]);
    }

    public function store(Request $request, $id)
    {
        $this->anhspServices->create($request, $id);
        return redirect()->back();
    }
    public function destroy($id)
    {
        $this->anhspServices->destroy($id);
        return redirect()->back();
    }
}
