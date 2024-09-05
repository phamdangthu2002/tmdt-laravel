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

    <form action="{{ route('admin.store-san-pham') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF Token -->
        <div class="container-danhmuc mt-5">
            <h1 class="mb-3">{{ $title }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mota"><b>Mô tả</b></label>
                        <textarea class="form-control" id="mota" name="mota" rows="3" placeholder="Nhập mô tả sản phẩm">{{ old('mota') }}</textarea>
                    </div>
                    @if ($errors->has('mota'))
                        <p class="error-message">*
                            {{ $errors->first('mota') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tensanpham"><b>Tên sản phẩm</b></label>
                            <input type="text" class="form-control" id="tensanpham" value="{{ old('tensanpham') }}"
                                name="tensanpham" placeholder="Nhập tên sản phẩm">
                            @if ($errors->has('tensanpham'))
                                <p class="error-message">*
                                    {{ $errors->first('tensanpham') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="id_danhmuc"><b>Danh mục</b></label>
                            <select class="form-control" id="id_danhmuc" name="id_danhmuc">
                                <!-- Duyệt qua danh sách các danh mục -->
                                @foreach ($danhmucs as $danhmuc)
                                    <option value="{{ $danhmuc->id_danhmuc }}">{{ $danhmuc->tendanhmuc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gia"><b>Giá</b></label>
                                <input type="number" class="form-control" value="{{ old('gia') }}" id="gia"
                                    name="gia" placeholder="Nhập giá sản phẩm">
                                @if ($errors->has('gia'))
                                    <p class="error-message">*
                                        {{ $errors->first('gia') }}
                                    </p>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sale"><b>Sale (%)</b></label>
                                <input type="number" class="form-control" id="sale" value="{{ old('sale') }}"
                                    name="sale" placeholder="Nhập phần trăm giảm giá">
                                @if ($errors->has('sale'))
                                    <p class="error-message">*
                                        {{ $errors->first('sale') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="soluong"><b>Số lượng</b></label>
                                <input type="number" class="form-control" id="soluong" value="{{ old('soluong') }}"
                                    name="soluong" placeholder="Nhập số lượng sản phẩm">
                                @if ($errors->has('soluong'))
                                    <p class="error-message">*
                                        {{ $errors->first('soluong') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="trangthai"><b>Trạng thái</b></label>
                                <select class="form-control" id="trangthai" name="trangthai">
                                    <option value="1" {{ old('trangthai') == '1' ? 'selected' : '' }}>Hiển thị
                                    </option>
                                    <option value="0" {{ old('trangthai') == '0' ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="hinhanh"><b>Hình ảnh</b></label>
                            <div id="drop-zone" class="p-3">
                                <div class="form-group mb-3 mt-1">
                                    <input type="text" class="form-control text-decorate-none" id="file-preview" />
                                </div>
                                <p>Thêm ảnh ở đây</p>
                                <div id="file-count" class="mt-2">Đã thêm 0/1 file</div>
                                @if ($errors->has('file'))
                                    <p class="error-message">*
                                        {{ $errors->first('file') }}
                                    </p>
                                @endif
                                <input type="file" class="form-control-file" id="hinhanh" name="hinhanh" multiple>
                                <div id="preview-zone" class="mt-3"></div>
                                <input type="hidden" name="file" id="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm sản phẩm</button>
        </div>
    </form>
    <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
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
