<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderServices;
use App\Models\Slider;
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
        $this->sliderServices->insert($request);
        return redirect()->back();
    }
    public function show()
    {
        $sliders = $this->sliderServices->getAll();
        return view('Admin.slider.show', [
            'title' => 'List Slider',
            'sliders' => $sliders,
        ]);
    }

    public function __store($id_sliders)
    {
        $sliders = $this->sliderServices->getAll();
        $slideredits = $this->sliderServices->getSliderById($id_sliders);
        return view('Admin.slider.store', [
            'title' => 'Edit Slider',
            'sliders' => $sliders,
            'slideredits' => $slideredits,
        ]);
    }

    public function edit(Request $request, $id_slider)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);
        $result = $this->sliderServices->update($request, $id_slider);
        if ($result) {
            return redirect()->route('admin.show-slider');
        } else {
            return redirect()->back();
        }
    }
    public function destroy($id_slider)
    {
        $this->sliderServices->delete($id_slider);
        return redirect()->back();
    }
}
