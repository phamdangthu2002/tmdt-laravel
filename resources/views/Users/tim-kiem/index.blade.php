@extends('Users.index')
@section('main')
    <div class="container mt-5">
        <h3><label for=""><b>Kết quả tìm kiếm cho "{{ $key }}":</b></label></h3><br>
        <div class="row">
            @if (count($sanphams) > 0)
                @foreach ($sanphams as $sanpham)
                    <div class="product-card">
                        <img src="{{ $sanpham->hinhanh }}" alt="Sản phẩm">
                        <div class="product-info">
                            <h3 class="product-title">{{ $sanpham->tensanpham }}</h3>
                            <p class="product-description">{{ $sanpham->mota }}</p>
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('user.chitiet', $sanpham->id_sanpham) }}"
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
            @else
                <p>Không có sản phẩm nào</p>
            @endif
        </div>
    </div>
@endsection
