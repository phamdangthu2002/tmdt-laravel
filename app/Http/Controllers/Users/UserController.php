<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Danhmuc\DanhmucServices;
use App\Http\Services\Danhmuccon\DanhmucConServices;
use App\Http\Services\Slider\SliderServices;
use App\Http\Services\Users\SanphamServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $danhmucServices;
    protected $danhmucConServices;
    protected $sliderServices;
    protected $sanphamServices;
    public function __construct(DanhmucServices $danhmucServices, DanhmucConServices $danhmucConServices, SliderServices $sliderServices, SanphamServices $sanphamServices)
    {
        $this->danhmucServices = $danhmucServices;
        $this->sliderServices = $sliderServices;
        $this->sanphamServices = $sanphamServices;
        $this->danhmucConServices = $danhmucConServices;
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
    // public function danhmuccon(Request $request, $id)
    // {
    //     $menus = $this->danhmucServices->getDanhmucByIdCon($id);
    //     $sanphams = $this->sanphamServices->getProductByDanhmucCon($menus, $request);
    //     return view('Users.danh-muc.danhmuc',[
    //         'title' => $menus->tendanhmuccon,
    //         'sanphams' => $sanphams,
    //     ]);
    // }

    public function chitiet($id)
    {
        $sanphams = $this->sanphamServices->showSanpham($id);
        $sanphamMores = $this->sanphamServices->more($id);
        return view('Users.chi-tiet.index', [
            'title' => $sanphams->tensanpham,
            'sanphams' => $sanphams,
            'sanphamMores' => $sanphamMores,
        ]);
    }

    public function giohang(Request $request)
    {
        $result = $this->sanphamServices->add_cart($request);
        if ($result === false) {
            return redirect()->back();
        } else {
            return redirect()->route('user.giohangshow');
        }
    }
    public function giohangshow()
    {
        $sanphams = $this->sanphamServices->show_cart();
        return view('Users.gio-hang.index', [
            'title' => 'Giỏ hàng',
            'sanphams' => $sanphams,
            'giohang' => Session::get('giohang'),
        ]);
    }

    public function update(Request $request)
    {
        $this->sanphamServices->update($request);
        return redirect()->route('user.giohangshow');
    }
    public function buy()
    {
        return view('Users.thanh-toan.index', [
            'title' => 'Thanh toán'
        ]);
    }
}
