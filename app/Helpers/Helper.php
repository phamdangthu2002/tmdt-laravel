<?php
namespace App\Helpers;

use App\Models\DanhmucCon;
use Illuminate\Support\Str;

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


    public static function menu($danhmucs, $danhmuccons, $parent_id = 0)
    {
        $html = '';

        foreach ($danhmucs as $danhmuc) {
            if ($danhmuc->parent_id == $parent_id) {
                $html .= '
                    <li class="nav-item dropdown">
                        <a class="nav-link">
                        ' . $danhmuc->tendanhmuc . '
                        </a>';

                // Kiểm tra nếu có danh mục con thuộc về danh mục này
                if (self::isChild($danhmuccons, $danhmuc->id_danhmuc)) {
                    $html .= '<ul class="dropdown-menu">';
                    // Gọi lại menu cho các danh mục con thuộc danh mục này
                    $html .= self::menu($danhmuccons, $danhmuc->id_danhmuc);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }


    public static function isChild($danhmuccons, $parent_id)
    {
        foreach ($danhmuccons as $danhmucCon) {
            if ($danhmucCon->id_danhmuc == $parent_id) {
                return true;
            }
        }
        return false;
    }

    public static function formatVND($number)
    {
        return number_format($number, 0, ',', '.') . ' VND';
    }

    public static function price($gia = 0, $sale = 0)
    {
        $price = $gia - ($gia * $sale / 100);
        if ($price > 0) {
            return '<div class="banner-sale">Sale off: ' . $sale . '%</div>'
                . '<div class="product-banner">'
                . '<div class="tille-price">'
                . '<div class="price-update">Giá gốc: ' . self::formatVND($gia) . '</div>'
                . '<div class="price-sale">Giảm còn: ' . self::formatVND($price) . '</div>'
                . '</div>'
                . '</div>';
        } else {
            return '<div class="price-danger">Đang cập nhật</div>';
        }
    }

    public static function price_sale($gia = 0, $sale = 0)
    {
        $price = $gia - ($gia * $sale / 100);

        if ($price > 0) {
            return '<div class="text-sale">Sale off: ' . $sale . '%</div>'
                . '<div class="text-danger">Giá gốc: ' . self::formatVND($gia) . '</div>'
                . '<div class="text-success">Giảm còn: ' . self::formatVND($price) . '</div>';
        } else {
            return '<div class="price-danger">Đang cập nhật</div>';
        }
    }
    public static function price_cart($gia = 0, $sale = 0)
    {
        $price = $gia - ($gia * $sale / 100);
        return '<div class="cart-item-price">'.self::formatVND($price).'</div>';
    }

    public static function button($gia = 0, $sale = 0)
    {
        $price = $gia - $sale;
        if ($price <= 0) {
            return '<div class="btn btn-danger">Đang cập nhật</div>';
        }
        return '<button type="submit" class="btn btn-primary add-cart mt-5 mb-5">Thêm vào giỏ hàng</button>';
    }

}
