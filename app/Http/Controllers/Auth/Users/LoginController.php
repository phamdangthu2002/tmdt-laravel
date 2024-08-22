<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {

    }
    public function login()
    {
        return view('Auth.Users.Login', [
            'title' => 'Trang đăng nhập',
        ]);
    }
    public function store(AuthRequest $authRequest)
    {
        $user = Auth::user();
        $rememberMe = $authRequest->input('rememberMe');
        $credentials = [
            'email' => $authRequest->input('email'),
            'password' => $authRequest->input('password'),

        ];
        if (Auth::attempt($credentials, $rememberMe)) {
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
            } else if ($user->role == 2) {
                return redirect()->route('index')->with('success', 'Đăng nhập thành công');
            }
        }
        return redirect()->back()->with('error', 'Email hoặc password không chính xác');
    }
}
