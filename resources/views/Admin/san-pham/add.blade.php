@extends('Admin.index')
@section('content')
    <h4>{{ $title }}</h4>
    <style>
        .error-message {
            color: red !important;
        }
    </style>

    <form action="{{ route('admin.store-san-pham') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF Token -->
        <div class="container-danhmuc mt-5">
            <h1 class="mb-3">{{ $title }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mota"><b>Mô tả</b></label>
                        <textarea class="form-control" id="mota" name="mota" rows="3" placeholder="Nhập mô tả sản phẩm">{{ old('mota') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="motachitiet"><b>Mô tả chi tiết</b></label>
                        <textarea class="form-control" id="motachitiet" name="motachitiet" rows="3" placeholder="Nhập mô tả sản phẩm">{{ old('motachitiet') }}</textarea>
                    </div>
                    @if ($errors->has('mota'))
                        <p class="error-message">*
                            {{ $errors->first('mota') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tensanpham"><b>Tên sản phẩm</b></label>
                            <input type="text" class="form-control" id="tensanpham" value="{{ old('tensanpham') }}"
                                name="tensanpham" placeholder="Nhập tên sản phẩm">
                            @if ($errors->has('tensanpham'))
                                <p class="error-message">*
                                    {{ $errors->first('tensanpham') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="id_danhmuc"><b>Danh mục</b></label>
                            <select class="form-control" id="id_danhmuc" name="id_danhmuc">
                                <!-- Duyệt qua danh sách các danh mục -->
                                @foreach ($danhmucs as $danhmuc)
                                    <option value="{{ $danhmuc->id_danhmuc }}">{{ $danhmuc->tendanhmuc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gia"><b>Giá</b></label>
                                <input type="number" class="form-control" value="{{ old('gia') }}" id="gia"
                                    name="gia" placeholder="Nhập giá sản phẩm">
                                @if ($errors->has('gia'))
                                    <p class="error-message">*
                                        {{ $errors->first('gia') }}
                                    </p>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sale"><b>Sale (%)</b></label>
                                <input type="number" class="form-control" id="sale" value="{{ old('sale') }}"
                                    name="sale" placeholder="Nhập phần trăm giảm giá">
                                @if ($errors->has('sale'))
                                    <p class="error-message">*
                                        {{ $errors->first('sale') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="soluong"><b>Số lượng</b></label>
                                <input type="number" class="form-control" id="soluong" value="{{ old('soluong') }}"
                                    name="soluong" placeholder="Nhập số lượng sản phẩm">
                                @if ($errors->has('soluong'))
                                    <p class="error-message">*
                                        {{ $errors->first('soluong') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="trangthai"><b>Trạng thái</b></label>
                                <select class="form-control" id="trangthai" name="trangthai">
                                    <option value="1" {{ old('trangthai') == '1' ? 'selected' : '' }}>Hiển thị
                                    </option>
                                    <option value="0" {{ old('trangthai') == '0' ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>
                        </div>
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
                                @if ($errors->has('file'))
                                    <p class="error-message">*
                                        {{ $errors->first('file') }}
                                    </p>
                                @endif
                                <input type="file" class="form-control-file" id="hinhanh" name="hinhanh" multiple>
                                <div id="preview-zone" class="mt-3"></div>
                                <input type="hidden" name="file" id="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm sản phẩm</button>
        </div>
    </form>
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        // Khởi tạo CKEditor cho trường mô tả (mota)
        CKEDITOR.replace('motachitiet');
    </script>
@endsection
