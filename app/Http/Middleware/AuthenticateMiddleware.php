<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Kiểm tra xem người dùng đã đăng nhập và có vai trò là 2 hay không
        if (!$user || ($user->role == 2)) {
            // Nếu chưa đăng nhập hoặc có vai trò là 2, chuyển hướng đến trang đăng nhập và hiển thị thông báo lỗi
            return redirect()->route('auth.login')->with('error', 'Bạn cần phải đăng nhập');
        }

        // Nếu người dùng đã đăng nhập và không có vai trò là 2, tiếp tục xử lý yêu cầu
        return $next($request);
    }
}
