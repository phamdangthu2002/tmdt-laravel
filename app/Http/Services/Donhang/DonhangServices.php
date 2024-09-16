<?php
namespace App\Http\Services\Donhang;
use App\Models\Donhang;

class DonhangServices
{
    public function getDonhang()
    {

        return Donhang::all();
    }

    public function getDonhangById($id)
    {
        return Donhang::where('id_donhang', $id)->first();
    }
}