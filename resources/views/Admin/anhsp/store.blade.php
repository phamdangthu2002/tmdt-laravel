@extends('Admin.danh-muc.show')
@section('noidung')
    <form action="{{ route('admin.edit-danh-muc', $danhmucedits->id_danhmuc) }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h2 class="mb-4">{{ $title }}</h2>
            <div class="form-group">
                <label for="categoryName">Tên Danh Mục</label>
                <input type="text" value="{{ old('categoryName', $danhmucedits->tendanhmuc) }}" class="form-control"
                    name="categoryName" id="categoryName" placeholder="Nhập tên danh mục">
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
            <div class="row">
                <div class="col-md-12">
                    <label for="hinhanh"><b>Hình ảnh</b></label>
                    <div id="drop-zone" class="p-3">
                        <div class="form-group mb-3 mt-1">
                            <input type="text" class="form-control text-decorate-none" id="file-preview" />
                        </div>
                        <p>Thêm ảnh ở đây</p>
                        <div id="file-count" class="mt-2">Đã thêm 0/1 file</div>
                        <input type="file" class="form-control-file" id="hinhanh" name="hinhanh">
                        <div id="preview-zone" name="file-hinhanh" class="mt-3">
                            @if ($danhmucedits->hinhanh)
                                <img src="{{ $danhmucedits->hinhanh }}" class="img-thumbnail mb-2"
                                    style="max-height: 150px; width: auto;">
                            @else
                                <p>Chưa có hình ảnh</p>
                            @endif
                        </div>
                        <input type="hidden" name="file" id="file">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
@endsection
