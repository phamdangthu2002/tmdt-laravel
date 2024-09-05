<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Danhmuc\DanhmucServices;
use App\Http\Services\Slider\SliderServices;
use App\Http\Services\Users\SanphamServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $danhmucServices;
    protected $sliderServices;
    protected $sanphamServices;
    public function __construct(DanhmucServices $danhmucServices, SliderServices $sliderServices, SanphamServices $sanphamServices)
    {
        $this->danhmucServices = $danhmucServices;
        $this->sliderServices = $sliderServices;
        $this->sanphamServices = $sanphamServices;
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
    public function buy()
    {
        return view('Users.thanh-toan.index', [
            'title' => 'Thanh toán'
        ]);
    }
}
