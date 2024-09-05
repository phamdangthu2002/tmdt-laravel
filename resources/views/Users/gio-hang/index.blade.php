<!-- Cart Menu -->
<div class="cart-menu" id="cartMenu">
    <button class="cart-menu-close">&times;</button>
    <div class="cart-menu-content">
        <h5>Your Cart</h5>
        <div class="cart-items">
            <!-- Example cart items -->
            <div class="cart-item">
                <img src="https://via.placeholder.com/100" alt="Product 1">
                <div class="cart-item-info">
                    <p class="cart-item-name">Product 1</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="cart-item-size">Size:
                                <span class="cart-item-size-number">M</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="cart-item-quantity">Quantity:
                                <span class="cart-item-quantity-number">1</span>
                            </p>
                        </div>
                    </div>
                    <p class="cart-item-price">$20.00</p>
                    <p class="cart-item-description">A brief description of Product 1 that gives more details about
                        the item.</p>
                </div>
                <a class="cart-item-remove" onclick="deleteItem(this)">
                    <i class='bx bx-trash'></i>
                </a>
            </div>
            <div class="cart-item">
                <img src="https://via.placeholder.com/100" alt="Product 1">
                <div class="cart-item-info">
                    <p class="cart-item-name">Product 1</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="cart-item-size">Size:
                                <span class="cart-item-size-number">M</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="cart-item-quantity">Quantity:
                                <span class="cart-item-quantity-number">1</span>
                            </p>
                        </div>
                    </div>
                    <p class="cart-item-price">$20.00</p>
                    <p class="cart-item-description">A brief description of Product 1 that gives more details about
                        the item.</p>
                </div>
                <a class="cart-item-remove" onclick="deleteItem(this)">
                    <i class='bx bx-trash'></i>
                </a>
            </div>
            <div class="cart-item">
                <img src="https://via.placeholder.com/100" alt="Product 2">
                <div class="cart-item-info">
                    <p class="cart-item-name">Product 2</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="cart-item-size">Size:
                                <span class="cart-item-size-number">M</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="cart-item-quantity">Quantity:
                                <span class="cart-item-quantity-number">1</span>
                            </p>
                        </div>
                    </div>
                    <p class="cart-item-price">$15.00</p>
                    <p class="cart-item-description">A brief description of Product 2 that gives more details about
                        the item.</p>
                </div>
                <a class="cart-item-remove" onclick="deleteItem(this)">
                    <i class='bx bx-trash'></i>
                </a>
            </div>
            <div class="cart-item">
                <img src="https://via.placeholder.com/100" alt="Product 2">
                <div class="cart-item-info">
                    <p class="cart-item-name">Product 2</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="cart-item-size">Size:
                                <span class="cart-item-size-number">M</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="cart-item-quantity">Quantity:
                                <span class="cart-item-quantity-number">1</span>
                            </p>
                        </div>
                    </div>
                    <p class="cart-item-price">$15.00</p>
                    <p class="cart-item-description">A brief description of Product 2 that gives more details about
                        the item.</p>
                </div>
                <a class="cart-item-remove text-danger ml-3" onclick="deleteItem(this)">
                    <i class='bx bx-trash'></i>
                </a>
            </div>
        </div>
        <div class="cart-total">
            <p>Total: <span id="cartTotal">$0.00</span></p>
        </div>
        <div class="cart-check-out d-flex justify-content-between align-items-center p-3">
            <a href="#" class="btn btn-outline-dark">View cart</a>
            <a href="{{ route('user.thanh-toan') }}" class="btn btn-success">Checkout</a>
        </div>
    </div>
</div>
