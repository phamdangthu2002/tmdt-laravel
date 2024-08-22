<?php
namespace App\Helpers;

class Helper
{
    public static function danhmuc($danhmucs)
    {
        $html = '';

        foreach ($danhmucs as $danhmuc) {
            $id = htmlspecialchars($danhmuc->id_danhmuc, ENT_QUOTES, 'UTF-8');
            $tendanhmuc = htmlspecialchars($danhmuc->tendanhmuc, ENT_QUOTES, 'UTF-8');
            $mota = htmlspecialchars($danhmuc->mota, ENT_QUOTES, 'UTF-8');
            $trangthai = $danhmuc->trangthai;
            $statusText = $trangthai == 1 ? 'Hoạt động' : 'Tạm khóa';
            $statusClass = $trangthai == 1 ? 'text-success' : 'text-danger';

            // Tạo URL cho hành động xóa và chỉnh sửa
            $deleteUrl = route('admin.delete-danh-muc', $id);
            $editUrl = route('admin.edit-danh-muc', $id);

            $html .= '
                <tr>
                    <td>' . $id . '</td>
                    <td>' . $tendanhmuc . '</td>
                    <td>' . $mota . '</td>
                    <td><span class="' . $statusClass . '">' . $statusText . '</span></td>
                    <td>
                        <form action="' . $editUrl . '" method="post" class="edit-form" style="display:inline;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method">
                            <button type="submit" class="btn btn-outline-warning bx bx-edit"></button>
                        </form>
                        <form action="' . $deleteUrl . '" method="post" class="delete-form" style="display:inline;">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger bx bx-trash"></button>
                        </form>
                    </td>
                </tr>';
        }

        return $html;
    }

}
// <a href="' . route('admin.delete-danh-muc', $danhmuc->id_danhmuc) . '" 
// onclick="return deleteDanhMuc(' . $danhmuc->id_danhmuc . ');" 
// class="btn btn-outline-danger bx bx-trash"></a>