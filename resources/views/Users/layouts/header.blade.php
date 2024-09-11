<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<style>
    /* Định dạng logo */
    #logo img {
        max-height: 50px;
        mix-blend-mode: multiply;
    }

    /* Định dạng thanh điều hướng (Navbar) */
    .navbar {
        margin-bottom: 0;
        width: 100%;
        padding-right: 20%;
        padding-left: 20%;
        background-color: rgb(223, 223, 223) !important;
    }

    /* Định dạng liên kết trong thanh điều hướng */
    .nav-link {
        position: relative;
    }

    .navbar .nav-link i {
        font-size: 24px;
        color: #333;
    }

    .navbar .nav-link i:hover {
        color: #007bff;
    }

    /* Định dạng cho phần danh mục trong Navbar */
    .navbar .nav-item.dropdown {
        position: relative;
    }

    .navbar .nav-item.dropdown:hover>.dropdown-menu {
        display: block;
        margin-top: 0;
    }

    /* Định dạng danh mục trong Navbar */
    .navbar .dropdown-menu {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .navbar .nav-item.dropdown:hover .dropdown-menu {
        opacity: 1;
    }

    .navbar .dropdown-menu .dropdown-item {
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        display: block;
        text-align: center;
        list-style-type: none;
    }

    .navbar .dropdown-menu ul.no-bullets {
        list-style-type: none;
        padding: 0 15px;
        margin: 0;
    }

    .navbar .dropdown-menu ul li::before {
        padding-left: 20px;
        background-size: 1em 1em;
    }

    .navbar .dropdown-menu .dropdown-item:hover {
        background-color: #f1f1f1;
        color: #007bff;
    }

    .navbar .dropdown-menu>.dropdown-header {
        padding: 10px 15px;
        font-weight: bold;
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
        color: #333;
    }

    /* Hiệu ứng chuyển động cho menu con của danh mục */
    .dropdown-menu .dropdown-menu {
        left: 100%;
        top: 0;
        margin-top: -1px;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
        position: absolute;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        will-change: transform, box-shadow;
    }

    .navbar .dropdown-menu .dropdown-item:hover>.dropdown-menu {
        display: block;
        opacity: 1;
        margin-top: 0;
    }

    /* Định dạng các mục danh mục con trong menu dropdown */
    .dropdown-menu-sub {
        display: none;
        position: absolute;
        min-height: 150px;
        /* height: auto; */
        left: 100%;
        top: 0;
        z-index: 1000;
        text-decoration: none;
        background-color: rgb(255, 255, 255);
        border-radius: 0 5px 5px 0;
    }

    .dropdown-item-parent:hover .dropdown-menu-sub {
        display: block;
    }

    /* Định dạng khung tìm kiếm với hiệu ứng tròn và bóng đổ */
    #searchContainer {
        position: relative;
        width: 0;
        overflow: hidden;
    }

    #searchInput {
        width: 100%;
        border: none;
        padding: 8px 35px 8px 15px;
        border-radius: 20px;
        font-size: 16px;
        color: #333;
        background-color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        will-change: transform, box-shadow;
    }

    #searchInput:focus {
        border-color: #9e9e9e;
        outline: none;
        background-color: #fff;
    }

    #closeSearch {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #333;
        font-size: 18px;
        background-color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        will-change: transform, box-shadow;
    }

    #closeSearch:hover {
        color: #ff0000;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between align-items-center">
    <div id="logo">
        <a href="{{ route('user.index') }}">
            <img src="/assets/images/logo7.png" alt="logo">
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-labelledby="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('user.index') }}">Trang chủ</a>
            </li>
            <!-- Danh mục -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="danhmucDropdown" role="button"
                    aria-expanded="false">
                    Danh mục
                </a>
                <ul class="dropdown-menu" aria-labelledby="danhmucDropdown">
                    @foreach ($danhmucs as $danhmuc)
                        <li class="dropdown-item-parent" data-id="{{ $danhmuc->id_danhmuc }}">
                            <a class="dropdown-item" href="{{ route('user.danhmuc', $danhmuc->id_danhmuc) }}">
                                {{ $danhmuc->tendanhmuc }}
                            </a>
                            {{-- <ul class="dropdown-menu-sub no-bullets" id="submenu-{{ $danhmuc->id_danhmuc }}">
                                @foreach ($danhmuccons->where('id_danhmuc', $danhmuc->id_danhmuc) as $danhmuccon)
                                    <li>
                                        <a class="dropdown-item" href="{{route('user.danhmuccon', $danhmuccon->id_danhmuccon)}}">
                                            {{ $danhmuccon->tendanhmuccon }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul> --}}
                        </li>
                    @endforeach
                </ul>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="#">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Liên hệ</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto mt-1">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Search Icon hidden-->
                <div id="searchContainer" style="display: none;">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm..." class="form-control">
                    <a href="#" id="closeSearch"><i class='bx bx-x'></i></a>
                </div>
                <!-- Icon tìm kiếm -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="searchToggle" role="button">
                        <i class='bx bx-search'></i>
                    </a>
                </li>
            </div>
            <!-- User Icon with Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-user'></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    @auth
                        <li><span class="dropdown-item">{{ Auth::user()->name }}</span></li>
                        <li><a class="dropdown-item" href="#"><i class='bx bx-edit'></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class='bx bx-cog'></i> Settings</a></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="confirmLogout(event)"><i
                                    class='bx bx-log-out'></i> Logout</a></li>
                    @else
                        <li><a class="dropdown-item" href="#"><i class='bx bx-log-in'></i> Login</a></li>
                        <li><a class="dropdown-item" href="#"><i class='bx bx-registered'></i> Sign-up</a></li>
                    @endauth
                </ul>
                @auth
                <li class="nav-item d-flex">
                    {{-- <a class="nav-link" href="#" id="cartDropdown" role="button"> --}}
                    <a class="nav-link" href="{{ route('user.giohangshow') }}" role="button">
                        <i class='bx bx-cart'></i>
                        <!-- Badge để hiển thị số lượng sản phẩm trong giỏ hàng -->
                        <span class="cart-badge" id="cartCount">0</span>
                    </a>
                </li>
            @endauth
            </li>
        </ul>
    </div>
</nav>
