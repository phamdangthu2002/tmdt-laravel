<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\CartServices;
use App\Http\Services\Danhmuc\DanhmucServices;
use App\Http\Services\Slider\SliderServices;
use App\Http\Services\User\UserServices;
use App\Http\Services\Users\SanphamServices;
use App\Models\cart;
use App\Models\Sanpham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $danhmucServices;
    protected $danhmucConServices;
    protected $sliderServices;
    protected $sanphamServices;
    protected $cartServices;
    protected $userServices;
    public function __construct(DanhmucServices $danhmucServices, SliderServices $sliderServices, SanphamServices $sanphamServices, CartServices $cartServices, UserServices $userServices)
    {
        $this->danhmucServices = $danhmucServices;
        $this->sliderServices = $sliderServices;
        $this->sanphamServices = $sanphamServices;
        $this->cartServices = $cartServices;
        $this->userServices = $userServices;
    }
    public function index()
    {
        $sliders = $this->sliderServices->show();
        $menus = $this->danhmucServices->show();
        $sanphams = $this->sanphamServices->get();
        $sanphamrandoms = $this->sanphamServices->random();
        return view('Users.trang-chu.trang-chu', [
            'title' => 'Trang chủ',
            'menus' => $menus,
            'sliders' => $sliders,
            'sanphams' => $sanphams,
            'sanphamrandoms' => $sanphamrandoms,
        ]);
    }
    public function load(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->sanphamServices->get($page);
        if (count($result) != 0) {
            $html = view('Users.san-pham-main.main', [
                'sanphams' => $result,
            ])->render();
            return response()->json([
                'html' => $html,
            ]);
        }
        return response()->json([
            'html' => '',
        ]);
    }
    public function danhmuc(Request $request, $id)
    {
        $menus = $this->danhmucServices->getDanhmucById($id);
        $sanphams = $this->sanphamServices->getProductByDanhmuc($menus, $request);
        return view('Users.danh-muc.danhmuc', [
            'title' => $menus->tendanhmuc,
            'sanphams' => $sanphams,
        ]);
    }

    public function chitiet($id)
    {
        $anhs = $this->sanphamServices->getAnhID($id);
        $sanphams = $this->sanphamServices->showSanpham($id);
        $sanphamss = $this->sanphamServices->getByDanhmuc($sanphams->id_danhmuc, $id);
        $sanphamMores = $this->sanphamServices->more($id);
        return view('Users.chi-tiet.index', [
            'title' => $sanphams->tensanpham,
            'sanphams' => $sanphams,
            'sanphamMores' => $sanphamMores,
            'anhs' => $anhs,
            'sanphamss' => $sanphamss,
        ]);
    }

    public function giohang(Request $request)
    {
        $this->cartServices->add_cart($request);
        return redirect()->back();
    }
    public function giohangshow(Request $request)
    {
        $carts = $this->cartServices->getCartByID();

        return view('Users.gio-hang.index', [
            'title' => 'Giỏ hàng',
            'carts' => $carts,
        ]);
    }

    public function update(Request $request)
    {
        $this->sanphamServices->update($request);
        return redirect()->route('user.giohangshow');
    }

    public function destroy($id)
    {
        $this->cartServices->destroy($id);
        return redirect()->back();
    }

    public function donhang(Request $request, $id)
    {
        $this->cartServices->add_donghang($request, $id);
        return redirect()->back();
    }
    public function showdonhang($id)
    {
        $donhangs = $this->cartServices->getDonhang($id);
        return view('Users.don-hang.index', [
            'title' => 'Đơn hàng',
            'donhangs' => $donhangs,
        ]);
    }

    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $key = $request->input('tu-khoa');

        // Thực hiện tìm kiếm sản phẩm dựa trên từ khóa
        $sanphams = Sanpham::where('tensanpham', 'like', '%' . $key . '%')->get();

        // Trả kết quả về view
        return view('Users.tim-kiem.index', [
            'title' => 'Tìm kiếm',
            'sanphams' => $sanphams,
            'key' => $key,
        ]);
    }

    public function profile($id)
    {
        $users = $this->userServices->getUserID($id);
        return view('Users.profile.index', [
            'title' => 'Thông tin cá nhân',
            'users' => $users,
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        $this->userServices->update_User($request, $id);
        return redirect()->back();
    }

    public function lienhe()
    {
        return view('Users.lien-he.index', [
            'title' => 'Liên hệ',
        ]);
    }
    public function thongtin()
    {
        return view('Users.thong-tin.index', [
            'title' => 'Thông tin',
        ]);
    }
    public function buy()
    {
        return view('Users.thanh-toan.index', [
            'title' => 'Thanh toán'
        ]);
    }
}
