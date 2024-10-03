<?php
namespace App\Http\Services\Cart;

use App\Models\Cart;
use App\Models\Donhang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartServices
{
    public function add_cart($request)
    {
        $datathang = 1; // Đánh dấu giỏ hàng đã đặt hàng
        $id_danhmuc = $request->input('id_danhmuc');
        $id_user = Auth::user()->id;
        if ($id_danhmuc == 1) {
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
            $cartItem = Cart::where('id_user', $id_user)
                ->where('id_sanpham', $request->input('id_sanpham'))
                ->where('id_size', $request->input('id_size'))
                ->where('id_color', $request->input('id_color'))
                ->first();

            if ($cartItem) {
                // Cập nhật lại quantity
                $cartItem->quantity += $request->input('quantity');
                $cartItem->save();
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                Cart::create([
                    'id_user' => $id_user,
                    'id_sanpham' => $request->input('id_sanpham'),
                    'id_color' => $request->input('id_colordefault'),
                    'id_size' => $request->input('id_sizedefault'),
                    'quantity' => $request->input('quantity'),
                    'gia' => $request->input('gia'),
                ]);
            }
        } else {
            // dd($request->input());
            // Kiểm tra các giá trị cần thiết
            if (empty($request->input('id_size'))) {
                return redirect()->back()->with('error', 'Vui lòng chọn kích thước!');
            }
            if (empty($request->input('id_color'))) {
                return redirect()->back()->with('error', 'Vui lòng chọn màu sắc!');
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
            $cartItem = Cart::where('id_user', $id_user)
                ->where('id_sanpham', $request->input('id_sanpham'))
                ->where('id_size', $request->input('id_size'))
                ->where('id_color', $request->input('id_color'))
                ->first();


            if ($cartItem) {
                // Cập nhật lại quantity
                $cartItem->quantity += $request->input('quantity');
                $cartItem->save();
                DB::table('carts')
                    ->where('id_user', $id_user)
                    ->where('id_sanpham', $request->input('id_sanpham'))
                    ->where('id_size', $request->input('id_size'))
                    ->where('id_color', $request->input('id_color'))
                    ->update(['dadathang' => $datathang]);

                DB::commit();
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                Cart::create([
                    'id_user' => $id_user,
                    'id_sanpham' => $request->input('id_sanpham'),
                    'id_color' => $request->input('id_color'),
                    'id_size' => $request->input('id_size'),
                    'quantity' => $request->input('quantity'),
                    'gia' => $request->input('gia'),
                ]);
            }
        }
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    // public function add_cart($request)
    // {
    //     $id_danhmuc = $request->input('id_danhmuc');
    //     //kiểm tra nếu id_danhmuc == 1 thì id_color và id_size =1
    //     $id_user = Auth::user()->id;
    //     $id_sanpham = (int) $request->input('id_sanpham');
    //     $id_color = (int) $request->input('id_color');
    //     $id_size = (int) $request->input('id_size');
    //     $quantity = (int) $request->input('quantity');
    //     $gia = (int) $request->input('gia');

    //     // Kiểm tra các giá trị cần thiết
    //     if (empty($id_size)) {
    //         return redirect()->back()->with('error', 'Vui lòng chọn kích thước!');
    //     }
    //     if (empty($id_color)) {
    //         return redirect()->back()->with('error', 'Vui lòng chọn màu sắc!');
    //     }

    //     // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
    //     $cartItem = Cart::where('id_user', $id_user)
    //         ->where('id_sanpham', $id_sanpham)
    //         ->where('id_size', $id_size)
    //         ->where('id_color', $id_color)
    //         ->first();

    //     if ($cartItem) {
    //         // Cập nhật lại quantity
    //         $cartItem->quantity += $quantity;
    //         $cartItem->save();
    //     } else {
    //         // Thêm sản phẩm mới vào giỏ hàng
    //         Cart::create([
    //             'id_user' => $id_user,
    //             'id_sanpham' => $id_sanpham,
    //             'id_color' => $id_color,
    //             'id_size' => $id_size,
    //             'quantity' => $quantity,
    //             'gia' => $gia,
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    // }


    public function show_cart()
    {
        return Cart::select('id_giohang', 'id_sanpham', 'id_user', 'id_size', 'id_color', 'quantity', 'gia')->with('sanpham')->get();
    }
    public function getCartByID()
    {
        // Lấy id của người dùng hiện tại đã đăng nhập
        $id_user = Auth::id();
        return Cart::select('id_giohang', 'id_sanpham', 'id_size', 'id_color', 'quantity', 'gia', 'dadathang')->with('sanpham')->where('id_user', $id_user)->get();
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
    //     $id_size = $request->input('id_size');
    //     $id_color = $request->input('id_color');
    //     $id_user = $id;
    //     $id_trangthai = 1; // Mặc định trạng thái đơn hàng
    //     $datathang = 0; // Đánh dấu giỏ hàng đã đặt hàng

    //     // Lấy tất cả sản phẩm trong giỏ hàng của người dùng
    //     $carts = DB::table('carts')
    //         ->where('id_user', $id_user)
    //         ->where('dadathang', 1) // Lấy sản phẩm chưa đặt hàng
    //         ->get();

    //     if ($carts->isEmpty()) {
    //         session()->flash('error', 'Giỏ hàng của bạn trống.');
    //         return false;
    //     }

    //     DB::beginTransaction();
    //     try {
    //         // Tính tổng tiền
    //         $tong = $carts->sum(function ($cart) {
    //             return $cart->quantity * $cart->gia;
    //         });

    //         // Tạo đơn hàng mới
    //         $donhang = Donhang::create([
    //             'id_user' => $id_user,
    //             'tong' => $tong,
    //             'id_trangthai' => $id_trangthai,
    //             'id_sanpham' => $id_sanpham,
    //         ]);

    //         // Thêm sản phẩm vào chi tiết đơn hàng
    //         foreach ($carts as $cart) {
    //             DB::table('chitietdonghangs')->insert([
    //                 'id_donhang' => $donhang->id_donhang,
    //                 'id_sanpham' => $cart->id_sanpham,
    //                 'soluong' => $cart->quantity,
    //                 'gia' => $cart->gia,
    //                 'id_trangthai' => $id_trangthai, // Đảm bảo rằng id_trangthai có giá trị hợp lệ
    //                 'id_size' => $id_size,
    //                 'id_color' => $id_color,
    //             ]);
    //         }

    //         // Cập nhật trạng thái sản phẩm trong giỏ hàng là đã đặt
    //         DB::table('carts')
    //             ->where('id_user', $id_user)
    //             ->update(['dadathang' => $datathang]);

    //         DB::commit();
    //         session()->flash('success', 'Đã đặt hàng thành công.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         session()->flash('error', 'Đặt hàng thất bại: ' . $e->getMessage());
    //         Log::error($e->getMessage());
    //         return false;
    //     }

    //     return true;
    // }
    public function add_donghang($request, $id)
    {
        $id_user = $id;
        $id_trangthai = 1; // Mặc định trạng thái đơn hàng
        $datathang = 0; // Đánh dấu giỏ hàng đã đặt hàng

        // Lấy tất cả sản phẩm trong giỏ hàng của người dùng
        $carts = DB::table('carts')
            ->where('id_user', $id_user)
            ->where('dadathang', 1) // Lấy sản phẩm chưa đặt hàng
            ->get();

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
            ]);

            // Thêm sản phẩm vào chi tiết đơn hàng
            foreach ($carts as $cart) {
                // Lấy size và color của từng sản phẩm từ giỏ hàng
                $id_size = $cart->id_size;
                $id_color = $cart->id_color;

                DB::table('chitietdonghangs')->insert([
                    'id_donhang' => $donhang->id_donhang,
                    'id_sanpham' => $cart->id_sanpham,
                    'soluong' => $cart->quantity,
                    'gia' => $cart->gia,
                    'id_trangthai' => $id_trangthai, // Đảm bảo rằng id_trangthai có giá trị hợp lệ
                    'id_size' => $id_size,
                    'id_color' => $id_color,
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