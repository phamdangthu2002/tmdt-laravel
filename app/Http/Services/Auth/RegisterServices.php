<?php
namespace App\Http\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class RegisterServices
{
    public function register($register)
    {
        $name = $register->input('name');
        $email = $register->input('email');
        $password = bcrypt($register->input('password'));
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            // Danhmuc::create($danhmucFormRequest->all());
            session()->flash('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            session()->flash('error', 'Đăng ký thất bại: ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }
}