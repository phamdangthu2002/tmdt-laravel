@extends('Users.index')

@section('main')
    <style>
        .order-progress {
            margin-top: -70px;
        }

        .timeline {
            position: relative;
            padding: 10px 0;
            list-style: none;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e0e0e0;
        }

        .timeline-event {
            position: relative;
            margin-bottom: 20px;
            padding-left: 50px;
        }

        .timeline-event::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            width: 20px;
            height: 20px;
            background: #ff6f61;
            /* Màu sắc giống như TikTok Shop */
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .timeline-date {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .timeline-description {
            background: #f5f5f5;
            /* Màu nền mô tả sự kiện */
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #img {
            width: 100%;
            height: 70%;
        }
    </style>
    <div class="container mt-5">
        @if (count($donhangs) != 0)
            @foreach ($donhangs as $donhang)
                <h1>Chi Tiết Đơn Hàng #{{ $donhang->id_donhang }}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <p><img src="{{ $donhang->sanpham->hinhanh }}" id="img" alt=""></p>
                                {{-- <p><img src="https://via.placeholder.com/200x270" alt=""></p> --}}
                            </div>
                            <div class="col-md-8">
                                <div class="order-summary">
                                    <h2>Tóm Tắt Đơn Hàng</h2>
                                    <p><strong>Khách Hàng:</strong> {{ $donhang->user->name }}</p>
                                    <p><strong>Tên sản phẩm</strong> {{ $donhang->sanpham->tensanpham }}</p>
                                    <p><strong>Số lượng:</strong> {{ $donhang->soluong }}</p>
                                    <p><strong>Ngày Đặt:</strong> {{ $donhang->created_at }}</p>
                                    <p><strong>Tổng Số Tiền: </strong>{{ \App\Helpers\Helper::formatVND($donhang->tong) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="order-progress">
                            <h2>Tiến Trình Đơn Hàng #{{ $donhang->id_donhang }}</h2>
                            <div class="timeline">
                                @foreach ($donhang->trangthaiDonHangs as $trangthai)
                                    <div class="timeline-event">
                                        <div class="timeline-date">
                                            {{ \Carbon\Carbon::parse($trangthai->ngaycapnhat)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i A') }}
                                            <br>
                                            {{ \Carbon\Carbon::parse($trangthai->ngaycapnhat)->format('l, d F Y') }}
                                        </div>
                                        <div class="timeline-description">{{ $trangthai->trangthai->tentrangthai }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        @else
            <label for="">
                <h3>
                    <b>Đơn hàng trống</b>
                </h3>
            </label>
        @endif
    </div>
@endsection
