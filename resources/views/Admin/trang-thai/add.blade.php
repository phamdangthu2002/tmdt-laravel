@extends('Admin.index')
@section('content')
    <h4>{{ $title }}</h4>
    <form action="{{ route('admin.store-trangthai') }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h1 class="mb-4">{{ $title }}</h1>
            <div class="form-group">
                <label for="tentrangthai"><b>Tên trạng thái</b></label>
                <input type="text" class="form-control" name="tentrangthai">
            </div>
            <div class="form-group">
                <label for="trangthai"><b>Trạng Thái</b></label>
                <select class="form-control" name="trangthai" id="trangthai">
                    <option value="1">Hoạt động</option>
                    <option value="0">Tạm khóa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mota"><b>Mô tả</b></label>
                <textarea type="text" name="mota" id="mota"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mota');
    </script>
@endsection
