<div class="row mb-5">
    <!-- Lặp qua danh sách sản phẩm -->
    @foreach ($sanphamrandoms as $sanphamrandom)
        <div class="product-card">
            {!! \App\Helpers\Helper::price($sanphamrandom->gia, $sanphamrandom->sale) !!}
            <img src="{{ $sanphamrandom->hinhanh }}" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">{{ $sanphamrandom->tensanpham }}</h3>
                <p class="product-description">{{ $sanphamrandom->mota }}</p>
                <div class="button d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('user.chitiet', $sanphamrandom->id_sanpham) }}"
                        class="btn btn-outline-warning d-flex align-items-center">
                        <span class="me-2">View</span>
                        <i class="bx bx-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
