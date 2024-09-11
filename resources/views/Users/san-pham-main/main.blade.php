<div class="row mb-5">
    <!-- Lặp qua danh sách sản phẩm -->
    @foreach ($sanphams as $sanpham)
        <div class="product-card">
            {{-- <div class="banner-sale"></div> --}}
            {{-- <div class="product-banner"> --}}
            {{-- <div class="tille-price"> --}}
            {!! \App\Helpers\Helper::price($sanpham->gia, $sanpham->sale) !!}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- <img src="https://via.placeholder.com/400x700" alt="Sản phẩm"> --}}
            <img src="{{ $sanpham->hinhanh }}" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">{{ $sanpham->tensanpham }}</h3>
                <p class="product-description">{{ $sanpham->mota }}</p>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('user.chitiet',$sanpham->id_sanpham)}}" class="btn btn-outline-warning d-flex align-items-center">
                        <span class="me-2">View</span>
                        <i class="bx bx-chevron-right"></i>
                    </a>
                    <a class="btn btn-success d-flex align-items-center">
                        <i class="bx bx-cart mr-2"></i>
                        <span class="me-2"> Add to cart</span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Thêm nhiều sản phẩm tại đây -->
    {{-- <div class="product-card">
            <img src="https://via.placeholder.com/400x700" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">Tên Sản Phẩm</h3>
                <p class="product-description">Mô tả ngắn gọn về sản phẩm.Mô tả ngắn gọn về sản phẩm</p>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <button class="btn btn-outline-warning d-flex align-items-center">
                        <span class="me-2">View</span>
                        <i class="bx bx-chevron-right"></i>
                    </button>
                    <button class="btn btn-success d-flex align-items-center">
                        <i class="bx bx-cart mr-2"></i>
                        <span class="me-2"> Add to cart</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="product-card">
            <img src="https://via.placeholder.com/400x700" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">Tên Sản Phẩm</h3>
                <p class="product-description">Mô tả ngắn gọn về sản phẩm.</p>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <button class="btn btn-outline-warning d-flex align-items-center">
                        <span class="me-2">View</span>
                        <i class="bx bx-chevron-right"></i>
                    </button>
                    <button class="btn btn-success d-flex align-items-center">
                        <i class="bx bx-cart mr-2"></i>
                        <span class="me-2"> Add to cart</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="product-card">
            <img src="https://via.placeholder.com/400x700" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">Tên Sản Phẩm</h3>
                <p class="product-description">Mô tả ngắn gọn về sản phẩm.</p>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <button class="btn btn-outline-warning d-flex align-items-center">
                        <span class="me-2">View</span>
                        <i class="bx bx-chevron-right"></i>
                    </button>
                    <button class="btn btn-success d-flex align-items-center">
                        <i class="bx bx-cart mr-2"></i>
                        <span class="me-2"> Add to cart</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="product-card">
            <img src="https://via.placeholder.com/400x700" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">Tên Sản Phẩm</h3>
                <p class="product-description">Mô tả ngắn gọn về sản phẩm. Mô tả ngắn gọn về sản phẩm.</p>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <button class="btn btn-outline-warning d-flex align-items-center">
                        <span class="me-2">View</span>
                        <i class="bx bx-chevron-right"></i>
                    </button>
                    <button class="btn btn-success d-flex align-items-center">
                        <i class="bx bx-cart mr-2"></i>
                        <span class="me-2"> Add to cart</span>
                    </button>
                </div>
            </div>
        </div> --}}
</div>
