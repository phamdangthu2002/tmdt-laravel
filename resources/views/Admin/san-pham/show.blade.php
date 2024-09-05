@extends('Admin.index')
@section('content')
    <h4>{{ $title }}</h4>
    <style>
        #hinhanh {
            display: none;
        }

        #drop-zone {
            background-color: #f8f9fa;
            border: 2px dashed #ced4da;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: background-color 0.3s ease-in-out;
            padding: 10px;
            min-width: 200px;
            min-height: 214px;
            width: auto;
        }

        #drop-zone.border-primary {
            background-color: #e9ecef;
            border: 2px solid #007bff;
        }

        #drop-zone p {
            font-size: 16px;
            color: #6c757d;
        }

        #file-count {
            font-size: 14px;
            color: #28a745;
            font-weight: bold;
        }

        #preview-zone {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            /* Khoảng cách giữa các ảnh */
            width: 100%;
            /* Đảm bảo khu vực xem trước chiếm toàn bộ chiều rộng của phần tử chứa */
            max-width: 100%;
            /* Đảm bảo khu vực xem trước không vượt quá chiều rộng của phần tử chứa */
        }


        #preview-zone .col-md-3 {
            position: relative;
            width: calc(25% - 10px);
            /* Chiều rộng của mỗi ảnh chiếm 1/4 khu vực xem trước, trừ khoảng cách */
            max-width: 100%;
            /* Giới hạn kích thước tối đa của phần tử chứa ảnh */
            box-sizing: border-box;
            /* Đảm bảo tính toán kích thước bao gồm padding và border */
        }


        #preview-zone img {
            width: 100%;
            /* Chiều rộng ảnh chiếm toàn bộ không gian của phần tử chứa */
            height: auto;
            /* Để giữ tỷ lệ khung hình */
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }


        #preview-zone img:hover {
            transform: scale(1.05);
            /* Hiệu ứng phóng to khi di chuột qua */
        }

        #preview-zone .btn-danger {
            position: absolute;
            top: -15px;
            right: -5px;
            padding: 2px 6px;
            font-size: 12px;
        }

        h1 {
            font-weight: bold;
        }

        .text-decorate-none {
            text-decoration: none;
            border: none;
            /* Không có gạch chân văn bản */
        }

        /* Nếu bạn muốn thêm một số hiệu ứng hoặc chỉnh sửa khác */
        #file-preview {
            /* Thay đổi kích thước, màu sắc, và kiểu chữ nếu cần */
            font-size: 13px;
            border-radius: 4px;
            background-color: #f8f9fa;
            width: 470px;
            text-align: center;
        }

        .error-message {
            color: red !important;
        }
    </style>
    <div class="container-danhmuc main-data mt-5">
        <h2 class="mb-4">{{ $title }}</h2>
        <div class="table-responsive">
            <table id="table_js" class="table table-striped" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" style="width: 140px";>Tên sản phẩm</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col" style="width: 140px";>Giá</th>
                        <th scope="col" style="width: 140px";>Sale</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Lượt mua</th>
                        <th scope="col">Lượt xem</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Cập nhật</th>
                        <th scope="col" style="width: 140px";>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($sanphams)
                        @foreach ($sanphams as $sanpham)
                            <tr>
                                <td>{{ $sanpham->id_sanpham }}</td>
                                <td>{{ $sanpham->tensanpham }}</td>
                                <td>{{ $sanpham->mota }}</td> <!-- Swap with the correct column -->
                                <td>{{ $sanpham->gia }} VND</td>
                                <td>{{ $sanpham->sale }} VND</td>
                                <td>{{ $sanpham->soluong }}</td>
                                <td>{{ $sanpham->luotmua }}</td>
                                <td>{{ $sanpham->luotxem }}</td>
                                <td><img src="{{ asset($sanpham->hinhanh) }}" class="img-thumbnail mb-2"
                                        style="max-height: 50px; width: auto;"></td>
                                <td>
                                    @if ($sanpham->trangthai == 1)
                                        <span class="text-success">Hoạt động</span>
                                    @else
                                        <span class="text-danger">Tạm khóa</span>
                                    @endif
                                </td>
                                <td>{{ $sanpham->updated_at }}</td>
                                <td>
                                    <!-- Nút sửa -->
                                    <a href="{{ route('admin.store-edit-san-pham', $sanpham->id_sanpham) }}"
                                        class="btn btn-outline-warning bx bx-edit"></a>
                                    <!-- Form xóa với SweetAlert -->
                                    <form action="{{ route('admin.delete-san-pham', $sanpham->id_sanpham) }}"
                                        method="post" class="delete-form" style="display:inline;"
                                        data-name="{{ $sanpham->tensanpham }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger bx bx-trash"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Không có danh mục nào để hiển thị.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{-- {{ $sanphams->links() }} --}}
            <div class="pagination justify-content-center">
                <ul class="pagination">
                    {{-- Nút Trang đầu --}}
                    @if ($sanphams->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.first')">
                            <span class="page-link" aria-hidden="true">&laquo;Trang đầu</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $sanphams->url(1) }}" aria-label="@lang('pagination.first')">&laquo;Trang
                                đầu</a>
                        </li>
                    @endif

                    {{-- Nút Previous --}}
                    @if ($sanphams->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $sanphams->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif
                    {{-- Các số trang --}}
                    @foreach ($pageNumbers as $pageNumber)
                        <li class="page-item {{ $pageNumber == $sanphams->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $sanphams->url($pageNumber) }}">{{ $pageNumber }}</a>
                        </li>
                    @endforeach

                    {{-- Nút Next --}}
                    @if ($sanphams->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $sanphams->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif

                    {{-- Nút Trang cuối --}}
                    @if ($sanphams->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $sanphams->url($sanphams->lastPage()) }}"
                                aria-label="@lang('pagination.last')">Trang cuối&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.last')">
                            <span class="page-link" aria-hidden="true">Trang cuối&raquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @yield('noidung')
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lắng nghe sự kiện submit của tất cả các form xóa
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Ngăn chặn hành vi mặc định của form

                    const form = event.target;
                    const tensanpham = form.getAttribute(
                        'data-name'); // Lấy tên danh mục từ thuộc tính data-name

                    Swal.fire({
                        title: `Bạn có chắc chắn muốn xóa sản phẩm "${tensanpham}" này không?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Nếu người dùng xác nhận, thực hiện submit form
                        }
                    });
                });
            });
        });
        // Khởi tạo CKEditor cho trường mô tả (mota)
        CKEDITOR.replace('mota');

        // Biến cho vùng thả file, input file, vùng preview và biến đếm số lượng file
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('hinhanh');
        const previewZone = document.getElementById('preview-zone');
        let totalFiles = 0;
        const maxFiles = 1; // Giới hạn số lượng file có thể tải lên

        // Sự kiện khi kéo file vào vùng drop-zone
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault(); // Ngăn sự kiện mặc định của trình duyệt
            dropZone.classList.add('border-primary'); // Thêm class để thay đổi border khi kéo file vào
        });

        // Sự kiện khi rời chuột khỏi vùng drop-zone mà không thả file
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-primary'); // Xóa class để border trở lại bình thường
        });

        // Sự kiện khi thả file vào vùng drop-zone
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault(); // Ngăn sự kiện mặc định của trình duyệt
            dropZone.classList.remove('border-primary'); // Xóa class để border trở lại bình thường

            const files = e.dataTransfer.files; // Lấy danh sách file được thả vào

            // Kiểm tra nếu có file nào được thả vào
            if (files.length > 0) {
                handleFiles(files); // Xử lý file được thả vào

                // Gọi hàm uploadFile để tải file đầu tiên lên
                uploadFile(files[0]); // Chỉ tải file đầu tiên trong danh sách
            }
        });


        // Sự kiện khi click vào vùng drop-zone để mở trình duyệt file
        dropZone.addEventListener('click', () => {
            fileInput.click(); // Giả lập sự kiện click để mở hộp thoại chọn file
        });

        // Sự kiện khi chọn file qua input file
        fileInput.addEventListener('change', () => {
            handleFiles(fileInput.files); // Xử lý file được chọn qua input
        });

        // Hàm xử lý file, kiểm tra số lượng file tải lên
        function handleFiles(files) {
            if (totalFiles + files.length > maxFiles) {
                alert(`Bạn chỉ có thể tải lên tối đa ${maxFiles} file.`); // Thông báo nếu vượt quá số lượng file cho phép
                return;
            }
            previewImages(files); // Gọi hàm để hiển thị preview của file
        }

        // Hàm hiển thị hình ảnh preview
        function previewImages(files) {
            if (totalFiles + files.length > maxFiles) {
                alert(`Bạn chỉ có thể tải lên tối đa ${maxFiles} file.`); // Thông báo nếu vượt quá số lượng file cho phép
                return;
            }

            Array.from(files).forEach(file => {
                const reader = new FileReader(); // Tạo đối tượng FileReader để đọc nội dung file
                reader.onload = function(e) {
                    const colDiv = document.createElement('div'); // Tạo một thẻ div chứa hình ảnh và nút xóa
                    colDiv.classList.add('col-md-3'); // Thêm class để định dạng

                    const img = document.createElement('img'); // Tạo thẻ img để hiển thị hình ảnh
                    img.src = e.target.result; // Gán dữ liệu hình ảnh vào thuộc tính src
                    img.classList.add('img-thumbnail', 'mb-2'); // Thêm class để định dạng
                    img.style.maxHeight = '100px'; // Đặt kích thước tối đa của ảnh (có thể tùy chỉnh)
                    img.style.width = 'auto'; // Để giữ tỷ lệ của ảnh

                    const removeBtn = createRemoveButton(colDiv); // Tạo nút xóa cho ảnh

                    colDiv.appendChild(img); // Thêm ảnh vào div
                    colDiv.appendChild(removeBtn); // Thêm nút xóa vào div
                    previewZone.appendChild(colDiv); // Thêm div chứa ảnh và nút xóa vào vùng preview
                    totalFiles++; // Tăng số lượng file hiện tại
                    updateFileCount(); // Cập nhật số lượng file hiện tại
                };
                reader.readAsDataURL(file); // Đọc file và trả về URL dữ liệu dạng chuỗi base64
            });
        }

        // Hàm tạo nút xóa và gắn sự kiện xóa cho nút
        function createRemoveButton(colDiv) {
            const removeBtn = document.createElement('button'); // Tạo thẻ button
            removeBtn.textContent = 'Xóa'; // Đặt tên cho nút
            removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'mt-2'); // Thêm class để định dạng
            removeBtn.addEventListener('click', (event) => {
                event.stopPropagation(); // Ngăn sự kiện không bị lan ra ngoài
                colDiv.remove(); // Xóa div chứa ảnh và nút xóa
                totalFiles--; // Giảm số lượng file hiện tại
                updateFileCount(); // Cập nhật số lượng file hiện tại
            });
            return removeBtn; // Trả về nút xóa
        }

        // Hàm cập nhật hiển thị số lượng file đã thêm
        function updateFileCount() {
            document.getElementById('file-count').textContent = `Đã thêm ${totalFiles}/${maxFiles} file`;
        }
    </script>
@endsection
