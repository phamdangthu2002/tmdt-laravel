@extends('Users.index')
@section('main')
    <title>{{ $title }}</title>
    <!-- Cart Menu -->
    <div class="container-cart mt-5">

        <h5>Your Cart</h5>
        <form action="{{ route('user.add-donghang', Auth::id()) }}" method="POST">
            @csrf
            @foreach ($carts as $cart)
                @if ($cart->dadathang != 1)
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
                            <input type="hidden" name="id_sanpham" value="{{ $cart->sanpham->id_sanpham }}">
                            <tr class="item-cart">
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
                                        {{ $cart->size }}
                                    </div>
                                </th>
                                <th>
                                    <div class="cart-content">
                                        {{ $cart->color }}
                                    </div>
                                </th>
                                <th>
                                    <div class="cart-content">
                                        {{-- <button type="button" id="decrease-quantity-2">-</button> --}}
                                        <input type="number" name="{{ $cart->sanpham->id_sanpham }}" class="quantity"
                                            value="{{ $cart->quantity }}" min="1" max="10">
                                        {{-- <button type="button" id="increase-quantity-2">+</button> --}}
                                    </div>
                                    {{-- <div class="cart-content">
                                    <span class="quantity">{{ $sanpham->quantity }}</span>
                                </div> --}}
                                </th>

                                <th>
                                    {!! \App\Helpers\Helper::price_cart($cart->gia, $cart->sale) !!}
                                </th>

                                <th>
                                    <form action="{{ route('user.delete-cart', $cart->id_giohang) }}" method="post"
                                        class="delete-form" style="display:inline;"
                                        data-name="{{ $cart->sanpham->tensanpham }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger bx bx-trash"></button>
                                    </form>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-total">
                        <p class="font-weight-bold">Total: <span id="cartTotal">$0.00</span></p>
                        <p class="font-weight-bold"><input type="hidden" name="tong" id="text"
                                class="text-decorate">
                        </p>
                    </div>
                    <button type="submit" class="cart-buy btn btn-danger">Đặt hàng</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-success">Tiếp tục mua sắm</a>
                @else
                    <h3>
                        <p>No items in cart</p>
                    </h3>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-success">Tiếp tục mua sắm</a>
                @endif
            @endforeach
        </form>
    </div>
@endsection
