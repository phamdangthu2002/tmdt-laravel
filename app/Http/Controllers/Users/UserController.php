<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\CartServices;
use App\Http\Services\Danhmuc\DanhmucServices;
use App\Http\Services\Slider\SliderServices;
use App\Http\Services\Users\SanphamServices;
use App\Models\cart;
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
    public function __construct(DanhmucServices $danhmucServices, SliderServices $sliderServices, SanphamServices $sanphamServices, CartServices $cartServices)
    {
        $this->danhmucServices = $danhmucServices;
        $this->sliderServices = $sliderServices;
        $this->sanphamServices = $sanphamServices;
        $this->cartServices = $cartServices;
    }
    public function index()
    {
        $sliders = $this->sliderServices->show();
        $menus = $this->danhmucServices->show();
        $sanphams = $this->sanphamServices->get();
        return view('Users.trang-chu.trang-chu', [
            'title' => 'Trang chủ',
            'menus' => $menus,
            'sliders' => $sliders,
            'sanphams' => $sanphams,
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
        $sanphamMores = $this->sanphamServices->more($id);
        return view('Users.chi-tiet.index', [
            'title' => $sanphams->tensanpham,
            'sanphams' => $sanphams,
            'sanphamMores' => $sanphamMores,
            'anhs' => $anhs,
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

    public function destroy($id){
        $this->cartServices->destroy($id);
        return redirect()->back();
    }
    public function buy()
    {
        return view('Users.thanh-toan.index', [
            'title' => 'Thanh toán'
        ]);
    }
}
