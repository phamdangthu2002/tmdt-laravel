<?php
namespace App\Http\Services\Upload;

use App\Models\Cart;
use Exception;

class UploadServices
{
    public function store($request)
    {
        try {
            if ($request->hasFile('file')) {
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date('Y/m/d');
                $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                return '/storage/' . $pathFull . '/' . $name;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function upload($request)
    {
        // Lấy dữ liệu từ request
        $id_giohang = $request->input('id_giohang');
        $id_sanpham = $request->input('id_sanpham');
        $id_user = $request->input('id_user');
        $soluong = $request->input('soluong');
        $gia = $request->input('gia');
        // Tìm item trong giỏ hàng
        $cartItem = Cart::where('id_giohang', $id_giohang)
            ->where('id_sanpham', $id_sanpham)
            ->where('id_user', $id_user)
            ->first();

        if ($cartItem) {
            // Cập nhật số lượng
            $cartItem->quantity = $soluong;
            $cartItem->save();

            // Tính tổng tiền cho sản phẩm
            $totalPrice = $cartItem->quantity * $gia;

            // Trả về kết quả
            return [
                'soluong' => $cartItem->quantity,
                'tongcong' => $totalPrice,
            ];
        }

        return false; // Không tìm thấy sản phẩm trong giỏ hàng
    }

}