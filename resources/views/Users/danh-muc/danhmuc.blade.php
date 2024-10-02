@extends('Users.index')
@section('main')
    <style>
        .container-dmu {
            width: 90%;
            margin-left: 9%;
            margin-right: 9%;
        }
    </style>
    <title>{{ $title }}</title>
    @include('Users.layouts.filter')
    <div class="container-dmu mt-5 mb-5" id="load">
        <div class="row mb-5">
            <!-- Lặp qua danh sách sản phẩm -->
            @if (count($sanphams) != 0)
                @foreach ($sanphams as $sanpham)
                    <div class="product-card">
                        {!! \App\Helpers\Helper::price($sanpham->gia, $sanpham->sale) !!}
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
            @else
                <p class="text-center">Sản phẩm đang được cập nhật...</p>
            @endif
        </div>
    </div>
@endsection
