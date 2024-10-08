<?php
namespace App\Http\Services\Upload;

use App\Models\Cart;
use Exception;

class UploadServices
{
    public function store($request)
    {
        try {
            if ($request->hasFile('file')) {
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date('Y/m/d');
                $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                return '/storage/' . $pathFull . '/' . $name;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}