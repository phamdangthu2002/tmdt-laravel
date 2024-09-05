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
    {{-- {{dd($danhmucs)}} --}}
    <form action="{{ route('admin.store-danh-muc-con') }}" method="post">
        @csrf
        <div class="container-danhmuc mt-5">
            <h1 class="mb-4">{{ $title }}</h1>
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
                <label for="id_danhmuc"><b>Chọn Danh Mục Cha</b></label>
                <select class="form-control" name="id_danhmuc" id="id_danhmuc">
                    @foreach ($danhmucs as $danhmuc)
                        <option value="{{ $danhmuc->id_danhmuc }}">{{ $danhmuc->tendanhmuc }}</option>
                    @endforeach
                </select>
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
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
    </form>
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('categoryDescription');
    </script>
@endsection
