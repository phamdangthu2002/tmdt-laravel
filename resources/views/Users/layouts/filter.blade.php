<style>
    .panel-filter {
        background-color: #ffffff;
        /* Nền màu trắng */
        border: 1px solid #e0e0e0;
        /* Viền màu xám nhạt */
        border-radius: 10px;
        /* Bo tròn góc nhiều hơn */
        overflow: hidden;
        padding: 0 15px 0 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Hiệu ứng đổ bóng nhẹ và rộng hơn */
        margin-bottom: 1rem;
    }

    .panel-filter h5 {
        color: #2d2d2d;
        /* Màu chữ xám đậm cho tiêu đề */
        font-weight: 600;
        /* Chữ đậm hơn cho tiêu đề */
    }

    .filter-link {
        display: block;
        border-radius: 8px;
        /* Bo tròn góc lớn hơn */
        text-decoration: none;
        color: #333;
        /* Màu chữ tối hơn */
        transition: background-color 0.4s ease, color 0.4s ease;
        /* Thời gian chuyển động mềm mại hơn */
    }

    .filter-link:hover {
        background-color: #f0f0f0;
        /* Nền màu xám nhạt khi hover */
        color: #1a73e8;
        /* Màu chữ xanh dương khi hover */
    }

    .filter-link-active {
        font-weight: 600;
        /* Chữ đậm hơn cho liên kết đang hoạt động */
        color: #1a73e8;
        /* Màu chữ xanh dương cho liên kết đang hoạt động */
        background-color: #f0f0f0;
        /* Nền màu xám nhạt cho liên kết đang hoạt động */
    }

    .toggle-filter {
        font-size: 1.5rem;
        color: #1a73e8;
        /* Màu xanh dương cho nút toggle */
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .toggle-filter:hover {
        color: #0056b3;
        /* Màu xanh dương đậm hơn khi hover */
    }

    .filter-content {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.8s ease, opacity 1s ease;
    }

    .filter-content.show {
        max-height: 1000px;
        transition: max-height 0.8s ease, opacity 1s ease;
        /* Giá trị lớn hơn max-height để đảm bảo toàn bộ nội dung hiển thị */
        opacity: 1;
    }
</style>


<!-- Filter -->
<div class="container mt-1">
    <div class="panel-filter w-100 mt-3 pt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="text-secondary mb-3">Filters</h5>
            <div class="btn btn-link toggle-filter">
                <i class='bx bx-filter-alt'></i>
            </div>
        </div>
        <div class="filter-content">
            <div class="wrap-filter row bg-light w-100 px-lg-5 pt-3 px-3">
                <!-- Sort By Column -->
                <div class="filter-col1 col-lg-6 mb-4">
                    <h5 class="text-secondary mb-3">Sort By</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ request()->url() }}" class="filter-link text-body">Default</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ request()->fullUrlWithQuery(['gia' => 'asc']) }}"
                                class="filter-link text-body">Price: Low to High</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ request()->fullUrlWithQuery(['gia' => 'desc']) }}"
                                class="filter-link text-body">Price: High to Low</a>
                        </li>
                    </ul>
                </div>

                <!-- Price Column -->
                <div class="filter-col2 col-lg-6 mb-4">
                    <h5 class="text-secondary mb-3">Price</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="filter-link text-body filter-link-active">All</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="filter-link text-body">$0.00 - $50.00</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="filter-link text-body">$50.00 - $100.00</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="filter-link text-body">$100.00 - $150.00</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="filter-link text-body">$150.00 - $200.00</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="filter-link text-body">$200.00+</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelector('.toggle-filter').addEventListener('click', function() {
        const filterContent = document.querySelector('.filter-content');
        filterContent.classList.toggle('show');
    });
</script>
