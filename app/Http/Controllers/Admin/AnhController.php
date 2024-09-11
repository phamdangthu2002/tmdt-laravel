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

    public function add()
    {
        $sanphams = $this->sanphamServices->getAll();

        // Lấy thông tin các trang
        $currentPage = $sanphams->currentPage(); // Trang hiện tại
        $lastPage = $sanphams->lastPage(); // Trang cuối cùng

        // Tính toán các số trang để hiển thị (giới hạn 6 trang ở giữa)
        $visiblePages = 6;
        $startPage = max(1, $currentPage - floor($visiblePages / 2));
        $endPage = min($lastPage, $startPage + $visiblePages - 1);

        // Tạo mảng các số trang
        $pageNumbers = range($startPage, $endPage);
        return view('Admin.anhsp.add', [
            'title' => 'Thêm ảnh sản phẩm',
            'sanphams' => $sanphams,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'pageNumbers' => $pageNumbers,
        ]);
    }

    public function store(Request $request)
    {
        $this->anhspServices->create($request);
        return redirect()->back();
    }
}
