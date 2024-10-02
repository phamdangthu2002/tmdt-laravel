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
                <h3 class="text-center mb-4">Đăng ký</h3>
                <form action="{{ route('auth.store-register') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nhập vào họ và tên</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Họ và tên" autofocus>
                        @if ($errors->has('name'))
                            <p class="error-message">*
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Nhập vào email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        @if ($errors->has('email'))
                            <p class="error-message">*
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nhập vào mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Mật khẩu">
                        @if ($errors->has('password'))
                            <p class="error-message">*
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                </form>
                <div class="mt-3 text-center">
                    <span>Bạn đã có tài khoản?</span> <a href="{{ route('auth.login') }}" class="text-decoration-none">Đăng nhập</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
