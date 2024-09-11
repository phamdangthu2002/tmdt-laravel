$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//admin
$('#custom-hinhanh').change(function () {
    const form = new FormData();
    const files = $(this)[0].files;

    for (let i = 0; i < files.length; i++) {
        form.append('files[]', files[i]);
    }

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/Admin/uploadAnh/services',
        success: function (data) {
            console.log(data); // Kiểm tra dữ liệu trả về từ server

            if (data.error === false) {
                if (Array.isArray(data.urls)) {
                    $('#custom-file').val(data.urls.join(','));
                    $('#custom-file-preview').val(data.urls.join(','));

                    const fileList = $('#custom-file-list');
                    fileList.empty(); // Xóa nội dung cũ
                    data.urls.forEach(url => {
                        fileList.append(`<p><a href="${url}" target="_blank">${url}</a></p>`);
                    });

                    $('#custom-file-count').text(`Đã thêm ${data.urls.length}/5 file`);
                } else {
                    alert('Dữ liệu nhận được không đúng định dạng.');
                }
            } else {
                alert(data.message || 'Có lỗi xảy ra trong quá trình tải lên.');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Upload failed: ', textStatus, errorThrown);
            alert('Có lỗi xảy ra trong quá trình tải lên. Vui lòng thử lại.');
        }
    });
});




// upload
$('#hinhanh').change(function () {
    const form = new FormData();
    // Lấy tệp tin đầu tiên từ input file
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/Admin/upload/services',
        success: function (data) {
            if (data.error == false) {
                $('#file').val(data.url);
                $('#file-preview').val(data.url);

            } else {
                alert(data.error);
            }
        },
    });
});

function uploadFile(file) {
    const form = new FormData();
    form.append('file', file);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/Admin/upload/services',
        success: function (data) {
            if (data.error == false) {
                $('#file').val(data.url);
                $('#file-preview').val(data.url);
            } else {
                alert(data.error);
            }
        },
    });
}


// user

function loadMore() {
    const page = $('#page').val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: { page },
        url: '/User/load-more',
        success: function (data) {
            if (data !== '') {
                $('#load').append(data.html);
                $('#page').val(page + 1);
            }
            alert('Đã load thêm sản phẩm');
            $('#btn-load-more').css('display', 'none');
        }
    });
}



// Hàm xác nhận đăng xuất
function confirmLogout(event) {
    event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

    Swal.fire({
        title: 'Bạn có chắc chắn muốn đăng xuất?',
        text: "Bạn sẽ bị đưa trở lại trang đăng nhập.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đăng xuất',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '#'; // Thay đổi đường dẫn theo cấu hình của bạn
        }
    });
}



//nút tìm kiếm
// Khi bấm vào biểu tượng tìm kiếm
document.getElementById('searchToggle').addEventListener('click', function (e) {
    e.preventDefault();
    const searchContainer = document.getElementById('searchContainer');

    // Kiểm tra trạng thái hiển thị của ô tìm kiếm
    if (searchContainer.style.display === 'none' || searchContainer.style.width === '0px') {
        searchContainer.style.display = 'block';
        anime({
            targets: '#searchContainer',
            width: '250px',
            easing: 'easeInOutQuad',
            duration: 500
        });
    } else {
        // // Nếu ô tìm kiếm đã mở, thu nhỏ ô tìm kiếm về kích thước 0
        // anime({
        //     targets: '#searchContainer',
        //     width: '0',
        //     easing: 'easeInOutQuad',
        //     duration: 500,
        //     complete: function() {
        //         searchContainer.style.display = 'none';
        //         document.getElementById('searchInput').value = ''; // Xóa nội dung ô tìm kiếm
        //     }
        // });
    }
});

// Khi bấm vào dấu x
document.getElementById('closeSearch').addEventListener('click', function (e) {
    e.preventDefault();
    const searchContainer = document.getElementById('searchContainer');

    anime({
        targets: '#searchContainer',
        width: '0',
        easing: 'easeInOutQuad',
        duration: 500,
        complete: function () {
            searchContainer.style.display = 'none';
            document.getElementById('searchInput').value = ''; // Xóa nội dung ô tìm kiếm
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Xử lý sự kiện khi chọn kích thước
    const sizeOptions = document.querySelectorAll('.size-option input');
    sizeOptions.forEach(option => {
        option.addEventListener('change', function () {
            // Xóa lớp 'active' khỏi tất cả các tùy chọn
            sizeOptions.forEach(opt => opt.parentElement.classList.remove('active'));
            // Thêm lớp 'active' vào tùy chọn hiện tại
            this.parentElement.classList.add('active');
        });
    });

    // Xử lý sự kiện khi chọn màu sắc
    const colorOptions = document.querySelectorAll('.color-option input');
    colorOptions.forEach(option => {
        option.addEventListener('change', function () {
            // Xóa lớp 'active' khỏi tất cả các tùy chọn
            colorOptions.forEach(opt => opt.parentElement.classList.remove('active'));
            // Thêm lớp 'active' vào tùy chọn hiện tại
            this.parentElement.classList.add('active');
        });
    });

    // Xử lý sự kiện khi chọn hình thu nhỏ
    const slides = document.querySelectorAll('.slides li');
    const thumbnails = document.querySelectorAll('.thumbnails li a img');

    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', function (event) {
            event.preventDefault();
            // Ẩn tất cả các slide
            slides.forEach(slide => slide.style.display = 'none');
            // Ẩn viền của tất cả các hình thu nhỏ
            thumbnails.forEach(thumb => thumb.classList.remove('active'));
            // Hiển thị slide tương ứng với hình thu nhỏ được chọn
            slides[index].style.display = 'block';
            // Thêm viền vào hình thu nhỏ được chọn
            thumbnails[index].classList.add('active');
        });
    });
});