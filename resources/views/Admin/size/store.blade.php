@extends('Admin.size.show')
@section('noidung')
    <form action="{{ route('admin.edit-size', $sizeedits->id_size) }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h1 class="mb-4">{{ $title }}</h1>
            <div class="row">
                <div class="form-group">
                    <label for="sizeName"><b>Tên Size</b></label>
                    <input type="text" class="form-control" value="{{ $sizeedits->tensize }}" name="sizeName" id="sizeName"
                        placeholder="Nhập tên size">
                </div>
                <div class="form-group">
                    <label for="sizeStatus"><b>Trạng Thái</b></label>
                    <select class="form-control" name="sizeStatus" id="sizeStatus">
                        <option value="1" {{ $sizeedits->trangthai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $sizeedits->trangthai == 0 ? 'selected' : '' }}>Tạm khóa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </div>
    </form>
@endsection
