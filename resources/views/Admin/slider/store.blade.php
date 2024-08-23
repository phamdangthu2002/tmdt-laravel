@extends('Admin.slider.show')
@section('noidung')
    <form action="{{ route('admin.edit-slider', $slideredits->id_slider) }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF Token -->
        <div class="container-danhmuc mt-5">
            <h1 class="mb-3">{{ $title }}</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="form-group">
                            <label for="name"><b>Tên slider</b></label>
                            <input type="text" class="form-control" value="{{ $slideredits->name }}" id="name"
                                name="name" placeholder="Nhập tên tên slider">
                        </div>
                        <div class="form-group">
                            <label for="url"><b>URL slider</b></label>
                            <input type="text" class="form-control" value="{{ $slideredits->url }}" id="url"
                                name="url" placeholder="Nhập Url slider">
                        </div>
                        <div class="form-group">
                            <label for="sort_by"><b>Sắp xếp</b></label>
                            <input type="text" class="form-control" value="{{ $slideredits->sort_by }}" id="sort_by"
                                name="sort_by" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="trangthai"><b>Trạng thái</b></label>
                            <select class="form-control" id="trangthai" name="trangthai">
                                <option value="1" {{ $slideredits->trangthai == 1 ? 'selected' : '' }}>Hoạt động
                                </option>
                                <option value="0" {{ $slideredits->trangthai == 0 ? 'selected' : '' }}>Tạm khóa
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="hinhanh"><b>Hình ảnh</b></label>
                    <div id="drop-zone" class="p-3">
                        <div class="form-group mb-3 mt-1">
                            <input type="text" class="form-control text-decorate-none" id="file-preview" />
                        </div>
                        <p>Thêm ảnh ở đây</p>
                        <div id="file-count" class="mt-2">Đã thêm 0/1 file</div>
                        <input type="file" class="form-control-file" id="hinhanh" name="hinhanh">
                        <div id="preview-zone" name="file-hinhanh" class="mt-3">
                            @if ($slideredits->hinhanh)
                                <img src="{{ $slideredits->hinhanh }}" class="img-thumbnail mb-2"
                                    style="max-height: 150px; width: auto;">
                            @else
                                <p>Chưa có hình ảnh</p>
                            @endif
                        </div>
                        <input type="hidden" name="file" id="file">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lưu thay đổi</button>
        </div>
    </form>
@endsection
