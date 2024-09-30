$(document).ready(function () {
    function calculateCartTotal() {
        let total = 0;

        // Lặp qua từng hàng trong giỏ hàng
        $('.item-cart').each(function () {
            const priceText = $(this).find('.cart-item-price').text().trim(); // Lấy giá sản phẩm
            const quantity = parseInt($(this).find('.quantity').val(), 10); // Lấy số lượng sản phẩm

            // Chuyển đổi giá thành số và xử lý trường hợp không hợp lệ
            const price = parseInt(priceText.replace(/[^0-9]/g, ''), 10); // Xóa các ký tự không phải số

            if (!isNaN(price) && !isNaN(quantity)) {
                total += price * quantity; // Tính tổng
            } else {
                console.log('Giá trị không hợp lệ:', priceText); // Log nếu giá không hợp lệ
            }
        });

        // Cập nhật tổng vào phần tử với id cartTotal
        $('#cartTotal').text(total.toLocaleString() + ' VND'); // Hiển thị tổng với định dạng
        $('#text').val(total); // Cập nhật giá trị vào input ẩn
    }

    // Tính tổng giỏ hàng khi trang được tải
    calculateCartTotal();

    // Tính lại tổng khi số lượng thay đổi (nếu có)
    $('.quantity').on('change', function () {
        calculateCartTotal();
    });
});

// Hàm để định dạng số tiền theo VND
function formatVND(number) {
    return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }).replace('₫', ' VND');
}


function increase(element) {
    var input = element.parentNode.querySelector('input.quantity');
    var value = parseInt(input.value, 10);
    if (value < 10) { // Giới hạn là 10 sản phẩm
        input.value = value + 1;
    } else {
        const Toast = Swal.fire({
            title: 'THÔNG BÁO',
            text: 'Chỉ có thể chọn tối đa 10 sản phẩm!!!',
            icon: 'warning',
            confirmButtonText: 'Đồng ý',
        });
        return false;
    }
}

function decrease(element) {
    var input = element.parentNode.querySelector('input.quantity');
    var value = parseInt(input.value, 10);
    if (value > 1) {
        input.value = value - 1;
    }
}