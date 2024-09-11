@extends('Admin.san-pham.show')
@section('noidung')
    <form action="{{ route('admin.edit-san-pham', $sanphamedits->id_sanpham) }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF Token -->
        <div class="container-danhmuc mt-5">
            <h1 class="mb-3">{{ $title }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mota"><b>Mô tả</b></label>
                        <textarea class="form-control" id="mota" name="mota" rows="3" placeholder="Nhập mô tả sản phẩm">{{ $sanphamedits->mota }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="motachitiet"><b>Mô tả chi tiết</b></label>
                        <textarea class="form-control" id="motachitiet" name="motachitiet" rows="3" placeholder="Nhập mô tả sản phẩm">{{ $sanphamedits->motachitiet }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tensanpham"><b>Tên sản phẩm</b></label>
                            <input type="text" class="form-control" id="tensanpham"
                                value="{{ $sanphamedits->tensanpham }}" name="tensanpham" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="col-md-6">
                            <label for="id_danhmuc"><b>Danh mục</b></label>
                            <select class="form-control" id="id_danhmuc" name="id_danhmuc">
                                @foreach ($danhmucs as $danhmuc)
                                    <option value="{{ $danhmuc->id_danhmuc }}"
                                        {{ $sanphamedits->id_danhmuc == $danhmuc->id_danhmuc ? 'selected' : '' }}>
                                        {{ $danhmuc->tendanhmuc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gia"><b>Giá</b></label>
                                <input type="number" class="form-control" value="{{ $sanphamedits->gia }}" id="gia"
                                    name="gia" placeholder="Nhập giá sản phẩm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sale"><b>Sale (%)</b></label>
                                <input type="number" class="form-control" id="sale" value="{{ $sanphamedits->sale }}"
                                    name="sale" placeholder="Nhập phần trăm giảm giá">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="soluong"><b>Số lượng</b></label>
                                <input type="number" class="form-control" id="soluong"
                                    value="{{ $sanphamedits->soluong }}" name="soluong"
                                    placeholder="Nhập số lượng sản phẩm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="trangthai"><b>Trạng thái</b></label>
                                <select class="form-control" id="trangthai" name="trangthai">
                                    <option value="1" {{ $sanphamedits->trangthai == 1 ? 'selected' : '' }}>Hoạt động
                                    </option>
                                    <option value="0" {{ $sanphamedits->trangthai == 0 ? 'selected' : '' }}>Tạm khóa
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="hinhanh"><b>Hình ảnh</b></label>
                            <div id="drop-zone" class="p-3">
                                <div class="form-group mb-3 mt-1">
                                    <input type="text" name="file" class="form-control text-decorate-none" id="file-preview" />
                                </div>
                                <p>Thêm ảnh ở đây</p>
                                <div id="file-count" class="mt-2">Đã thêm 0/1 file</div>
                                <input type="file" class="form-control-file" id="hinhanh" name="hinhanh">
                                <div id="preview-zone" name="file-hinhanh" class="mt-3">
                                    @if ($sanphamedits->hinhanh)
                                        <img src="{{ $sanphamedits->hinhanh }}" class="img-thumbnail mb-2"
                                            style="max-height: 150px; width: auto;">
                                    @else
                                        <p>Chưa có hình ảnh</p>
                                    @endif
                                </div>
                                <input type="hidden" name="file" id="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lưu thay đổi</button>
        </div>
    </form>
@endsection
