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
                                <th scope="col">Tên Danh Mục</th>
                                <th scope="col">Mô Tả</th>
                                <th scope="col">Image</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Cập nhật</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($danhmucs) != 0)
                                @foreach ($danhmucs as $danhmuc)
                                    <tr>
                                        <td>{{ $danhmuc->id_danhmuc }}</td>
                                        <td>{{ $danhmuc->tendanhmuc }}</td> <!-- Swap with the correct column -->
                                        <td>{{ $danhmuc->mota }}</td>
                                        <td><img src="{{ asset($danhmuc->hinhanh) }}" class="img-thumbnail mb-2"
                                                style="max-height: 50px; width: auto;"></td>
                                        </td>
                                        <td>
                                            @if ($danhmuc->trangthai == 1)
                                                <span class="text-success">Hoạt động</span>
                                            @else
                                                <span class="text-danger">Tạm khóa</span>
                                            @endif
                                        </td>
                                        <td>{{ $danhmuc->updated_at }}</td>
                                        <td>
                                            <!-- Nút sửa -->
                                            <a href="{{ route('admin.store-edit-danh-muc', $danhmuc->id_danhmuc) }}"
                                                class="btn btn-outline-warning bx bx-edit"></a>
                                            <!-- Form xóa với SweetAlert -->
                                            <form action="{{ route('admin.delete-danh-muc', $danhmuc->id_danhmuc) }}"
                                                method="post" class="delete-form" style="display:inline;"
                                                data-name="{{ $danhmuc->tendanhmuc }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger bx bx-trash"></button>
                                            </form>
                                        </td>
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
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('categoryDescription');
    </script>
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
                        title: `Bạn có chắc chắn muốn xóa danh mục "${categoryName}" này không?`,
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
