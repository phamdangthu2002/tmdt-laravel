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

        .content {
            display: none;
            /* Ẩn tất cả nội dung mặc định */
        }
    </style>

    <div class="container mt-5 mb-5">
        <h1>Product Overview</h1>

        {{-- @include('Users.layouts.filter') --}}
        <!-- Categories Section -->
        <div>
            <a class="allproduct me-3" href="#" id="all-products-link">
                All Products
            </a>
            <a class="allproduct me-3" href="#" id="sale-link">
                Sale
            </a>
            <a class="allproduct" href="#" id="random-link">
                Random
            </a>
        </div>
        <div id="all-products-content" class="content1">
            <div class="container-main mt-5 mb-5" id="load">
                @include('Users.san-pham-main.main')
            </div>

            <div class="load-more mb-5" id="btn-load-more">
                <input type="hidden" value="1" id="page">
                <a onclick="loadMore()" class="btn btn-outline-success"> Xem thêm </a>
            </div>
        </div>
        <div id="sale-content" class="content" style="display: none;">
            <div class="container-main mt-5 mb-5" id="load">
                @include('Users.san-pham-main.sale')
            </div>
        </div>
        <div id="random-content" class="content" style="display: none;">
            <div class="container-main mt-5 mb-5" id="load">
                @include('Users.san-pham-main.random')
            </div>
        </div>
    </div>

    <div class="container-random">
        <h1><label for="">Hôn nay mua gì ?</label></h1>
        @include('Users.san-pham-main.random')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy các phần tử liên kết và nội dung
            const allProductsLink = document.getElementById('all-products-link');
            const saleLink = document.getElementById('sale-link');
            const randomLink = document.getElementById('random-link');
            const allProductsContent = document.getElementById('all-products-content');
            const saleContent = document.getElementById('sale-content');
            const randomContent = document.getElementById('random-content');

            // Xử lý sự kiện click cho liên kết "All Products"
            allProductsLink.addEventListener('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                allProductsContent.style.display = 'block';
                saleContent.style.display = 'none';
                randomContent.style.display = 'none';
            });

            // Xử lý sự kiện click cho liên kết "Sale"
            saleLink.addEventListener('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                allProductsContent.style.display = 'none';
                saleContent.style.display = 'block';
                randomContent.style.display = 'none';
            });

            // Xử lý sự kiện click cho liên kết "Random"
            randomLink.addEventListener('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
                allProductsContent.style.display = 'none';
                saleContent.style.display = 'none';
                randomContent.style.display = 'block';
            });
        });
    </script>
@endsection
