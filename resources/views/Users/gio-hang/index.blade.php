@extends('Users.index')
@section('main')
    <title>{{ $title }}</title>
    <!-- Cart Menu -->
    <div class="container-cart mt-5">

        <h2><b>Giỏ hàng</b></h2>
        @if ($carts->isEmpty())
            <h4>
                <p>Không có sản phẩm trong giỏ hàng</p>
            </h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-success">Tiếp tục mua sắm</a>
        @else
            <form action="{{ route('user.add-donghang', Auth::id()) }}" method="POST">
                @csrf
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            @if ($cart->dadathang != 0)
                                <tr class="item-cart">
                                    <input type="hidden" name="id_sanpham" value="{{ $cart->sanpham->id_sanpham }}">
                                    <input type="hidden" name="id_size" value="{{ $cart->size->id_size }}">
                                    <input type="hidden" name="id_color" value="{{ $cart->color->id_color }}">
                                    <th>
                                        <img src="{{ $cart->sanpham->hinhanh }}" alt="{{ $cart->sanpham->tensanpham }}"
                                            class="img-thumbnail">
                                    </th>
                                    <th>
                                        <div class="cart-name">
                                            {{ $cart->sanpham->tensanpham }}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="cart-content">
                                            {{ $cart->size->tensize }}
                                        </div>
                                    </th>
                                    <th>
                                        <div class="cart-content">
                                            {{ $cart->color->tencolor }}
                                        </div>
                                    </th>
                                    <th>
                                        {{-- <input type="hidden" name="quantity" class="quantity"
                                            value="{{ $cart->quantity }}" />
                                        <span>{{ $cart->quantity }}</span> --}}
                                        <div class="d-flex flex-row align-items-center m-1">
                                            <div class="input-group input-group-sm">
                                                <button class="btn btn-sm btn-outline-secondary"
                                                    onclick="decrease(this, {{ $cart->id_giohang }})" type="button">-</button>
                                                <input type="number" name="quantity" class="quantity"
                                                    value="{{ $cart->quantity }}" min="1" max="10"
                                                    data-cart-id="{{ $cart->id }}">
                                                <button class="btn btn-sm btn-outline-secondary"
                                                    onclick="increase(this, {{ $cart->id_giohang }})" type="button">+</button>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        {!! \App\Helpers\Helper::price_cart($cart->gia, $cart->sale) !!}
                                    </th>
                                    <th>
                                        <a href="{{ $cart->id_giohang }}/delete-cart" style="display:inline;"
                                            data-name="{{ $cart->sanpham->tensanpham }}"
                                            class="btn btn-danger delete-form bx bx-trash"></a>
                                    </th>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-total">
                    <p class="font-weight-bold">Total: <span id="cartTotal"></span>
                    </p>
                    <p class="font-weight-bold"><input type="hidden" name="tong" id="text" class="text-decorate">
                    </p>
                </div>
                <button type="submit" class="cart-buy btn btn-danger">Đặt hàng</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-success">Tiếp tục mua sắm</a>
            </form>
        @endif
    </div>
    <script>
        function increase(element, cartId) {
            var input = element.parentNode.querySelector('input.quantity');
            var value = parseInt(input.value, 10);
            if (value < 10) {
                input.value = value + 1;
                updateQuantity(cartId, value + 1);
            } else {
                Swal.fire({
                    title: 'THÔNG BÁO',
                    text: 'Chỉ có thể chọn tối đa 10 sản phẩm!!!',
                    icon: 'warning',
                    confirmButtonText: 'Đồng ý',
                });
            }
        }

        function decrease(element, cartId) {
            var input = element.parentNode.querySelector('input.quantity');
            var value = parseInt(input.value, 10);
            if (value > 1) {
                input.value = value - 1;
                updateQuantity(cartId, value - 1);
            }
        }

        function updateQuantity(cartId, quantity) {
            // Gửi yêu cầu AJAX để cập nhật số lượng
            $.ajax({
                url: '/User/cart/update', // Đường dẫn đến API để cập nhật giỏ hàng
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token
                    cart_id: cartId, // ID của sản phẩm trong giỏ hàng
                    quantity: quantity // Số lượng mới
                },
                success: function(response) {
                    Swal.fire({
                        title: 'THÔNG BÁO',
                        text: 'Đã cập nhật số lượng sản phẩm.',
                        icon: 'success',
                        confirmButtonText: 'Đồng ý',
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra khi cập nhật số lượng.',
                        icon: 'error',
                        confirmButtonText: 'Đồng ý',
                    });
                }
            });
        }
    </script>
@endsection
