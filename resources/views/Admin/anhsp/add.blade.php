@extends('Admin.san-pham.show')
@section('noidung')
    <h4>{{ $title }}</h4>
    <form action="{{ route('admin.store-anh') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-danhmuc mt-5">
            <div class="col-md-6">
                <label for="id_sanpham"><b>Sản phẩm</b></label>
                <select class="form-control" id="id_sanpham" name="id_sanpham">
                    @foreach ($sanphams as $sanpham)
                        <option value="{{ $sanpham->id_sanpham }}">{{ $sanpham->tensanpham }}</option>
                    @endforeach
                </select>
            </div>

            <label for="anh"><b>Hình ảnh</b></label>
            <input type="file" name="alo[]" multiple>


            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('categoryDescription');
        
    </script>
@endsection
