$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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
        url: '/upload/services',
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

$('#avatar').change(function () {
    const form = new FormData();
    // Lấy tệp tin đầu tiên từ input file
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/upload/services',
        success: function (data) {
            if (data.error == false) {
                $('#preview').val(data.url);
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
        url: '/upload/services',
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
            window.location.href = '/Auth/users/logout'; // Thay đổi đường dẫn theo cấu hình của bạn
        }
    });
}


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
    // Lắng nghe sự kiện submit của tất cả các form xóa
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của form

            const form = event.target;
            const categoryName = form.getAttribute(
                'data-name'); // Lấy tên danh mục từ thuộc tính data-name

            Swal.fire({
                title: `Bạn có chắc chắn muốn xóa "${categoryName}" này không?`,
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