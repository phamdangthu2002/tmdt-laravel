<?php
namespace App\Http\Services\Cart;

use App\Models\Cart;
use App\Models\Donhang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartServices
{
    // public function add_cart($request)
    // {
    //     // Lấy thông tin từ request
    //     $id_user = Auth::user()->id;
    //     $id_sanpham = (int) $request->input('id_sanpham');
    //     $color = (string) $request->input('color');
    //     $size = (string) $request->input('size');
    //     $quantity = (int) $request->input('quantity');
    //     $gia = (int) $request->input('gia');
    //     if ($size == null) {
    //         return redirect()->back()->with('error', 'Vui lòng chọn kích thước!');
    //     }
    //     if ($color == null) {
    //         return redirect()->back()->with('error', 'Vui lòng chọn màu sắc!');
    //     }
    //     // Add item to cart
    //     try {
    //         Cart::create([
    //             'id_sanpham' => $id_sanpham,
    //             'id_user' => $id_user,
    //             'color' => $color,
    //             'size' => $size,
    //             'quantity' => $quantity,
    //             'gia' => $gia
    //         ]);
    //         // Danhmuc::create($danhmucFormRequest->all());
    //         session()->flash('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Thêm sản phẩm thất bại: ' . $e->getMessage());
    //         Log::info($e->getMessage());
    //         return false;
    //     }
    //     return true;
    // }

    public function add_cart($request)
    {
        $id_user = Auth::user()->id;
        $id_sanpham = (int) $request->input('id_sanpham');
        $color = (string) $request->input('color');
        $size = (string) $request->input('size');
        $quantity = (int) $request->input('quantity');
        $gia = (int) $request->input('gia');

        // Kiểm tra các giá trị cần thiết
        if ($size == null) {
            return redirect()->back()->with('error', 'Vui lòng chọn kích thước!');
        }
        if ($color == null) {
            return redirect()->back()->with('error', 'Vui lòng chọn màu sắc!');
        }

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
        $cartItem = Cart::where('id_user', $id_user)
            ->where('id_sanpham', $id_sanpham)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        if ($cartItem) {
            // Cập nhật lại quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            Cart::create([
                'id_user' => $id_user,
                'id_sanpham' => $id_sanpham,
                'color' => $color,
                'size' => $size,
                'quantity' => $quantity,
                'gia' => $gia,
            ]);
        }
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
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

    // public function add_donghang($request, $id)
    // {
    //     $id_sanpham = $request->input('id_sanpham');
    //     $id_user = $id;
    //     $tong = $request->input('tong');
    //     $quantity = $request->input('quantity');
    //     $id_trangthai = 1;
    //     $datathang = 0;
    //     try {
    //         Donhang::create([
    //             'id_user' => $id_user,
    //             'tong' => $tong,
    //             'id_sanpham' => $id_sanpham,
    //             'id_trangthai' => $id_trangthai,
    //             'soluong' => $quantity,
    //         ]);
    //         // Lưu lịch sử trạng thái đơn hàng
    //         DB::table('carts')->update([
    //             'dadathang' => $datathang,
    //         ]);
    //         session()->flash('success', 'Đã đặt hàng.');
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Đặt hàng thất bại: ' . $e->getMessage());
    //         Log::info($e->getMessage());
    //         return false;
    //     }
    //     return true;
    // }
    public function add_donghang($request, $id)
    {
        $id_sanpham = $request->input('id_sanpham');
        $id_user = $id;
        $id_trangthai = 1; // Mặc định trạng thái đơn hàng
        $datathang = 0; // Đánh dấu giỏ hàng đã đặt hàng

        // Lấy tất cả sản phẩm trong giỏ hàng của người dùng
        $carts = DB::table('carts')
            ->where('id_user', $id_user)
            ->where('dadathang', 1) // Lấy sản phẩm chưa đặt hàng
            ->get();

        if ($carts->isEmpty()) {
            session()->flash('error', 'Giỏ hàng của bạn trống.');
            return false;
        }

        DB::beginTransaction();
        try {
            // Tính tổng tiền
            $tong = $carts->sum(function ($cart) {
                return $cart->quantity * $cart->gia;
            });

            // Tạo đơn hàng mới
            $donhang = Donhang::create([
                'id_user' => $id_user,
                'tong' => $tong,
                'id_trangthai' => $id_trangthai,
                'id_sanpham' => $id_sanpham,
            ]);

            // Thêm sản phẩm vào chi tiết đơn hàng
            foreach ($carts as $cart) {
                DB::table('chitietdonghangs')->insert([
                    'id_donhang' => $donhang->id_donhang,
                    'id_sanpham' => $cart->id_sanpham,
                    'soluong' => $cart->quantity,
                    'gia' => $cart->gia,
                    'id_trangthai' => $id_trangthai,
                ]);
            }

            // Cập nhật trạng thái sản phẩm trong giỏ hàng là đã đặt
            DB::table('carts')
                ->where('id_user', $id_user)
                ->update(['dadathang' => $datathang]);

            DB::commit();
            session()->flash('success', 'Đã đặt hàng thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Đặt hàng thất bại: ' . $e->getMessage());
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }



    // public function add_donghang($request, $id)
    // {
    //     $id_user = $id;
    //     $products = $request->input('products'); // Nhận mảng sản phẩm từ yêu cầu
    //     $id_trangthai = 1;
    //     $datathang = 0;

    //     try {
    //         foreach ($products as $product) {
    //             $id_sanpham = $product['id_sanpham'];
    //             $tong = $product['tong'];
    //             $quantity = $product['quantity'];

    //             // Tạo đơn hàng cho mỗi sản phẩm
    //             Donhang::create([
    //                 'id_user' => $id_user,
    //                 'tong' => $tong,
    //                 'id_sanpham' => $id_sanpham,
    //                 'id_trangthai' => $id_trangthai,
    //                 'soluong' => $quantity,
    //             ]);
    //         }

    //         // Cập nhật trạng thái đơn hàng trong giỏ hàng
    //         DB::table('carts')->where('id_user', $id_user)->update([
    //             'dadathang' => $datathang,
    //         ]);

    //         session()->flash('success', 'Đã đặt hàng.');
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Đặt hàng thất bại: ' . $e->getMessage());
    //         Log::info($e->getMessage());
    //         return false;
    //     }

    //     return true;
    // }
    public function getDonhang($id)
    {
        return Donhang::where('id_user', $id)
            ->with('user')              // Lấy thông tin người dùng
            ->with('trangthais')        // Lấy trạng thái đơn hàng
            ->with('sanpham') 
            ->with('ctdh')  // Lấy thông tin từ bảng chitietdonhang
            ->get();
    }
}