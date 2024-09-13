@extends('Admin.index')
@section('content')
    <style>
        p {
            color: red;
        }
    </style>
    <h4>{{ $title }}</h4>
    <div class="container-danhmuc mt-5">
        <h1 class="mb-4">{{ $title }}</h1>
        <form action="{{ route('admin.add.user') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><b>Tên</b></label>
                                <input type="text" name="name" value="{{ old('name') }}" id="name"
                                    class="form-control">
                                @if ($errors->has('name'))
                                    <p class="error-message">*
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><b>Email</b></label>
                                <input type="texxt" name="email" value="{{ old('email') }}" id="email"
                                    class="form-control">
                                @if ($errors->has('email'))
                                    <p class="error-message">*
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"><b>Mật khẩu</b></label>
                                <input type="password" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                    <p class="error-message">*
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation"><b>Xác nhận mật khẩu</b></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @if ($errors->has('password_confirmation'))
                                    <p class="error-message">*
                                        {{ $errors->first('password_confirmation') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone"><b>Số điện thoại</b></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" id="phone"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address"><b>Địa chỉ</b></label>
                        <input type="text" name="address" value="{{ old('address') }}" id="address"
                            class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role"><b>Quyền</b></label>
                                <select name="role" id="role" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="trangthai"><b>Trạng thái</b></label>
                                <select name="trangthai" id="trangthai" class="form-control">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="hinhanh"><b>Hình ảnh</b></label>
                    <div id="file-count" class="mt-2">Đã thêm 0/1 file</div>
                    <div id="drop-zone" class="p-3">
                        <div class="form-group mb-3 mt-1">
                            <input type="text" class="form-control text-decorate-none" id="file-preview" />
                        </div>
                        <p>Thêm ảnh ở đây</p>
                        <input type="file" class="form-control-file" id="hinhanh" name="hinhanh[]" multiple>
                        <div id="preview-zone" class="mt-3"></div>
                        <input type="hidden" name="file" id="file">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm người dùng</button>
        </form>
    </div>
@endsection
