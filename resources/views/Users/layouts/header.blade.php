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

    /* Định dạng giỏ hàng */
    .cart-menu {
        position: fixed;
        top: 0;
        right: 0;
        width: 500px;
        height: 100vh;
        background-color: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.3);
        transform: translateX(100%);
        transition: transform 0.3s ease;
        z-index: 1050;
        overflow-y: auto;
    }

    .cart-menu-content {
        padding: 20px;
        position: relative;
    }

    .cart-menu-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #333;
        z-index: 1060;
    }

    .overlay.show {
        opacity: 1;
        pointer-events: auto;
    }

    /* Cải thiện kiểu dáng cho giỏ hàng */
    .cart-items {
        margin-bottom: 20px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        position: relative;
    }

    .cart-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 15px;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-name {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .cart-item-size,
    .cart-item-quantity {
        margin-bottom: 5px;
        font-size: 0.9rem;
        color: #6c757d;
        display: inline-block;
        margin-left: 5px;
        font-weight: bold;
    }

    .cart-item-price {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .cart-item-description {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .cart-item-remove {
        background: none;
        border: none;
        font-size: 25px;
        color: #e74c3c;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .cart-item-remove:hover {
        color: #c0392b;
    }

    .cart-total {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .cart-total p {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .cart-total .btn {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        font-size: 1rem;
        text-transform: uppercase;
        border-radius: 5px;
    }

    .cart-total .btn:hover {
        background-color: #0056b3;
        border-color: #00408c;
    }

    .cart-check-out {
        width: 60%;
        border-color: #007bff;
        margin: 0 20% 0 20%;
    }

    .cart-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        padding: 3px 6px;
        border-radius: 50%;
        background-color: red;
        color: white;
        font-size: 12px;
    }

    /* Định dạng thông báo giỏ hàng */
    .cart-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        z-index: 9999;
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
                            <a class="dropdown-item" href="#">
                                {{ $danhmuc->tendanhmuc }}
                            </a>
                            <ul class="dropdown-menu-sub no-bullets" id="submenu-{{ $danhmuc->id_danhmuc }}">
                                @foreach ($danhmuccons->where('id_danhmuc', $danhmuc->id_danhmuc) as $danhmuccon)
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            {{ $danhmuccon->tendanhmuccon }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
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
                    <li><a class="dropdown-item" href="#"><i class='bx bx-edit'></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class='bx bx-cog'></i> Settings</a></li>
                    <li><a class="dropdown-item" href="#"><i class='bx bx-log-in'></i> Login</a></li>
                    <li><a class="dropdown-item" href="#"><i class='bx bx-registered'></i> Sign-up</a></li>
                    <li><a class="dropdown-item text-danger" href="#" onclick="confirmLogout(event)"><i
                                class='bx bx-log-out'></i> Logout</a></li>
                </ul>
            </li>
            <li class="nav-item d-flex">
                <a class="nav-link" href="#" id="cartDropdown" role="button">
                    <i class='bx bx-cart'></i>
                    <!-- Badge để hiển thị số lượng sản phẩm trong giỏ hàng -->
                    <span class="cart-badge" id="cartCount">0</span>
                </a>
            </li>
        </ul>
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
                window.location.href = '#'; // Thay đổi đường dẫn theo cấu hình của bạn
            }
        });
    }

    // Hàm để tính tổng tiền của các sản phẩm trong giỏ hàng
    function updateCartTotal() {
        let total = 0;
        const cartItems = document.querySelectorAll('.cart-item'); // Lấy tất cả sản phẩm trong giỏ hàng

        // Duyệt qua từng sản phẩm trong giỏ hàng
        cartItems.forEach(item => {
            const priceElement = item.querySelector('.cart-item-price');
            const price = parseFloat(priceElement.innerText.replace('$',
                '')); // Lấy giá sản phẩm và chuyển thành số
            total += price; // Cộng giá sản phẩm vào tổng
        });

        // Cập nhật tổng tiền trên giao diện
        document.getElementById('cartTotal').innerText = `$${total.toFixed(2)}`;
    }

    // Hàm để xóa sản phẩm khỏi giỏ hàng với xác nhận từ người dùng
    function deleteItem(element) {
        // Hiển thị thông báo xác nhận bằng SweetAlert2
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                const itemName = element.closest('.cart-item').querySelector('.cart-item-name')
                    .innerText; // Lấy tên sản phẩm
                element.closest('.cart-item').remove(); // Xóa phần tử sản phẩm khỏi giỏ hàng
                updateCartTotal(); // Cập nhật tổng tiền sau khi xóa sản phẩm
                const newCount = getCartItemsCount(); // Đếm số lượng sản phẩm còn lại
                updateCartCount(newCount); // Cập nhật số lượng sản phẩm trên biểu tượng giỏ hàng

                // Hiển thị thông báo đã xóa sản phẩm thành công
                Swal.fire(
                    'Đã xóa!',
                    `${itemName} đã được xóa khỏi giỏ hàng.`,
                    'success'
                );
            }
        });
    }

    // Hàm để đếm số lượng sản phẩm hiện có trong giỏ hàng
    function getCartItemsCount() {
        return document.querySelectorAll('.cart-item').length; // Đếm tất cả các phần tử có lớp cart-item
    }

    // Hàm để cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
    function updateCartCount(count) {
        const cartCountElement = document.getElementById("cartCount"); // Lấy phần tử hiển thị số lượng sản phẩm
        cartCountElement.textContent = count; // Cập nhật số lượng sản phẩm

        // Nếu giỏ hàng không có sản phẩm, hiển thị "0"
        if (count === 0) {
            cartCountElement.textContent = '0';
            cartCountElement.style.display = 'block'; // Luôn hiển thị badge với số "0"
        } else {
            cartCountElement.style.display = 'block'; // Hiển thị badge nếu có sản phẩm
        }
    }

    // Khi trang web được tải, tính tổng tiền ban đầu và số lượng sản phẩm trong giỏ hàng
    document.addEventListener('DOMContentLoaded', () => {
        updateCartTotal(); // Cập nhật tổng tiền
        updateCartCount(getCartItemsCount()); // Cập nhật số lượng sản phẩm trên biểu tượng giỏ hàng
    });

    //nút tìm kiếm
    // Khi bấm vào biểu tượng tìm kiếm
    document.getElementById('searchToggle').addEventListener('click', function(e) {
        e.preventDefault();
        const searchContainer = document.getElementById('searchContainer');

        // Kiểm tra trạng thái hiển thị của ô tìm kiếm
        if (searchContainer.style.display === 'none' || searchContainer.style.width === '0px') {
            searchContainer.style.display = 'block';
            anime({
                targets: '#searchContainer',
                width: '250px',
                easing: 'easeInOutQuad',
                duration: 500
            });
        } else {
            // // Nếu ô tìm kiếm đã mở, thu nhỏ ô tìm kiếm về kích thước 0
            // anime({
            //     targets: '#searchContainer',
            //     width: '0',
            //     easing: 'easeInOutQuad',
            //     duration: 500,
            //     complete: function() {
            //         searchContainer.style.display = 'none';
            //         document.getElementById('searchInput').value = ''; // Xóa nội dung ô tìm kiếm
            //     }
            // });
        }
    });

    // Khi bấm vào dấu x
    document.getElementById('closeSearch').addEventListener('click', function(e) {
        e.preventDefault();
        const searchContainer = document.getElementById('searchContainer');

        anime({
            targets: '#searchContainer',
            width: '0',
            easing: 'easeInOutQuad',
            duration: 500,
            complete: function() {
                searchContainer.style.display = 'none';
                document.getElementById('searchInput').value = ''; // Xóa nội dung ô tìm kiếm
            }
        });
    });
</script>
