@extends('Users.index')
@section('main')
    <title>{{ $title }}</title>
    <!-- Cart Menu -->
    <div class="container-cart mt-5">

        <h5>Your Cart</h5>
        @if ($carts->isEmpty())
            <h3>
                <p>No items in cart</p>
            </h3>
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
                                        <input type="hidden" name="quantity" class="quantity"
                                            value="{{ $cart->quantity }}" />
                                        <span>{{ $cart->quantity }}</span>
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
@endsection
