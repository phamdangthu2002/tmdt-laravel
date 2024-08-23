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