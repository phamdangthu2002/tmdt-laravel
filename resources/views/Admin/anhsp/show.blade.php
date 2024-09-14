 <h4>{{ $title }}</h4>
 <div class="container-danhmuc main-data mt-5">
     <h2 class="mb-4">{{ $title }}</h2>
     <div class="table-responsive">
         <table id="table_js" class="table table-striped" style="width:100%">
             <thead class="thead-dark">
                 <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Image</th>
                     <th scope="col">Trạng thái</th>
                     <th scope="col">Cập nhật</th>
                     <th scope="col">Thao tác</th>
                 </tr>
             </thead>
             <tbody>
                 @if (count($anhs) != 0)
                     @foreach ($anhs as $anh)
                         <tr>
                             <td>{{ $anh->id_anh }}</td>
                             <td><img src="{{ asset($anh->hinhanh) }}" class="img-thumbnail mb-2"
                                     style="max-height: 50px; width: auto;"></td>
                             </td>
                             <td>
                                 @if ($anh->trangthai == 1)
                                     <span class="text-success">Hoạt động</span>
                                 @else
                                     <span class="text-danger">Tạm khóa</span>
                                 @endif
                             </td>
                             <td>{{ $anh->updated_at }}</td>
                             <td>
                                 <form action="{{ route('admin.destroy-anh', $anh->id_anh) }}" method="post"
                                     class="delete-form" style="display:inline;" data-name="{{ $anh->hinhanh }}">
                                     @csrf
                                     <button type="submit" class="btn btn-danger bx bx-trash">Xóa</button>
                                 </form>
                             </td>
                         </tr>
                     @endforeach
                 @else
                     <tr>
                         <td colspan="5">Không có hinh anh nào để hiển thị.</td>
                     </tr>
                 @endif
             </tbody>
         </table>
     </div>
     <div class="col-md-6">
         @yield('noidung')
     </div>
 </div>
 <script src="/assets/vendor/ckeditor/ckeditor.js"></script>
 <script>
     CKEDITOR.replace('categoryDescription');
     document.addEventListener('DOMContentLoaded', function() {
         // Lắng nghe sự kiện submit của tất cả các form xóa
         document.querySelectorAll('.delete-form').forEach(form => {
             form.addEventListener('submit', function(event) {
                 event.preventDefault(); // Ngăn chặn hành vi mặc định của form

                 const form = event.target;
                 const categoryName = form.getAttribute(
                     'data-name'); // Lấy tên danh mục từ thuộc tính data-name

                 Swal.fire({
                     title: `Bạn có chắc chắn muốn xóa ảnh "${categoryName}" này không?`,
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
 </script>
