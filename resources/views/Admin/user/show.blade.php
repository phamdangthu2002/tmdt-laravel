@extends('Admin.index')
@section('content')
    <h4>{{ $title }}</h4>

    <div class="container-danhmuc main-data mt-5">
        <h2 class="mb-4">{{ $title }}</h2>
        <div class="table-responsive">
            <table id="table_js" class="table table-striped" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Cập nhật</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) != 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <img src="{{ asset($user->avatar) }}" alt="" width="50">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>
                                    @if ($user->role == 1)
                                        <span class="badge badge-success text-success">Admin</span>
                                    @else
                                        <span class="badge badge-primary text-danger">User</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->trangthai == 1)
                                        <span class="text-success">Hoạt động</span>
                                    @else
                                        <span class="text-danger">Tạm khóa</span>
                                    @endif
                                </td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <!-- Nút sửa -->
                                    <a href="{{ route('admin.store.user', $user->id) }}"
                                        class="btn btn-outline-warning bx bx-edit"></a>
                                    <!-- Form xóa với SweetAlert -->
                                    <form action="{{ route('admin.delete.user', $user->id) }}" method="post"
                                        class="delete-form" style="display:inline;" data-name="{{ $user->name }}">
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
    @yield('noidung')
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
                        title: `Bạn có chắc chắn muốn xóa người dùng "${categoryName}" này không?`,
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
