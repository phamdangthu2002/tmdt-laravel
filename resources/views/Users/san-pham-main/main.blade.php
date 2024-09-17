<style>
    .text-time {
        position: absolute;
        top: 0;
        left: 0;
        padding: 5px 10px;
        background-color: rgb(207, 60, 60);
        /* Màu nền trong suốt */
        color: white;
        font-size: 12px;
        border-radius: 3px;
        z-index: 10000;
    }
</style>
<div class="row mb-5">
    <!-- Lặp qua danh sách sản phẩm -->
    @foreach ($sanphams as $sanpham)
        <div class="product-card">
            {!! \App\Helpers\Helper::timeSince($sanpham->updated_at) !!}
            <img src="{{ $sanpham->hinhanh }}" alt="Sản phẩm">
            <div class="product-info">
                <h3 class="product-title">{{ $sanpham->tensanpham }}</h3>
                <p class="product-description">{{ $sanpham->mota }}</p>
                <div class="button d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('user.chitiet', $sanpham->id_sanpham) }}"
                        class="btn btn-outline-warning d-flex align-items-center">
                        <span class="me-2">View</span>
                        <i class="bx bx-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

</div>
