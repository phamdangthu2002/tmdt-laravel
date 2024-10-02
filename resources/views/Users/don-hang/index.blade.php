@extends('Users.index')

@section('main')

    <!-- jQuery and Bootstrap JS -->
    <script src="/assets/vendor/jquery-3.5.1.slim.min.js"></script>
    <script src="/assets/vendor/jquery-3.7.1.js"></script>
    <script src="/assets/vendor/bootstrap.bundle.min.js"></script>
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

        /* .timeline-event::before {
                                content: '✓';
                                position: absolute;
                                left: 10px;
                                top: 0;
                                width: 20px;
                                height: 20px;
                                background: rgb(29, 196, 29);
                                Màu sắc giống như TikTok Shop
                                border-radius: 50%;
                                border: 2px solid #fff;
                            } */
        .timeline-event::before {
            content: '✓';
            position: absolute;
            left: 10px;
            top: 0;
            width: 20px;
            height: 20px;
            background: rgb(71, 211, 89);
            border-radius: 50%;
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            /* Màu của dấu ✓ */
            font-size: 14px;
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

        .order-summary {
            font-size: 25px;
        }


        /* Điều chỉnh chiều rộng của modal */
        .modal-dialog {
            max-width: 1000px;
            /* Bạn có thể điều chỉnh kích thước này theo nhu cầu */
            margin: 10% auto;
        }

        /* Tùy chỉnh phần header của modal */
        .modal-header {
            background-color: rgb(25, 135, 84);
            /* Màu xanh của nút xem chi tiết */
            color: rgb(255, 202, 44);
            border-bottom: none;
        }

        /* Tùy chỉnh nút đóng (close button) */
        .modal-header .close {
            color: white;
            opacity: 0.8;
        }

        .modal-header .close:hover {
            opacity: 1;
        }

        /* Tùy chỉnh nội dung bên trong modal */
        .modal-body {
            padding: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        /* Định dạng cho table */
        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .table tbody tr td {
            vertical-align: middle;
            text-align: center;
        }

        .table tbody tr img {
            width: 50px;
            height: auto;
            border-radius: 5px;
        }

        /* Tùy chỉnh phần footer của modal */
        .modal-footer {
            border-top: none;
            padding-top: 10px;
        }

        /* Định dạng nút Đóng
                            .modal-footer .btn-secondary {
                                background-color: #db3030;
                                border-color: #db3030;
                            } */

        /* Đảm bảo modal xuất hiện phía trên tất cả các phần tử khác */
        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }

        /* Animation cho modal */
        .modal.fade .modal-dialog {
            -webkit-transform: translate(0, -50px);
            transform: translate(0, -50px);
            -webkit-transition: -webkit-transform 0.3s ease-out;
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            -webkit-transform: translate(0, 0);
            transform: translate(0, 0);
        }

        l {
            border-bottom: 2px solid black;
        }
    </style>
    <div class="container-cart mt-5 mb-5">
        <h2>
            <p><b>Đơn hàng</b></p>
        </h2>
        @if (count($donhangs) != 0)
            @foreach ($donhangs as $donhang)
                <h1>Chi Tiết Đơn Hàng #{{ $donhang->id_donhang }}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="order-summary">
                            <h2><b>Tóm Tắt Đơn Hàng</b></h2>
                            <p><strong>
                                    <l>Khách Hàng:</l>
                                </strong> {{ $donhang->user->name }}</p>
                            <p><strong>ID đơn hàng</strong> {{ $donhang->id_donhang }}</p>
                            <p><strong>Số lượng sản phẩm:</strong> {{ $donhang->ctdh->sum('soluong') }}</p>
                            <p><strong>Ngày Đặt:</strong>
                                {{ \Carbon\Carbon::parse($donhang->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i A') }}
                                <br>
                                {{ \Carbon\Carbon::parse($donhang->created_at)->format('l, d F Y') }}
                            </p>
                            <p><strong>Tổng Số Tiền: </strong>{{ \App\Helpers\Helper::formatVND($donhang->tong) }}
                            </p>
                            <button type="button" class="btn btn-outline-success" data-id="{{ $donhang->id_donhang }}"
                                data-toggle="modal" data-target="#orderDetailsModal">
                                Xem chi tiết
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog"
                                aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderDetailsModalLabel">Chi Tiết Đơn Hàng</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Số lượng</th>
                                                        <th>Size</th>
                                                        <th>Màu sắc</th>
                                                        <th>Tổng số tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning"
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
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
            <h4>
                <p>Bạn chưa có đơn hàng. <a href="/">Hãy mua ngay!</a></p>
            </h4>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            // Khi nhấn nút "Xem chi tiết"
            $('button[data-target="#orderDetailsModal"]').on('click', function() {
                var orderId = $(this).data('id');

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '/User/' + orderId + '/detail',
                    method: 'GET',
                    success: function(response) {
                        // Cập nhật nội dung modal với dữ liệu đơn hàng
                        var tbody = $('#orderDetailsModal .modal-body tbody');
                        tbody.empty();

                        response.ctdhs.forEach(function(item) {
                            tbody.append(
                                '<tr>' +
                                '<td><img src="' + item.sanpham.hinhanh +
                                '" alt="" width="50"></td>' +
                                '<td>' + item.sanpham.tensanpham + '</td>' +
                                '<td>' + item.soluong + '</td>' +
                                '<td>' + item.size.tensize + '</td>' +
                                '<td>' + item.color.tencolor + '</td>' +
                                '<td>' + item.formatted_gia + '</td>' +
                                '</tr>'
                            );
                        });
                        // Hiển thị modal
                        $('#orderDetailsModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
        $(document).ready(function() {
            // Khi nút "Đóng" hoặc dấu "X" được nhấn
            $('.btn-warning, .close').on('click', function() {
                $('#orderDetailsModal').modal('hide'); // Ẩn modal
            });
        });
    </script>
@endsection
