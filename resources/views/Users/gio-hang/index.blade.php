@extends('Users.index')
@section('main')
    <title>{{ $title }}</title>
    <!-- Cart Menu -->
    <div class="container-cart mt-5">
        <h5>Your Cart</h5>
        @if (count($sanphams) != 0)
            <form method="POST">
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
                        @foreach ($sanphams as $sanpham)
                            <tr class="item-cart">
                                <th>
                                    <img src="{{ $sanpham->sanpham->hinhanh }}" alt="{{ $sanpham->sanpham->tensanpham }}" class="img-thumbnail">
                                </th>
                                <th>
                                    <div class="cart-name">
                                        {{ $sanpham->sanpham->tensanpham }}
                                    </div>
                                </th>
                                <th>
                                    <div class="cart-content">
                                        {{$sanpham->size}}
                                    </div>
                                </th>
                                <th>
                                    <div class="cart-content">
                                        {{$sanpham->color}}
                                    </div>
                                </th>
                                <th>
                                    <div class="quantity-controls mt-3">
                                        {{-- <button type="button" id="decrease-quantity-2">-</button> --}}
                                        <input type="number" name="{{ $sanpham->sanpham->id_sanpham }}"
                                            class="quantity2" value="{{$sanpham->quantity}}"
                                            min="1" max="10">
                                        {{-- <button type="button" id="increase-quantity-2">+</button> --}}
                                    </div>
                                </th>

                                <th>
                                    {!! \App\Helpers\Helper::price_cart($sanpham->gia, $sanpham->sale) !!}
                                </th>

                                <th>
                                    {{-- <a class="cart-content cart-item-remove" onclick="deleteItem(this)">
                                        <i class='bx bx-trash'></i>
                                    </a> --}}
                                    <a href="#" class="cart-content cart-item-remove">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <input type="submit" value="Update" formaction="/User/update-cart" class="text-center cart-update btn btn-outline-dark"> --}}
                <div class="cart-total">
                    <p class="font-weight-bold">Total: <span id="cartTotal">$0.00</span></p>
                </div>
            </form>
        @else
            <p>No items in cart</p>
        @endif
    </div>
@endsection
