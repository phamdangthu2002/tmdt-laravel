<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Donhang\DonhangServices;
use App\Http\Services\Sanpham\SanphamServices;
use App\Http\Services\Trangthai\TrangthaiServices;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $sanphamServices;
    protected $donhangServices;
    protected $trangthaiServices;

    public function __construct(SanphamServices $sanphamServices, DonhangServices $donhangServices, TrangthaiServices $trangthaiServices)
    {
        $this->sanphamServices = $sanphamServices;
        $this->donhangServices = $donhangServices;
        $this->trangthaiServices = $trangthaiServices;
    }

    public function index()
    {
        // Lấy trạng thái đơn hàng
        $orderStatuses = $this->trangthaiServices->getOrderStatuses();

        // Lấy dữ liệu đơn hàng
        $donhangs = $this->donhangServices->getDonhang();

        // Lấy đơn hàng mới nhất
        $recentOrders = $this->donhangServices->getRecentOrders();

        // Lấy sản phẩm bán chạy nhất
        $topSellingProduct = $this->sanphamServices->getTopSellingProduct();

        // Lấy dữ liệu sản phẩm
        $totalRevenue = $donhangs->sum('tong');
        $sanphams = $this->sanphamServices->get();
        $trangthais = $this->trangthaiServices->show();
        $revenueByMonth = $this->donhangServices->getMonthlyRevenue();

        return view('Admin.trang-chu.index', [
            'title' => 'Trang Admin',
            'donhangs' => $donhangs,
            'sanphams' => $sanphams,
            'revenueByMonth' => $revenueByMonth,
            'trangthais' => $trangthais,
            'orderStatuses' => $orderStatuses,
            'recentOrders' => $recentOrders,
            'totalRevenue' => $totalRevenue,
            'topSellingProduct' => $topSellingProduct,
        ]);
    }
}
