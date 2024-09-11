<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register;
use App\Http\Services\Auth\RegisterServices;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    protected $registerServices;
    public function __construct(RegisterServices $registerServices)
    {
        $this->registerServices = $registerServices;
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
    public function Register()
    {
        return view('Auth.Users.Register', [
            'title' => 'Trang đăng ký',
        ]);
    }
    public function add(Register $register)
    {
        $this->registerServices->register($register);
        return redirect()->route('auth.login');
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();

            // Sử dụng trợ lý session()
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('auth.login')->with('success', 'Bạn đã đăng xuất thành công.');
        }

        return redirect()->route('auth.login')->with('error', 'Bạn chưa đăng nhập.');
    }

}
