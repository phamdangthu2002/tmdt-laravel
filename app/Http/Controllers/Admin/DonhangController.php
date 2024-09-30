<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Ctdh\ChitietdonghangServices;
use App\Http\Services\Donhang\DonhangServices;
use App\Http\Services\Trangthai\TrangthaiServices;
use Illuminate\Http\Request;

class DonhangController extends Controller
{
    protected $donhangServices;
    protected $trangthaiServices;
    protected $chitietdonghangServices;
    public function __construct(DonhangServices $donhangServices, TrangthaiServices $trangthaiServices, ChitietdonghangServices $chitietdonghangServices)
    {
        $this->donhangServices = $donhangServices;
        $this->trangthaiServices = $trangthaiServices;
        $this->chitietdonghangServices = $chitietdonghangServices;
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
        $donhang = $this->trangthaiServices->getDonhangIdTrangthai($id);
        $trangthais = $this->trangthaiServices->show();
        $donhangs = $this->donhangServices->getDonhang();
        $donhangedits = $this->chitietdonghangServices->getDonhangById($id);
        return view('Admin.don-hang.edit', [
            'title' => 'Trạng thái đơn hàng',
            'donhangs' => $donhangs,
            'donhangedits' => $donhangedits,
            'trangthais' => $trangthais,
            'donhang' => $donhang,
        ]);
    }
}
