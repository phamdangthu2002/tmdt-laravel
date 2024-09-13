@extends('Admin.user.show')
@section('noidung')
    <style>
        p {
            color: red;
        }
    </style>
    <div class="container-danhmuc mt-5">
        <h1 class="mb-4">{{ $title }}</h1>
        <form action="{{ route('admin.edit.user', $useredits->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><b>Tên</b></label>
                                <input type="text" name="name" value="{{ $useredits->name }}" id="name"
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
                                <input type="texxt" name="email" value="{{ $useredits->email }}" id="email"
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
                                <label for="password_new"><b>Mật khẩu mới</b></label>
                                <input type="password" name="password_new" placeholder="Nếu thay đổi" id="password_new"
                                    class="form-control">
                                @if ($errors->has('password_new'))
                                    <p class="error-message">*
                                        {{ $errors->first('password_new') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone"><b>Số điện thoại</b></label>
                                <input type="tel" name="phone" placeholder="Số điện thoại"
                                    value="{{ $useredits->phone }}" id="phone" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address"><b>Địa chỉ</b></label>
                        <input type="text" name="address" placeholder="Địa chỉ" value="{{ $useredits->address }}"
                            id="address" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role"><b>Quyền</b></label>
                                <select name="role" id="role" class="form-control">
                                    <option value="1" {{ $useredits->role == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $useredits->role == 2 ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="trangthai"><b>Trạng thái</b></label>
                                <select class="form-control" name="trangthai" id="trangthai">
                                    <option value="1" {{ $useredits->trangthai == 1 ? 'selected' : '' }}>Hoạt động
                                    </option>
                                    <option value="0" {{ $useredits->trangthai == 0 ? 'selected' : '' }}>Tạm khóa
                                    </option>
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
                        <div id="preview-zone" class="mt-3">
                            <img src="{{ $useredits->avatar }}" alt="" width="50">
                        </div>
                        <input type="hidden" name="file" id="file">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
        </form>
    </div>
@endsection
