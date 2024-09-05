<!-- Scripts -->
<script src="/assets/vendor/jquery-3.7.1.js"></script>
<script src="/assets/vendor/popper.min.js"></script>
<script src="/assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="/assets/vendor/sweetalert2@11.js"></script>

<script>
    // Lấy các phần tử DOM
    const overlay = document.getElementById('overlay');

    // Mở giỏ hàng và làm mờ phần còn lại của trang
    document.getElementById('cartDropdown').addEventListener('click', function() {
        cartMenu.style.transform = 'translateX(0)';
        overlay.classList.add('show');
        document.body.classList.add('blurred');
    });

    // Đóng giỏ hàng và hủy bỏ làm mờ
    function closeCartMenu() {
        cartMenu.style.transform = 'translateX(100%)';
        overlay.classList.remove('show');
        document.body.classList.remove('blurred');
    }

    // Đóng giỏ hàng khi nhấn vào lớp phủ
    overlay.addEventListener('click', closeCartMenu);

    // Xóa sản phẩm khỏi giỏ hàng
    function removeItem(button) {
        button.closest('.cart-item').remove();
        updateCartTotal();
    }
</script>
