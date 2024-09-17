@extends('Admin.index')
@section('content')
    <link rel="stylesheet" href="/assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="/assets/vendor/chart-js-v4.4.1.js"></script>
    <style>
        .dashboard-card {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <!-- Tổng Quan Thống Kê -->
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Số Đơn Hàng</h5>
                        <p class="card-text" id="totalOrders">{{ count($donhangs) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Doanh Thu</h5>
                        <p class="card-text" id="totalRevenue">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Sản Phẩm Bán Chạy</h5>
                        <p class="card-text" id="topSellingProducts">
                            @if ($topSellingProduct)
                                {{ $topSellingProduct->sanpham->tensanpham }} - {{ $topSellingProduct->total_quantity }} sản
                                phẩm đã bán
                            @else
                                Không có dữ liệu
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Biểu Đồ -->
            <div class="col-md-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Doanh Thu Theo Tháng</h5>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Trạng Thái Đơn Hàng</h5>
                        <div class="chart-container">
                            <canvas id="orderStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Danh Sách Đơn Hàng Mới -->
            <div class="col-md-12">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Đơn Hàng Mới Nhất</h5>
                        <div class="table-responsive">
                            <table id="recentOrdersTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Số Đơn Hàng</th>
                                        <th>Khách Hàng</th>
                                        <th>Sản Phẩm</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngày Tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td>{{ $order->id_donhang }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->sanpham->tensanpham }}</td>
                                            <td>{{ $order->trangthais->tentrangthai }}</td>
                                            <td>{{ $order->created_at->format('d/m/Y H:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dữ liệu giả cho biểu đồ
        // const revenueData = {
        //     labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
        //     datasets: [{
        //         label: 'Doanh Thu',
        //         data: [120000, 150000, 180000, 210000, 240000, 270000],
        //         backgroundColor: 'rgba(75, 192, 192, 0.2)',
        //         borderColor: 'rgba(75, 192, 192, 1)',
        //         borderWidth: 1
        //     }]
        // };

        // const orderStatusData = {
        //     labels: ['Đã Xử Lý', 'Đang Chờ', 'Đã Hủy'],
        //     datasets: [{
        //         data: [50, 30, 20],
        //         backgroundColor: ['#36a2eb', '#ff6384', '#ffce56']
        //     }]
        // };

        // const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        // const revenueChart = new Chart(ctxRevenue, {
        //     type: 'bar',
        //     data: revenueData,
        //     options: {
        //         responsive: true
        //     }
        // });

        // const ctxOrderStatus = document.getElementById('orderStatusChart').getContext('2d');
        // const orderStatusChart = new Chart(ctxOrderStatus, {
        //     type: 'pie',
        //     data: orderStatusData,
        //     options: {
        //         responsive: true
        //     }
        // });
        // Dữ liệu từ Laravel Blade
        const revenueByMonth = @json($revenueByMonth);

        // Chuyển dữ liệu từ Laravel thành các mảng cho biểu đồ
        const months = revenueByMonth.map(item => `Tháng ${item.month}`);
        const totalRevenue = revenueByMonth.map(item => item.total);

        // Cập nhật dữ liệu biểu đồ
        const revenueData = {
            labels: months,
            datasets: [{
                label: 'Doanh Thu',
                data: totalRevenue,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'bar',
            data: revenueData,
            options: {
                responsive: true
            }
        });





        // Dữ liệu từ Laravel Blade
        const orderStatuses = @json($orderStatuses);

        // Chuyển dữ liệu từ Laravel thành các mảng cho biểu đồ
        const labels = orderStatuses.map(status => status.tentrangthai);
        const data = orderStatuses.map(status => status.total);
        const backgroundColors = ['#36a2eb', '#ff6384', '#ffce56']; // Màu nền cho từng trạng thái

        const orderStatusData = {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColors
            }]
        };

        const ctxOrderStatus = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(ctxOrderStatus, {
            type: 'pie', // Hoặc 'doughnut'
            data: orderStatusData,
            options: {
                responsive: true
            }
        });
    </script>
@endsection
