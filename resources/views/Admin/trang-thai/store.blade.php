@extends('Admin.trang-thai.show')
@section('noidung')
    <form action="{{ route('admin.store.edit.trangthai', $trangthaiedits->id_trangthai) }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h2 class="mb-4">{{ $title }}</h2>
            <div class="form-group">
                <label for="tentrangthai">Tên trạng thái</label>
                <input type="text" value="{{ old('tentrangthai', $trangthaiedits->tentrangthai) }}" class="form-control"
                    name="tentrangthai" id="tentrangthai" placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label for="trangthai">Trạng Thái</label>
                <select class="form-control" name="trangthai" id="trangthai">
                    <option value="1" {{ $trangthaiedits->trangthai == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $trangthaiedits->trangthai == 0 ? 'selected' : '' }}>Tạm khóa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mota">Mô Tả</label>
                <textarea class="form-control" name="mota" id="mota" rows="3" placeholder="Nhập mô tả">{{ old('mota', $trangthaiedits->mota) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection
