@extends('Users.index')
@section('main')
    @include('Users.layouts.slider')
    <style>
        .allproduct {
            font-size: 14px;
            color: rgba(0, 0, 0, 0.6);
            /* Màu mờ hơn */
            text-transform: uppercase;
            letter-spacing: 1px;
            padding-bottom: 2px;
            text-decoration: none;
            /* Bỏ gạch chân mặc định */
            display: inline-block;
            margin-top: 20px;
            opacity: 0.7;
            /* Mờ hơn lúc ban đầu */
            /* transform: translateY(1px); */
            border-bottom: 2px solid rgba(0, 0, 0, 0.6);
            /* Gạch chân tùy chỉnh */
            border-spacing: 5px;
            /* Điều chỉnh khoảng cách gạch chân */
            transition: opacity 0.3s ease, transform 0.3s ease, color 0.3s ease, border-bottom-color 0.3s ease;
        }

        .allproduct:hover {
            opacity: 1;
            /* Đậm hơn */
            /* transform: translateY(0); */
            /* Di chuyển lên */
            font-weight: 900;
            color: rgb(12, 185, 55);
            /* Màu đậm khi hover */
            border-bottom-color: rgb(12, 185, 55);
            /* Đổi màu viền */
            border-bottom-width: 3px;
            /* Dày hơn khi hover */
            text-decoration: none;
            /* Không còn gạch chân khi hover */
        }
    </style>

    <div class="container mt-5 mb-5">
        <h1>Product Overview</h1>

        <!-- Categories Section -->
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <a class="allproduct" href="#">
                    All Products
                </a>
            </div>
        </div>
    </div>
    @include('Users.san-pham-main.main')
@endsection
