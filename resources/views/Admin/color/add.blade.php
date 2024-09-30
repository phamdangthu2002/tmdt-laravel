@extends('Admin.index')
@section('content')
    <style>
        p.error-message {
            color: red;
        }

        h1 {
            font-weight: bold;
        }
    </style>
    <h4>{{ $title }}</h4>
    <form action="{{ route('admin.store-color') }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h1 class="mb-4">{{ $title }}</h1>
            <div class="row">
                <div class="form-group">
                    <label for="colorName"><b>Tên Màu</b></label>
                    <input type="text" class="form-control" name="colorName" id="colorName" placeholder="Nhập tên màu">
                    @if ($errors->has('colorName'))
                        <p class="error-message">*
                            {{ $errors->first('colorName') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="colorStatus"><b>Trạng Thái</b></label>
                    <select class="form-control" name="colorStatus" id="colorStatus">
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm khóa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
    </form>
@endsection
