<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderServices;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderServices;
    public function __construct(SliderServices $sliderServices)
    {
        $this->sliderServices = $sliderServices;
    }
    public function create()
    {
        return view('Admin.slider.add', [
            'title' => 'Create Slider',
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);
        $this->sliderServices->insert($request);
        return redirect()->back();
    }
}
