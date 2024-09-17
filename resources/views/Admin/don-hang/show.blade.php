@extends('Admin.index')
@section('content')
    <h4>{{ $title }}</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="container-danhmuc main-data mt-5">
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
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($donhangs)
                                @foreach ($donhangs as $donhang)
                                    <tr>
                                        <td>{{ $donhang->id_donhang }}</td>
                                        <td>{{ $donhang->user->name }}</td>
                                        <td>{{ $donhang->sanpham->tensanpham }}</td>
                                        <td>{{ $donhang->tong }}</td>
                                        <td>{{ $donhang->trangthais->tentrangthai }}</td>
                                        <td><a href="{{ route('admin.editdonhang', $donhang->id_donhang) }}"
                                                class="btn btn-outline-warning bx bx-edit"></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Không có danh mục nào để hiển thị.</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @yield('noidung')
        </div>
    </div>
@endsection
