<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="/assets/vendor/boxicons-2.1.4/css/boxicons.min.css" rel='stylesheet'>
    <script src="/assets/vendor/jquery-3.7.1.js"></script>
    <script src="/assets/vendor/popper.min.js"></script>
    <script src="/assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <!-- Thêm vào trong thẻ <head> hoặc trước thẻ </body> -->
    <script src="/assets/vendor/sweetalert2@11.js"></script>

    <style>
        .container {
            margin-top: 50px;
        }

        h1,
        h2 {
            margin-bottom: 20px;
        }

        .cart-summary,
        .user-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 15px;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item img {
            border-radius: 8px;
            width: 100px;
            height: 100px;
        }

        .cart-item-info {
            flex-grow: 1;
            padding-left: 15px;
        }

        .cart-item-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .cart-item-size {
            font-weight: bold;
            margin-right: 15px;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
        }

        .quantity-decrease,
        .quantity-increase {
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
        }

        .quantity-decrease {
            margin-right: 10px;
        }

        .quantity-increase {
            margin-left: 10px;
        }

        .quantity {
            font-weight: bold;
            font-size: 16px;
        }

        .cart-item-price {
            margin-top: 10px;
            font-size: 18px;
            color: #28a745;
            font-weight: bold;
        }

        .cart-item-description {
            font-size: 14px;
            color: #6c757d;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Số dòng tối đa là 3 */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .cart-item-remove {
            color: #dc3545;
            font-size: 20px;
            cursor: pointer;
        }

        .cart-total {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .user-info .form-group {
            margin-bottom: 20px;
        }

        .user-info label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        .user-info input[type="text"],
        .user-info input[type="email"],
        .user-info input[type="tel"],
        .user-info textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .user-info button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .user-info button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Checkout</h1>
        <div class="row">
            <!-- Order Summary -->
            <div class="col-md-6">
                <section class="cart-summary">
                    <h2 class="mb-4">Order Summary</h2>
                    <div class="cart-items">
                        <!-- Ví dụ sản phẩm trong giỏ hàng -->
                        <div class="cart-item d-flex mb-3">
                            <img src="https://via.placeholder.com/100" alt="Product 1" class="mr-3">
                            <div class="cart-item-info flex-grow-1">
                                <p class="cart-item-name font-weight-bold">Product 1</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="cart-item-size mb-0">Size: M</p>
                                    <div class="cart-item-quantity d-flex align-items-center">
                                        <button class="quantity-decrease btn btn-sm btn-outline-secondary"
                                            onclick="adjustQuantity(this, -1)">&#8722;</button>
                                        <span class="quantity mx-2">1</span>
                                        <button class="quantity-increase btn btn-sm btn-outline-secondary"
                                            onclick="adjustQuantity(this, 1)">&#43;</button>
                                    </div>
                                </div>
                                <p class="cart-item-price">$20.00</p>
                                <p class="cart-item-description mt-2">A brief description of Product 1 that gives more
                                    details about the item. A brief description of Product 1 that gives more details
                                    about the item. A brief description of Product 1 that gives more
                                    details about the item. A brief description of Product 1 that gives more details
                                    about the item. A brief description of Product 1 that gives more
                                    details about the item.</p>
                            </div>
                            <a class="cart-item-remove text-danger ml-3" onclick="deleteItem(this)">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                        <!-- Thêm các sản phẩm khác tương tự -->
                        <div class="cart-item d-flex mb-3">
                            <img src="https://via.placeholder.com/100" alt="Product 1" class="mr-3">
                            <div class="cart-item-info flex-grow-1">
                                <p class="cart-item-name font-weight-bold">Product 1</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="cart-item-size mb-0">Size: M</p>
                                    <div class="cart-item-quantity d-flex align-items-center">
                                        <button class="quantity-decrease btn btn-sm btn-outline-secondary"
                                            onclick="adjustQuantity(this, -1)">&#8722;</button>
                                        <span class="quantity mx-2">1</span>
                                        <button class="quantity-increase btn btn-sm btn-outline-secondary"
                                            onclick="adjustQuantity(this, 1)">&#43;</button>
                                    </div>
                                </div>
                                <p class="cart-item-price">$20.00</p>
                                <p class="cart-item-description mt-2">A brief description of Product 1 that gives more
                                    details about the item.</p>
                            </div>
                            <a class="cart-item-remove text-danger ml-3" onclick="deleteItem(this)">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                        <div class="cart-item d-flex mb-3">
                            <img src="https://via.placeholder.com/100" alt="Product 1" class="mr-3">
                            <div class="cart-item-info flex-grow-1">
                                <p class="cart-item-name font-weight-bold">Product 1</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="cart-item-size mb-0">Size: M</p>
                                    <div class="cart-item-quantity d-flex align-items-center">
                                        <button class="quantity-decrease btn btn-sm btn-outline-secondary"
                                            onclick="adjustQuantity(this, -1)">&#8722;</button>
                                        <span class="quantity mx-2">1</span>
                                        <button class="quantity-increase btn btn-sm btn-outline-secondary"
                                            onclick="adjustQuantity(this, 1)">&#43;</button>
                                    </div>
                                </div>
                                <p class="cart-item-price">$20.00</p>
                                <p class="cart-item-description mt-2">A brief description of Product 1 that gives more
                                    details about the item.</p>
                            </div>
                            <a class="cart-item-remove text-danger ml-3" onclick="deleteItem(this)">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                    </div>
                    <div class="cart-total mt-4">
                        <p class="font-weight-bold">Total: <span id="cartTotal">$0.00</span></p>
                    </div>
                </section>
            </div>


            <!-- User Information Form -->
            <div class="col-md-6">
                <section class="user-info">
                    <h2 class="mb-4">Billing Information</h2>
                    <form id="checkoutForm">
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea id="address" name="address" class="form-control" rows="4"
                                placeholder="Enter your delivery address" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                    </form>
                </section>
            </div>

        </div>
    </div>

    <script>
        // Hàm để điều chỉnh số lượng sản phẩm
        function adjustQuantity(button, change) {
            // Lấy phần tử chứa số lượng sản phẩm
            const quantityElement = button.closest('.cart-item-quantity').querySelector('.quantity');
            let quantity = parseInt(quantityElement.innerText);

            // Kiểm tra nếu số lượng vượt quá 10
            if (quantity >= 10 && change > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Giới hạn số lượng',
                    text: 'Mỗi sản phẩm chỉ được chọn tối đa 10!',
                    confirmButtonText: 'Đã hiểu'
                });
                return; // Dừng lại nếu vượt quá giới hạn
            }

            // Cập nhật số lượng sản phẩm dựa trên thay đổi (tăng/giảm)
            quantity = Math.max(1, quantity + change);
            quantityElement.innerText = quantity;

            // Cập nhật tổng tiền sau khi thay đổi số lượng
            calculateTotal();
        }

        // Hàm xóa sản phẩm
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
                    // Nếu người dùng xác nhận, thực hiện hành động xóa
                    Swal.fire(
                        'Đã xóa!',
                        'Sản phẩm đã được xóa.',
                        'success'
                    );
                    // Thực hiện xóa sản phẩm, ví dụ: xóa phần tử HTML
                    element.closest('.cart-item').remove();
                    // Tính tổng tiền lại sau khi xóa sản phẩm
                    calculateTotal();
                }
            });
        }


        // Hàm để tính tổng tiền các sản phẩm trong giỏ hàng
        function calculateTotal() {
            let total = 0;
            // Lấy tất cả các sản phẩm trong giỏ hàng
            const cartItems = document.querySelectorAll('.cart-item');

            // Duyệt qua từng sản phẩm để tính tổng tiền
            cartItems.forEach(item => {
                // Lấy giá sản phẩm và số lượng sản phẩm
                const price = parseFloat(item.querySelector('.cart-item-price').innerText.replace('$', ''));
                const quantity = parseInt(item.querySelector('.quantity').innerText);

                // Cộng giá tiền (giá x số lượng) vào tổng tiền
                total += price * quantity;
            });

            // Cập nhật tổng tiền vào phần tử HTML có id là cartTotal
            document.getElementById('cartTotal').innerText = `$${total.toFixed(2)}`;
        }

        // Khi trang web được tải xong, tính tổng tiền ban đầu
        document.addEventListener('DOMContentLoaded', () => {
            calculateTotal();
        });
    </script>
</body>

</html>
