<?php
namespace App\Http\Services\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
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
        return Cart::select('id_giohang', 'id_sanpham', 'size', 'color', 'quantity', 'gia')->with('sanpham')->where('id_user', $id_user)->get();
    }

    public function destroy($id){
        $carts = Cart::where('id_giohang', $id)->firstOrFail()->delete();
        if($carts){
            session()->flash('success', 'Đã xóa khỏi giỏ hàng.');
        }else{
            session()->flash('error', 'Xóa thất bại.');

        }
    }
}