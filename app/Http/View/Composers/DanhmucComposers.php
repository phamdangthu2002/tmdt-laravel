<?php

namespace App\Http\View\Composers;

use App\Models\cart;
use App\Models\Danhmuc;
use App\Models\DanhmucCon;
use Illuminate\Support\Facades\Auth;
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

    public function compose(View $view)
    {
        $danhmucs = Danhmuc::select('id_danhmuc', 'tendanhmuc')
            ->where('trangthai', 1)
            ->orderByDesc('id_danhmuc')
            ->get();

        $id_user = Auth::id();
        $count = cart::where('id_user', $id_user)
        ->where('dadathang', 1)
        ->sum('quantity');
        $view->with([
            'danhmucs' => $danhmucs,
            'count' => $count,
            'id_user' => $id_user,
        ]);
    }

}