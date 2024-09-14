@extends('Admin.index')
@section('content')
    <h4>{{ $title }}</h4>
    <form action="{{ route('admin.store-anh', $sanphams->id_sanpham) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-danhmuc mt-5">
            <div class="col-md-6">
                <label for="id_sanpham"><b>Sản phẩm</b></label>
                <h3><span class="badge badge-success text-success">{{ $sanphams->tensanpham }}</span></h3>
            </div>

            <label for="anh"><b>Hình ảnh</b></label>
            <input type="file" name="alo[]" multiple>


            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
    @include('Admin.anhsp.show')
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('categoryDescription');
    </script>
@endsection
