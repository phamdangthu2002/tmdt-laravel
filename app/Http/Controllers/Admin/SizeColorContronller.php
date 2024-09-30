<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Color\ColorServices;
use App\Http\Services\Size\SizeServices;
use Illuminate\Http\Request;

class SizeColorContronller extends Controller
{
    protected $sizeServices;
    protected $colorServices;
    public function __construct(SizeServices $sizeServices, ColorServices $colorServices)
    {
        $this->sizeServices = $sizeServices;
        $this->colorServices = $colorServices;
    }

    public function size_add()
    {
        return view('Admin.size.add', [
            'title' => 'Add Size',
        ]);
    }
    public function size_store(Request $request)
    {
        $this->sizeServices->add_size($request);
        return redirect()->back();
    }

    public function size_show()
    {
        $sizes = $this->sizeServices->get_size();
        return view('Admin.size.show', [
            'title' => 'Size',
            'sizes' => $sizes,
        ]);
    }

    public function size__store($id)
    {
        $sizeedits = $this->sizeServices->update_size($id);
        $sizes = $this->sizeServices->get_size();
        return view('Admin.size.store', [
            'title' => 'Update Size',
            'sizeedits' => $sizeedits,
            'sizes' => $sizes,
        ]);
    }

    public function size_edit(Request $request, $id)
    {
        $this->sizeServices->edit_size($request, $id);
        return redirect()->back();
    }

    public function size_destroy($id)
    {
        $this->sizeServices->delete_size($id);
        return redirect()->back();
    }

    public function color_add()
    {
        return view('Admin.color.add', [
            'title' => 'Add Color',
        ]);
    }

    public function color_store(Request $request)
    {
        $this->colorServices->add_color($request);
        return redirect()->back();
    }

    public function color_show()
    {
        $colors = $this->colorServices->get_color();
        return view('Admin.color.show', [
            'title' => 'Color',
            'colors' => $colors,
        ]);
    }

    public function color__store($id)
    {
        $coloredits = $this->colorServices->update_color($id);
        $colors = $this->colorServices->get_color();
        return view('Admin.color.store', [
            'title' => 'Update Color',
            'coloredits' => $coloredits,
            'colors' => $colors,
        ]);
    }

    public function color_edit(Request $request, $id)
    {
        $this->colorServices->edit_color($request, $id);
        return redirect()->back();
    }

    public function color_destroy($id)
    {
        $this->colorServices->delete_color($id);
        return redirect()->back();
    }
}
