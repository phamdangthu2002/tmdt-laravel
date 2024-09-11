<!-- Cart Menu -->
<div class="cart-menu" id="cartMenu">
    <button class="cart-menu-close">&times;</button>
    <div class="cart-menu-content">
        <h5>Your Cart</h5>
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
                    <p class="cart-item-description mt-2">A brief description of Product 1 that gives
                        more
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
                    <p class="cart-item-description mt-2">A brief description of Product 1 that gives
                        more
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
                    <p class="cart-item-description mt-2">A brief description of Product 1 that gives
                        more
                        details about the item.</p>
                </div>
                <a class="cart-item-remove text-danger ml-3" onclick="deleteItem(this)">
                    <i class='bx bx-trash'></i>
                </a>
            </div>
        </div>
        <div class="cart-total mt-4">
            <p class="font-weight-bold">Total: <span class="cartTotal1">$0.00</span></p>
        </div>
        <div class="cart-check-out d-flex justify-content-between align-items-center p-3">
            <a href="{{ route('user.giohangshow') }}" class="btn btn-outline-dark">View cart</a>
            <a href="{{ route('user.thanh-toan') }}" class="btn btn-success">Checkout</a>
        </div>
    </div>
</div>
