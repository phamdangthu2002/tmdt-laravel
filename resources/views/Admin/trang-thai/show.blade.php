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
                                <th scope="col">Tên trạng thái</th>
                                <th scope="col">Mô Tả</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Cập nhật</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($trangthais) != 0)
                                @foreach ($trangthais as $trangthai)
                                    <tr>
                                        <td>{{ $trangthai->id_trangthai }}</td>
                                        <td>{{ $trangthai->tentrangthai }}</td> <!-- Swap with the correct column -->
                                        <td>{{ $trangthai->mota }}</td>
                                        <td>
                                            @if ($trangthai->trangthai == 1)
                                                <span class="text-success">Hoạt động</span>
                                            @else
                                                <span class="text-danger">Tạm khóa</span>
                                            @endif
                                        </td>
                                        <td>{{ $trangthai->updated_at }}</td>
                                        <td>
                                            <!-- Nút sửa -->
                                            <a href="{{ route('admin.edit.trangthai', $trangthai->id_trangthai) }}"
                                                class="btn btn-outline-warning bx bx-edit"></a>
                                            <!-- Form xóa với SweetAlert -->
                                            <form action="{{ route('admin.delete-trangthai', $trangthai->id_trangthai) }}"
                                                method="post" class="delete-form" style="display:inline;"
                                                data-name="{{ $trangthai->tentrangthai }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger bx bx-trash"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Không có trạng thái nào để hiển thị.</td>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lắng nghe sự kiện submit của tất cả các form xóa
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Ngăn chặn hành vi mặc định của form

                    const form = event.target;
                    const categoryName = form.getAttribute(
                        'data-name'); // Lấy tên danh mục từ thuộc tính data-name

                    Swal.fire({
                        title: `Bạn có chắc chắn muốn xóa trạng thái "${categoryName}" này không?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Nếu người dùng xác nhận, thực hiện submit form
                        }
                    });
                });
            });
        });
    </script>
@endsection
