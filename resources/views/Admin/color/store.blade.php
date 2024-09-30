@extends('Admin.color.show')
@section('noidung')
    <form action="{{ route('admin.edit-color', $coloredits->id_color) }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h1 class="mb-4">{{ $title }}</h1>
            <div class="row">
                <div class="form-group">
                    <label for="colorName"><b>Tên Màu</b></label>
                    <input type="text" class="form-control" value="{{ $coloredits->tencolor }}" name="colorName"
                        id="colorName" placeholder="Nhập tên màu">
                </div>
                <div class="form-group">
                    <label for="colorStatus"><b>Trạng Thái</b></label>
                    <select class="form-control" name="colorStatus" id="colorStatus">
                        <option value="1" {{ $coloredits->trangthai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $coloredits->trangthai == 0 ? 'selected' : '' }}>Tạm khóa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </div>
    </form>
@endsection
