<style>
    #header {
        border-bottom: 1px solid black;
        border-top: 1px solid black;
    }
</style>
<nav id="header" class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.index') }}">
            <h2>Trang Admin</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Auth/users/logout" onclick="confirmLogout(event)">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    // Hàm xác nhận đăng xuất
    function confirmLogout(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

        Swal.fire({
            title: 'Bạn có chắc chắn muốn đăng xuất?',
            text: "Bạn sẽ bị đưa trở lại trang đăng nhập.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đăng xuất',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/Auth/users/logout'; // Thay đổi đường dẫn theo cấu hình của bạn
            }
        });
    }
</script>
