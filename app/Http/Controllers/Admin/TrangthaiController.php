<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrangthaiController extends Controller
{
    public function __construct()
    {

    }

    public function create(){
        return view('admin.trangthai.create');
    }
}
