<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Upload\UploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    protected $uploadServices;
    public function __construct(UploadServices $uploadServices)
    {
        $this->uploadServices = $uploadServices;
    }

    public function store(Request $request)
    {
        $url = $this->uploadServices->store($request);
        if ($url != false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        }
        return response()->json(['error' => true,]);
    }

    public function storeAnh(Request $request)
    {
        $url = $this->uploadServices->storeAnh($request);
        if ($url != false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        }
        return response()->json(['error' => true,]);
    }


}
