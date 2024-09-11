@extends('Admin.index')
@section('content')
    <style>
        p {
            color: red;
        }

        h1 {
            font-weight: bold;
        }
    </style>
    <h4>{{ $title }}</h4>
    <form action="{{ route('admin.store-danh-muc') }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h1 class="mb-4">{{ $title }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categoryName"><b>Tên Danh Mục</b></label>
                        <input type="text" class="form-control" name="categoryName" id="categoryName"
                            placeholder="Nhập tên danh mục">
                        @if ($errors->has('categoryName'))
                            <p class="error-message">*
                                {{ $errors->first('categoryName') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="categoryStatus"><b>Trạng Thái</b></label>
                        <select class="form-control" name="categoryStatus" id="categoryStatus">
                            <option value="1">Hoạt động</option>
                            <option value="0">Tạm khóa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription"><b>Mô Tả</b></label>
                        <textarea class="form-control" name="categoryDescription" id="categoryDescription" rows="3"
                            placeholder="Nhập mô tả"></textarea>
                        @if ($errors->has('categoryDescription'))
                            <p class="error-message">*
                                {{ $errors->first('categoryDescription') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="hinhanh"><b>Hình ảnh</b></label>
                    <div id="drop-zone" class="p-3">
                        <div class="form-group mb-3 mt-1">
                            <input type="text" class="form-control text-decorate-none" id="file-preview" />
                        </div>
                        <p>Thêm ảnh ở đây</p>
                        <div id="file-count" class="mt-2">Đã thêm 0/1 file</div>
                        @if ($errors->has('file'))
                            <p class="error-message">*
                                {{ $errors->first('file') }}
                            </p>
                        @endif
                        <input type="file" class="form-control-file" id="hinhanh" name="hinhanh[]" multiple>
                        <div id="preview-zone" class="mt-3"></div>
                        <input type="hidden" name="file" id="file">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
    </form>
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('categoryDescription');
    </script>
@endsection
