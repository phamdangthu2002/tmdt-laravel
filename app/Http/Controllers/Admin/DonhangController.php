<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Donhang\DonhangServices;
use App\Http\Services\Trangthai\TrangthaiServices;
use Illuminate\Http\Request;

class DonhangController extends Controller
{
    protected $donhangServices;
    protected $trangthaiServices;
    public function __construct(DonhangServices $donhangServices, TrangthaiServices $trangthaiServices)
    {
        $this->donhangServices = $donhangServices;
        $this->trangthaiServices = $trangthaiServices;
    }
    public function show()
    {
        $donhangs = $this->donhangServices->getDonhang();
        return view('admin.don-hang.show', [
            'title' => 'Trạng thái đơn hàng',
            'donhangs' => $donhangs,
        ]);
    }

    public function edit($id)
    {
        $trangthais = $this->trangthaiServices->show();
        $donhangs = $this->donhangServices->getDonhang();
        $donhangedits = $this->donhangServices->getDonhangById($id);
        return view('Admin.don-hang.edit', [
            'title' => 'Trạng thái đơn hàng',
            'donhangs' => $donhangs,
            'donhangedits' => $donhangedits,
            'trangthais' => $trangthais,
        ]);
    }
}
