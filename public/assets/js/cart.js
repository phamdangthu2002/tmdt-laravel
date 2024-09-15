// Hàm để điều chỉnh số lượng sản phẩm
function adjustQuantity(button, change) {
    // Tìm phần tử input chứa số lượng sản phẩm
    const quantityInput = button.closest('.quantity-controls').querySelector('input[type="number"]');
    let currentQuantity = parseInt(quantityInput.value, 10);

    if (isNaN(currentQuantity)) {
        currentQuantity = 0;
    }

    // Tăng hoặc giảm số lượng
    currentQuantity += change;

    // Đảm bảo số lượng không nhỏ hơn 1 và không vượt quá 10
    if (currentQuantity < 1) {
        currentQuantity = 1;
        Swal.fire({
            icon: 'warning',
            title: 'Số lượng tối thiểu là 1',
            text: 'Bạn không thể giảm số lượng thấp hơn 1.',
        });
    } else if (currentQuantity > 10) {
        currentQuantity = 10;
        Swal.fire({
            icon: 'warning',
            title: 'Số lượng tối đa là 10',
            text: 'Bạn không thể tăng số lượng cao hơn 10.',
        });
    }

    // Cập nhật số lượng mới vào ô nhập
    quantityInput.value = currentQuantity;

    // Tính lại tổng tiền và cập nhật số lượng giỏ hàng
    calculateTotal();
    updateCartCount();
}

// Hàm để tính tổng tiền của các sản phẩm trong giỏ hàng
function calculateTotal() {
    let total = 0;
    const cartItems = document.querySelectorAll('.item-cart');

    cartItems.forEach(item => {
        const priceText = item.querySelector('.cart-item-price').innerText.replace(/[^0-9]/g, ''); // Lấy số tiền bỏ ký tự đặc biệt
        const price = parseFloat(priceText); // Chuyển sang số
        const quantity = parseInt(item.querySelector('.quantity').value, 10); // Lấy số lượng từ giá trị của input
        total += price * quantity; // Tính tổng giá
    });

    // Cập nhật tổng tiền với định dạng VND
    document.querySelector('#cartTotal').innerText = formatVND(total);
    document.querySelector('#text').value = total

}

// Hàm để định dạng số tiền theo VND
function formatVND(number) {
    return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }).replace('₫', ' VND');
}

// Gán sự kiện cho các nút điều chỉnh số lượng
document.addEventListener('DOMContentLoaded', () => {
    // Gán sự kiện cho nhóm 1
    document.querySelectorAll('#decrease-quantity-1').forEach(button => {
        button.addEventListener('click', () => adjustQuantity(button, -1));
    });

    document.querySelectorAll('#increase-quantity-1').forEach(button => {
        button.addEventListener('click', () => adjustQuantity(button, 1));
    });

    // Gán sự kiện cho nhóm 2
    document.querySelectorAll('#decrease-quantity-2').forEach(button => {
        button.addEventListener('click', () => adjustQuantity(button, -1));
    });

    document.querySelectorAll('#increase-quantity-2').forEach(button => {
        button.addEventListener('click', () => adjustQuantity(button, 1));
    });

    // Tính tổng tiền và cập nhật số lượng giỏ hàng khi trang được tải
    calculateTotal();
});
