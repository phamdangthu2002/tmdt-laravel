<div class="row mb-5">
    <!-- Lặp qua danh sách sản phẩm -->
    @foreach ($sanphamMores as $sanphamMore)
        <div class="product-card">
            {{-- {!! \App\Helpers\Helper::price($sanphamMore->gia, $sanphamMore->sale) !!} --}}
            <img src="{{ $sanphamMore->hinhanh }}" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">{{ $sanphamMore->tensanpham }}</h3>
                <p class="product-description">{{ $sanphamMore->mota }}</p>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('user.chitiet', $sanphamMore->id_sanpham) }}"
                        class="btn btn-outline-warning d-flex align-items-center">
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
</div>
