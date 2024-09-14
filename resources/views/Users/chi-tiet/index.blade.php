@extends('Users.index')
@section('main')
    <style>
        /* Bố cục chung của phần breadcrumbs */
        .bread-crumb {
            display: flex;
            align-items: center;
            /* Căn giữa các phần tử dọc theo trục chính */
            font-size: 16px;
            /* Kích thước font cho các liên kết */
            color: #333;
            /* Màu chữ chung */
        }

        /* Phần tử liên kết */
        .bread-crumb a {
            text-decoration: none;
            /* Xóa gạch chân của liên kết */
            color: #007bff;
            /* Màu chữ của liên kết */
            margin-right: 10px;
            /* Khoảng cách giữa các liên kết */
            transition: color 0.3s;
            /* Hiệu ứng chuyển màu mượt mà */
        }

        .bread-crumb a:hover {
            color: #0056b3;
            /* Màu chữ khi di chuột qua liên kết */
        }

        /* Biểu tượng phân cách giữa các liên kết */
        .bread-crumb i {
            color: #666;
            /* Màu của biểu tượng */
            font-size: 14px;
            /* Kích thước biểu tượng */
        }

        /* Phần tử văn bản không phải liên kết */
        .bread-crumb span {
            color: #333;
            /* Màu chữ cho văn bản cuối cùng */
        }

        /* Các lớp bổ sung từ Bootstrap */
        .p-l-25 {
            padding-left: 25px;
        }

        .p-r-15 {
            padding-right: 15px;
        }

        .p-t-30 {
            padding-top: 30px;
        }

        .p-lr-0-lg {
            padding-left: 0;
            padding-right: 0;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        /* Cung cấp khoảng cách trên cho phần tử chứa */

        /* Cập nhật bố cục slider và hình thu nhỏ */
        .container-chitiet {
            width: 60%;
            margin-left: 20%;
            margin-right: 20%;
            padding: 10px;
            border-radius: 15px;
            box-shadow: 5px 10px 16px rgba(158, 158, 158, 0.5);
        }

        .slides {
            list-style-type: none;
            padding: 0;
            margin: 0;
            position: relative;
        }

        .slides li {
            display: none;
        }

        .slides img {
            width: 100%;
            height: auto;
        }

        .thumbnails {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 0;
            left: -100px;
            /* Điều chỉnh khoảng cách nếu cần */
        }

        .thumbnails li {
            margin: 5px 0;
        }

        .thumbnails img {
            width: 90px;
            height: auto;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnails img.active {
            border: 2px solid #2fda1f;
            /* Màu viền cho hình thu nhỏ được chọn */
        }

        /* Hiển thị hình ảnh đầu tiên */
        .slides li:first-child {
            display: block;
        }












        /* Center tabs horizontally */
        .nav-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 0;
        }

        /* Center and limit width of tab content */
        .tab-content {
            display: flex;
            justify-content: center;
            color: #949494;
            width: 80%;
            /* Giới hạn chiều rộng */
            max-width: 1200px;
            /* Kích thước tối đa (tuỳ chỉnh theo nhu cầu) */
            margin: auto;
            /* Căn giữa trong phần tử chứa */
        }

        /* Optional: Center the text inside each tab pane */
        .tab-pane {
            text-align: center;
        }


        /* Chọn kích thước */
    </style>
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="bx bx-chevron-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('user.danhmuc', $sanphams->danhmuc->id_danhmuc) }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $sanphams->danhmuc->tendanhmuc }}
                <i class="bx bx-chevron-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $title }}
            </span>
        </div>
    </div>
    <div class="container-chitiet mt-5">
        <div class="row">
            <div class="col-md-6">
                <ul class="slides">
                    @foreach ($anhs as $anh)
                        @php
                            $count = 0;
                            $counts = $count + 1;
                        @endphp
                        <li id="slide<?= $counts ?>"><img src="{{ $anh->hinhanh }}" alt="Slide <?= $counts ?>" />
                        </li>
                    @endforeach
                </ul>

                <ul class="thumbnails">
                    @foreach ($anhs as $anh)
                        @php
                            $count = 0;
                            $counts = $count + 1;
                        @endphp
                        <li><a href="#slide<?= $counts ?>"><img src="{{ $anh->hinhanh }}"
                                    alt="Thumbnail <?= $counts ?>" /></a></li>
                    @endforeach
                </ul>
            </div>
            @php
                $price = $sanphams->gia - ($sanphams->gia * $sanphams->sale) / 100;
            @endphp
            <div class="col-md-6">
                <h1>{{ $sanphams->tensanpham }}</h1>
                <h3>{!! \App\Helpers\Helper::price_sale($sanphams->gia, $sanphams->sale) !!}</h3>
                <p>{{ $sanphams->mota }}</p>
                <form id="form-add-cart" action="{{ route('user.giohang') }}" method="post">
                    @csrf
                    @if ($sanphams->gia < $sanphams->sale)
                        <div class="btn btn-danger">Đang cập nhật</div>
                    @else
                        <input type="hidden" name="id_sanpham" value="{{ $sanphams->id_sanpham }}">
                        <input type="hidden" name="gia" value="<?= $price ?>">
                        <!-- Chọn kích thước -->
                        <div class="form-group">
                            <label for="size">Chọn kích thước</label>
                            <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                <label class="btn btn-outline-primary size-option">
                                    <input type="radio" name="size" value="S" autocomplete="off"> Size S
                                </label>
                                <label class="btn btn-outline-primary size-option">
                                    <input type="radio" name="size" value="M" autocomplete="off"> Size M
                                </label>
                                <label class="btn btn-outline-primary size-option">
                                    <input type="radio" name="size" value="L" autocomplete="off"> Size L
                                </label>
                                <label class="btn btn-outline-primary size-option">
                                    <input type="radio" name="size" value="XL" autocomplete="off"> Size XL
                                </label>
                            </div>
                        </div>

                        <!-- Chọn màu sắc -->
                        <div class="form-group">
                            <label for="color">Chọn màu sắc</label>
                            <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                <label class="btn btn-outline-primary color-option">
                                    <input type="radio" name="color" value="red" autocomplete="off"> Đỏ
                                </label>
                                <label class="btn btn-outline-primary color-option">
                                    <input type="radio" name="color" value="green" autocomplete="off"> Xanh lá
                                </label>
                                <label class="btn btn-outline-primary color-option">
                                    <input type="radio" name="color" value="blue" autocomplete="off"> Xanh dương
                                </label>
                                <label class="btn btn-outline-primary color-option">
                                    <input type="radio" name="color" value="black" autocomplete="off"> Đen
                                </label>
                            </div>
                        </div>

                        <!-- Chọn số lượng -->
                        <div class="quantity-controls">
                            <button type="button" id="decrease-quantity-1">-</button>
                            <input type="number" name="quantity" class="quantity" value="1" min="1"
                                max="10">
                            <button type="button" id="increase-quantity-1">+</button>
                        </div>

                        <!-- Nút thêm vào giỏ hàng -->
                        @auth
                            <button type="submit" class="btn btn-primary add-cart mt-5 mb-5"> Thêm vào giỏ hàng </button>
                        @else
                            <button type="button" onclick="checkLogin()" class="btn btn-secondary add-cart mt-5 mb-5">Thêm vào giỏ hàng</button>
                        @endauth
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description"
                    type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="additional-info-tab" data-bs-toggle="tab" data-bs-target="#additional-info"
                    type="button" role="tab" aria-controls="additional-info" aria-selected="false">Additional
                    information</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button"
                    role="tab" aria-controls="reviews" aria-selected="false">Reviews (1)</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Description Tab Content -->
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p>
                    {{ $sanphams->mota }}
                </p>
            </div>

            <!-- Additional Information Tab Content -->
            <div class="tab-pane fade" style="text-align: left" id="additional-info" role="tabpanel"
                aria-labelledby="additional-info-tab">
                <p>
                    {!! $sanphams->motachitiet !!}
                </p>
            </div>

            <!-- Reviews Tab Content -->
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <p>
                    Customer reviews about the product. Average rating, etc.
                    Customer reviews about the product. Average rating, etc.
                    Customer reviews about the product. Average rating, etc.
                    Customer reviews about the product. Average rating, etc.
                    Customer reviews about the product. Average rating, etc.
                    Customer reviews about the product. Average rating, etc.
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        @include('Users.san-pham-main.more')
    </div>
    <div class="custom-bg d-flex justify-content-center align-items-center flex-wrap p-3 mt-5 mb-5"
        style="background-color: #b2c2b2;">
        <span class="text-white px-3">
            SKU: JAK-01
        </span>

        <span class="text-white px-3">
            Categories: {{ $sanphams->danhmuc->tendanhmuc }}
        </span>
    </div>
    <script>
        function checkLogin(id) {
            if (!id) {
                // Nếu không có userId (người dùng chưa đăng nhập), hiển thị thông báo
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                });
                Toast.fire({
                    icon: "warning",
                    title: "Bạn cần đăng nhập trước!",
                });
            } else {

            }
        }

        // Xử lý sự kiện khi chọn hình thu nhỏ
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slides li');
            const thumbnails = document.querySelectorAll('.thumbnails li a img');

            // Ẩn tất cả các slide ngoại trừ slide đầu tiên
            slides.forEach((slide, index) => {
                if (index !== 0) {
                    slide.style.display = 'none';
                }
            });

            thumbnails.forEach((thumbnail, index) => {
                thumbnail.addEventListener('click', function(event) {
                    event.preventDefault();
                    // Ẩn tất cả các slide
                    slides.forEach(slide => slide.style.display = 'none');
                    // Loại bỏ lớp 'active' của tất cả các thumbnail
                    thumbnails.forEach(thumb => thumb.classList.remove('active'));
                    // Hiển thị slide tương ứng với thumbnail được chọn
                    slides[index].style.display = 'block';
                    // Thêm lớp 'active' cho thumbnail được chọn
                    thumbnail.classList.add('active');
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý sự kiện khi chọn kích thước
            const sizeOptions = document.querySelectorAll('.size-option input');
            sizeOptions.forEach(option => {
                option.addEventListener('change', function() {
                    // Xóa lớp 'active' khỏi tất cả các tùy chọn
                    sizeOptions.forEach(opt => opt.parentElement.classList.remove('active'));
                    // Thêm lớp 'active' vào tùy chọn hiện tại
                    this.parentElement.classList.add('active');
                });
            });

            // Xử lý sự kiện khi chọn màu sắc
            const colorOptions = document.querySelectorAll('.color-option input');
            colorOptions.forEach(option => {
                option.addEventListener('change', function() {
                    // Xóa lớp 'active' khỏi tất cả các tùy chọn
                    colorOptions.forEach(opt => opt.parentElement.classList.remove('active'));
                    // Thêm lớp 'active' vào tùy chọn hiện tại
                    this.parentElement.classList.add('active');
                });
            });
        });
    </script>
@endsection
