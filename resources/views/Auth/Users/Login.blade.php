<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    <style>
        main p {
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card p-4 shadow-lg" style="width: 350px;">
                <h3 class="text-center mb-4">Login</h3>
                <form action="{{ route('auth.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Nhập vào email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" autofocus>
                        @if ($errors->has('email'))
                            <p class="error-message">*
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nhập vào password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Mật khẩu">
                        @if ($errors->has('password'))
                            <p class="error-message">*
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="rememberMe" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Nhớ mật khẩu</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="#" class="text-decoration-none">Quên mật khẩu ?</a>
                </div>
                <div class="mt-3 text-center">
                    <span>Bạn chưa có tài khoản?</span> <a href="{{route('auth.register')}}" class="text-decoration-none">Đăng ký</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
