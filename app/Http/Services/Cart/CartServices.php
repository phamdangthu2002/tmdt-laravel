<?php
namespace App\Http\Services\Cart;

use App\Models\Cart;
use App\Models\Donhang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartServices
{
    public function add_cart($request)
    {
        // Lấy thông tin từ request
        $id_user = Auth::user()->id;
        $id_sanpham = (int) $request->input('id_sanpham');
        $color = (string) $request->input('color');
        $size = (string) $request->input('size');
        $quantity = (int) $request->input('quantity');
        $gia = (int) $request->input('gia');
        if ($size == null) {
            return redirect()->back()->with('error', 'Vui lòng chọn kích thước!');
        }
        if ($color == null) {
            return redirect()->back()->with('error', 'Vui lòng chọn màu sắc!');
        }
        // Add item to cart
        try {
            Cart::create([
                'id_sanpham' => $id_sanpham,
                'id_user' => $id_user,
                'color' => $color,
                'size' => $size,
                'quantity' => $quantity,
                'gia' => $gia
            ]);
            // Danhmuc::create($danhmucFormRequest->all());
            session()->flash('success', 'Đã thêm sản phẩm vào giỏ hàng.');
        } catch (\Exception $e) {
            session()->flash('error', 'Thêm sản phẩm thất bại: ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function show_cart()
    {
        return Cart::select('id_giohang', 'id_sanpham', 'id_user', 'size', 'color', 'quantity', 'gia')->with('sanpham')->get();
    }
    public function getCartByID()
    {
        // Lấy id của người dùng hiện tại đã đăng nhập
        $id_user = Auth::id();
        return Cart::select('id_giohang', 'id_sanpham', 'size', 'color', 'quantity', 'gia', 'dadathang')->with('sanpham')->where('id_user', $id_user)->get();
    }

    public function destroy($id)
    {
        $carts = Cart::where('id_giohang', $id)->firstOrFail()->delete();
        if ($carts) {
            session()->flash('success', 'Đã xóa khỏi giỏ hàng.');
        } else {
            session()->flash('error', 'Xóa thất bại.');

        }
    }

    public function add_donghang($request, $id)
    {
        $id_sanpham = $request->input('id_sanpham');
        $id_user = $id;
        $tong = $request->input('tong');
        $quantity = $request->input('quantity');
        $id_trangthai = 1;
        $datathang = 0;
        try {
            Donhang::create([
                'id_user' => $id_user,
                'tong' => $tong,
                'id_sanpham' => $id_sanpham,
                'id_trangthai' => $id_trangthai,
                'soluong' => $quantity,
            ]);
            // Lưu lịch sử trạng thái đơn hàng
            DB::table('carts')->update([
                'dadathang' => $datathang,
            ]);
            // Danhmuc::create($danhmucFormRequest->all());
            session()->flash('success', 'Đã đặt hàng.');
        } catch (\Exception $e) {
            session()->flash('error', 'Đặt hàng thất bại: ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }
    public function getDonhang($id)
    {
        return Donhang::where('id_user', $id)
            ->with('user')        // Lấy thông tin người dùng
            ->with('trangthais')  // Lấy trạng thái đơn hàng
            ->get();
    }
}