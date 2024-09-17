@extends('Users.index')
@section('main')
    <style>
        .container-avatar-wrapper {
            display: flex;
            /* Hiển thị Flexbox để xếp hàng ngang */
            justify-content: space-between;
            /* Khoảng cách giữa các avatar */
            gap: 20px;
            /* Tạo khoảng cách giữa hai avatar (tùy chỉnh theo nhu cầu) */
            margin-top: 50px;
        }

        .container-avatar {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #e4e4e4;
            position: relative;
            border-radius: 50%;
            height: 250px;
            width: 250px;
            z-index: 100;
            overflow: hidden;
            outline: none;
        }

        .avatar {
            width: 100%;
            /* Đảm bảo ảnh lấp đầy khung */
            height: 100%;
            background-size: cover;
            border-radius: 50%;
            /* Để avatar có hình tròn */
            object-fit: cover;
            /* Đảm bảo ảnh được cắt gọn vừa với kích thước */
        }


        .container-profile {
            background-color: #fff;
            /* Màu nền trắng để làm nổi bật */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            /* Làm cho bóng mềm hơn */
            padding: 20px;
            /* Tạo khoảng cách trong khung */
            transition: all 0.3s ease-in-out;
            /* Hiệu ứng chuyển đổi mượt */
        }

        .container-profile:hover {
            transform: translateY(-5px);
            /* Hiệu ứng nổi khi hover */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            /* Bóng mạnh hơn khi hover */
        }
    </style>
    <title>{{ $title }}</title>
    <div id="editUserForm" class="container container-profile mt-5 mb-5">
        <h2>{{ $title }}</h2>
        <form action="{{ route('user.update-profile', $users->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" class="form-control" class="avatar" id="avatar">
                        <input type="text" id="preview" name="avatar" style="width: 500px; margin-left: 60px; border: none; outline: none;" class="mt-2">
                        <div class="container-avatar-wrapper">
                            <div class="container-avatar">
                                <img src="{{ $users->avatar }}" class="avatar" alt="User Avatar">
                            </div>
                            <div class="container-avatar">
                                <img id="avatarPreview" src="" class="avatar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $users->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $users->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Nếu có thay đổi" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $users->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $users->address }}">
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

    <script>
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    // Cập nhật thuộc tính src của thẻ img để hiển thị ảnh xem trước
                    document.getElementById('avatarPreview').src = event.target.result;
                }
                // Đọc file được chọn
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
