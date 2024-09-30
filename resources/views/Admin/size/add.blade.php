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
    <form action="{{ route('admin.store-size') }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h1 class="mb-4">{{ $title }}</h1>
            <div class="row">
                <div class="form-group">
                    <label for="sizeName"><b>Tên Size</b></label>
                    <input type="text" class="form-control" name="sizeName" id="sizeName" placeholder="Nhập tên size">
                    @if ($errors->has('sizeName'))
                        <p class="error-message">*
                            {{ $errors->first('sizeName') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="sizeStatus"><b>Trạng Thái</b></label>
                    <select class="form-control" name="sizeStatus" id="sizeStatus">
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm khóa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
    </form>
@endsection
