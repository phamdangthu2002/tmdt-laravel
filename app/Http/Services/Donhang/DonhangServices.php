<?php
namespace App\Http\Services\Donhang;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DonhangServices
{
    public function getDonhang()
    {
        return Donhang::all();
    }

    public function getDonhangById($id)
    {
        return Donhang::where('id_donhang', $id)->first();
    }
    public function getTotalRevenue()
    {
        // Giả sử tình trạng đơn hàng đã hoàn thành có id là 1
        return Donhang::where('id_trangthai', 1)->sum('tong');
    }

    public function getCompletedOrders()
    {
        // Giả sử trạng thái hoàn thành có id_trangthai = 3
        $completedStatusId = 3;

        // Truy vấn các đơn hàng có trạng thái "hoàn thành"
        return Donhang::where('id_trangthai', $completedStatusId)
            ->get();
    }
    public function getMonthlyRevenue()
    {
        return Donhang::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(tong) as total')
            ->whereYear('created_at', Carbon::now()->year) // Thay đổi năm nếu cần
            ->groupBy('month', 'year')
            ->orderBy('month')
            ->get();
    }
    public function getRecentOrders()
    {
        // Lấy 5 đơn hàng mới nhất
        return Donhang::with('user', 'sanpham', 'trangthais')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
}