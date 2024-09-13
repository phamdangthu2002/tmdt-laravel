<style>
    #logo {
        width: 80%;
        padding-left: 10%;
        text-align: center;
        justify-content: center;
        justify-items: center;
        margin-bottom: 50px;
    }

    .sidebar {
        text-decoration: none;
        width: 80%;
        margin-left: 10%;
        font-size: 17px;
    }

    .sidebar a {
        color: black;
        text-decoration: none;
    }

    .sidebar a:hover {
        /* background-color: #818181be; */
        color: rgb(50, 219, 50);
    }

    .content {
        margin-left: 250px;
        padding: 20px;
    }

    .submenu {
        padding-left: 20px;
    }

    .submenu .nav-link {
        font-size: 0.9em;
    }

    .no-bullets li {
        list-style-type: none;
    }

    .sidebar .boder-sidebar {
        border-radius: 15px;
    }
</style>
<nav id="sidebar">
    <div class="sidebar p-2">
        <div onclick="window.location.href='{{ route('admin.index') }}';" style="cursor: pointer;">
            <img id="logo" src="/assets/images/logo7.png" alt="Logo">
        </div>
        <ul class="nav flex-column no-bullets">
            <li class="nav-item">
                <a class="nav-link active bx bx-home boder-sidebar" href="{{ route('admin.index') }}"> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link boder-sidebar bx bx-user" data-bs-toggle="collapse" href="#user" role="button"
                    aria-expanded="false" aria-controls="user">
                    User
                </a>
                <ul class="collapse submenu" id="user">
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-add-to-queue"
                            href="{{ route('admin.create.user') }}"> Thêm người dùng</a>
                    </li>
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-cog" href="{{ route('admin.show.user') }}"> Quản lý người dùng</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link boder-sidebar bx bx-package" data-bs-toggle="collapse" href="#sanpham" role="button"
                    aria-expanded="false" aria-controls="sanpham">
                    Products
                </a>
                <ul class="collapse submenu" id="sanpham">
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-add-to-queue"
                            href="{{ route('admin.create-san-pham') }}"> Thêm sản phẩm mới</a>
                    </li>
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-cog" href="{{ route('admin.show-san-pham') }}"> Quản lý
                            sản phẩm</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link boder-sidebar bx bxs-category" data-bs-toggle="collapse" href="#danhmuc"
                    role="button" aria-expanded="false" aria-controls="danhmuc">
                    Categories
                </a>
                <ul class="collapse submenu" id="danhmuc">
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-add-to-queue"
                            href="{{ route('admin.create-danh-muc') }}"> Thêm danh mục</a>
                    </li>
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-cog" href="{{ route('admin.show-danh-muc') }}"> Quản lý
                            danh mục</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link boder-sidebar bx bx-image-add" data-bs-toggle="collapse" href="#slider"
                    role="button" aria-expanded="false" aria-controls="slider">
                    Slider
                </a>
                <ul class="collapse submenu" id="slider">
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-add-to-queue" href="{{ route('admin.create-slider') }}">
                            Thêm slider</a>
                    </li>
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-cog" href="{{ route('admin.show-slider') }}"> Quản lý
                            slider</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link boder-sidebar bx bx-image" data-bs-toggle="collapse" href="#anh" role="button"
                    aria-expanded="false" aria-controls="anh">
                    Ảnh Sản phẩm
                </a>
                <ul class="collapse submenu" id="anh">
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-add-to-queue" href="{{ route('admin.add-anh') }}"> Thêm
                            ảnh</a>
                    </li>
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-cog" href="#"> Quản lý ảnh</a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link boder-sidebar bx bx-stats" data-bs-toggle="collapse" href="#trangthai" role="button"
                    aria-expanded="false" aria-controls="trangthai">
                    Trạng thái
                </a>
                <ul class="collapse submenu" id="trangthai">
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-add-to-queue" href="{{ route('admin.trangthai') }}">
                            Thêm trạng thái
                        </a>
                    </li>
                    <li>
                        <a class="nav-link boder-sidebar bx bxs-cog" href="{{route('admin.show.trangthai')}}"> Quản lý trạng thái</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
