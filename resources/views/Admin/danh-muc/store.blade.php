@extends('Admin.danh-muc.show')
@section('noidung')
    <form action="{{ route('admin.edit-danh-muc', $danhmucedits->id_danhmuc) }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h2 class="mb-4">{{ $title }}</h2>
            <div class="form-group">
                <label for="categoryName">Tên Danh Mục</label>
                <input type="text" value="{{ old('categoryName', $danhmucedits->tendanhmuc) }}" class="form-control" name="categoryName" id="categoryName"
                    placeholder="Nhập tên danh mục">
                @if ($errors->has('categoryName'))
                    <p class="error-message">*
                        {{ $errors->first('categoryName') }}
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label for="categoryStatus">Trạng Thái</label>
                <select class="form-control" name="categoryStatus" id="categoryStatus">
                    <option value="1" {{ $danhmucedits->trangthai == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $danhmucedits->trangthai == 0 ? 'selected' : '' }}>Tạm khóa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="categoryDescription">Mô Tả</label>
                <textarea class="form-control" name="categoryDescription" id="categoryDescription" rows="3"
                    placeholder="Nhập mô tả">{{ old('categoryDescription', $danhmucedits->mota) }}</textarea>
                @if ($errors->has('categoryDescription'))
                    <p class="error-message">*
                        {{ $errors->first('categoryDescription') }}
                    </p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection
