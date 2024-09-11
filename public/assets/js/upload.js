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