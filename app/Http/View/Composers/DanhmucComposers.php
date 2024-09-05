<?php

namespace App\Http\View\Composers;

use App\Models\Danhmuc;
use App\Models\DanhmucCon;
use Illuminate\View\View;

class DanhmucComposers
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     */
    // public function compose(View $view)
    // {
    //     $danhmucs = Danhmuc::select('id_danhmuc', 'tendanhmuc')->where('trangthai', 1)->orderByDesc('id_danhmuc')->get();
    //     // $danhmuccons = DanhmucCon::select('id_danhmuccon', 'tendanhmuccon')->where('trangthai', 1)->orderByDesc('id_danhmuccon')->get();
    //     // Lấy danh mục con và nhóm theo id_danhmuc
    //     $danhmuccons = DanhmucCon::select('id_danhmuc', 'id_danhmuccon', 'tendanhmuccon')->where('trangthai', 1)->orderByDesc('id_danhmuccon')->get()->groupBy('id_danhmuc'); // Nhóm danh mục con theo id_danhmuc
    //     $danhmuccon_ids = DanhmucCon::select('id_danhmuc', 'tendanhmuccon')->where('trangthai', 1)->where('id_danhmuc',$danhmucs->id_danhmuc)->orderByDesc('id_danhmuccon')->get();
    //     $view->with([
    //         'danhmucs' => $danhmucs,
    //         'danhmuccons' => $danhmuccons,
    //         'danhmuccon_ids' => $danhmuccon_ids,
    //     ]);
    // }
    public function compose(View $view)
    {
        $danhmucs = Danhmuc::select('id_danhmuc', 'tendanhmuc')
            ->where('trangthai', 1)
            ->orderByDesc('id_danhmuc')
            ->get();

        // Lấy tất cả danh mục con
        $danhmuccons = DanhmucCon::select('id_danhmuc', 'id_danhmuccon', 'tendanhmuccon')
            ->where('trangthai', 1)
            ->orderByDesc('id_danhmuccon')
            ->get();

        $view->with([
            'danhmucs' => $danhmucs,
            'danhmuccons' => $danhmuccons,
        ]);
    }
}