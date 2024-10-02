<style>
    .slider {
        width: 100%;
        position: relative;
        max-height: 800px;
        overflow: hidden;
        border: 2px solid #ddd;
        border-radius: 5px;
        /* margin-left: 10%;
        margin-right: 10%; */
    }

    .slides {
        display: flex;
        transition: transform 4s ease;
        /* Thay đổi thời gian chuyển */
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
    }

    .slide img {
        width: 100%;
        display: block;
    }

    .prev,
    .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 50%;
        font-size: 24px;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }





    .container-banner {
        background-color: #ececec;
        padding: 20px;
        border-radius: 10px;
    }

    /* Căn chỉnh hình ảnh và khối bao quanh */
    .block1 {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .block1 img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .block1:hover img {
        transform: scale(1.1);
    }

    /* Căn chỉnh nội dung văn bản bên trong */
    .block1-txt {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        /* Nội dung văn bản xuống cuối */
        padding: 20px;
        color: white;
        background: rgba(0, 0, 0, 0.4);
        /* Nền mờ tối */
        transition: opacity 0.3s ease, background 0.3s ease;
        opacity: 0;
        /* Ẩn nội dung mặc định */
    }

    .block1:hover .block1-txt {
        opacity: 1;
        /* Hiển thị nội dung khi hover */
    }

    /* Thiết kế văn bản */
    .block1-name-header {
        font-size: 30px;
        font-weight: bold;
        color: rgb(255, 238, 0);
    }

    .block1-name,
    .block1-info {
        font-size: 18px;
        margin: 5px 0;
        color: #ddd;
    }

    /* "Shop Now" link styling */
    .block1-link {
        font-size: 14px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid #fff;
        padding-bottom: 2px;
        transition: color 0.5s ease, border-bottom-color 0.5s ease;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        opacity: 0;
        /* Ẩn nút mặc định */
        transform: translateY(10px);
        /* Di chuyển xuống dưới để tạo hiệu ứng */
        transition: opacity 1s ease, transform 1s ease;
    }

    .block1:hover .block1-link {
        opacity: 1;
        /* Hiển thị nút khi hover */
        transform: translateY(0);
        /* Đưa nút trở về vị trí ban đầu */
    }

    .block1-link:hover {
        font-weight: 900;
        color: rgb(12, 185, 55);
        border-bottom-color: rgb(12, 185, 55);
        text-decoration: none;
    }

    /* Xóa gạch chân cho tất cả các liên kết */
    a,
    a:hover,
    a:focus {
        text-decoration: none;
    }







    .slide {
        position: relative;
        width: 100%;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .slide .slide-text,
    .slide-season,
    .slide-button {
        position: relative;
        margin-left: 20rem;
        transform: translateY(0);
        /* Xóa translateX(50%) và translateY(50%) để tránh xung đột */
    }

    .slide-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slide-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 0;
        background: rgba(0, 0, 0, 0.3);
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .slide-content:hover {
        background: rgba(0, 0, 0, 0.5);
    }



    .slide-title {
        font-size: 70px;
        color: #ffeb3b;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .slide-season {
        font-size: 20px;
        color: #fff;
    }

    .slide-button a {
        font-size: 14px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid #fff;
        padding-bottom: 2px;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 1s ease, transform 1s ease;
    }

    .slide:hover .slide-button a {
        opacity: 1;
        transform: translateY(0);
    }

    .slide-button a:hover {
        font-weight: 900;
        color: rgb(12, 185, 55);
        border-bottom-color: rgb(12, 185, 55);
        text-decoration: none;
    }
</style>

<div class="slider mt-1">
    <div class="slides">
        <!-- Các slide -->
        {{-- <div class="slide">
            <img src="https://via.placeholder.com/800x400?text=Slide+1" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="https://via.placeholder.com/800x400?text=Slide+2" alt="Slide 2">
        </div>
        <div class="slide">
            <img src="https://via.placeholder.com/800x400?text=Slide+3" alt="Slide 3">
        </div> --}}
        @foreach ($menus as $key => $menu)
            @foreach ($sliders as $slider)
                <div class="slide">
                    <img src="{{ $slider->hinhanh }}" alt="IMG-BANNER" class="slide-img">
                    <div class="slide-content">
                        <div class="slide-text">
                            <span class="slide-title">
                                {{ $slider->name }}
                            </span>
                        </div>
                        <div class="slide-season">
                            <span class="slide-season-text">
                                Spring 2024
                            </span>
                        </div>
                        <div class="slide-button">
                            <a href="{{ route('user.danhmuc', $menu->id_danhmuc) }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    <div class="prev">
        <i class='bx bxs-chevron-left'></i>
    </div>
    <div class="next">
        <i class='bx bxs-chevron-right'></i>
    </div>

</div>

<div class="container-banner container my-5">
    <h1>Danh mục các sản phẩm</h1>
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto mb-4">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{ $menu->hinhanh }}" alt="IMG-BANNER">

                        <a href="{{ route('user.danhmuc', $menu->id_danhmuc) }}"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name-header ltext-102 trans-04 p-b-8">
                                    {{ $menu->tendanhmuc }}
                                </span>
                            </div>
                            <div class="block1-txt-child3 p-b-4 trans-05">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Spring 2024
                                </span>
                            </div>
                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    const slides = document.querySelector('.slides');
    const slideCount = document.querySelectorAll('.slide').length;
    const nextButton = document.querySelector('.next');
    const prevButton = document.querySelector('.prev');

    let index = 0;
    let slideInterval;

    function showSlide(n) {
        if (n >= slideCount) {
            index = 0;
        } else if (n < 0) {
            index = slideCount - 1;
        } else {
            index = n;
        }
        slides.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextSlide() {
        showSlide(index + 1);
    }

    function prevSlide() {
        showSlide(index - 1);
    }

    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 10000); // Chuyển slide sau mỗi 4 giây
    }

    function stopSlideShow() {
        clearInterval(slideInterval);
    }

    // Khởi động slide show tự động
    startSlideShow();

    nextButton.addEventListener('click', () => {
        nextSlide();
        stopSlideShow(); // Dừng tự động chuyển slide khi người dùng nhấn nút
        startSlideShow(); // Khởi động lại slide show sau khi nhấn
    });

    prevButton.addEventListener('click', () => {
        prevSlide();
        stopSlideShow(); // Dừng tự động chuyển slide khi người dùng nhấn nút
        startSlideShow(); // Khởi động lại slide show sau khi nhấn
    });
</script>
