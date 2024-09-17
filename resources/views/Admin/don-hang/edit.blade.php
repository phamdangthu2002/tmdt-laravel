@extends('Admin.don-hang.show')
@section('noidung')
    <div class="container-danhmuc main-data mt-5">
        <form action="{{ route('admin.updateStatus') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $donhangedits->id_donhang }}" name="id_donhang">
            <h2 class="mb-4">{{ $title }}</h2>
            <div class="table-responsive">
                <table id="table_js" class="table table-striped" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên khác hàng</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $donhangedits->id_donhang }}</td>
                            <td>{{ $donhangedits->user->name }}</td>
                            <td>{{ $donhangedits->sanpham->tensanpham }}</td>
                            <td>{{ $donhangedits->tong }}</td>
                            <td>{{ $donhangedits->trangthais->tentrangthai }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <h3><b><label for="trangthai">Trạng thái</label></b></h3>
                {{-- Kiểm tra nếu trạng thái chưa được chọn --}}
                @foreach ($trangthais as $trangthai)
                    @if ($donhangedits->id_trangthai !== $trangthai->id_trangthai)
                        @if ($donhangedits->id_trangthai == 4 || $donhangedits->id_trangthai == 5 || $donhangedits->id_trangthai == 6)
                            <label for="">...</label>
                        @else
                            <div class="form-check">
                                <input type="radio" class="form-check-input"
                                    {{ $donhangedits->id_trangthai == $trangthai->id_trangthai ? 'checked' : '' }}
                                    name="id_trangthai" value="{{ $trangthai->id_trangthai }}">
                                <label class="form-check-label"
                                    for="{{ $trangthai->id_trangthai }}">{{ $trangthai->tentrangthai }}</label>
                            </div>
                        @endif
                    @endif
                @endforeach
                @if ($donhangedits->id_trangthai == 4 || $donhangedits->id_trangthai == 5 || $donhangedits->id_trangthai == 6)
                    <label for="">...</label>
                @else
                    <button type="submit" class="btn btn-primary mt-4">Lưu</button>
                @endif
            </div>
        </form>
    </div>
@endsection
