<?php
namespace App\Http\Services\Anhsp;

use App\Models\anhsp;
use Illuminate\Support\Facades\Log;
class AnhspServices
{
    public function create($request)
    {
        try {
            $urls = []; // Mảng để lưu URL của các file đã lưu

            // Kiểm tra xem có file nào được gửi không
            if ($request->hasFile('alo')) {
                // Lấy ID sản phẩm từ request
                $id_sanpham = (int) $request->input('id_sanpham');

                // Lặp qua tất cả các file được gửi
                foreach ($request->file('alo') as $file) {
                    // Lấy tên gốc của file và phần mở rộng
                    $originalName = $file->getClientOriginalName();
                    $name = pathinfo($originalName, PATHINFO_FILENAME); // Lấy tên file không có phần mở rộng
                    $extension = $file->getClientOriginalExtension(); // Lấy phần mở rộng của file

                    // Tạo tên file mới và đường dẫn để lưu file
                    $newName = $name . '.' . $extension;
                    $pathFull = 'uploads/' . date('Y/m/d');

                    // Lưu file vào thư mục public/storage với tên mới
                    $file->storeAs(
                        'public/' . $pathFull,
                        $newName
                    );

                    // Thêm URL của file vào mảng
                    $url = '/storage/' . $pathFull . '/' . $newName;
                    $urls[] = $url;

                    // Lưu thông tin vào cơ sở dữ liệu
                    anhsp::create([
                        'id_sanpham' => $id_sanpham,
                        'hinhanh' => $url, // URL của ảnh vừa lưu
                    ]);
                }
            }

            // Trả về mảng chứa URL của các file đã lưu
            return response()->json(['error' => false, 'urls' => $urls]);

        } catch (\Exception $e) {
            // Trả về thông báo lỗi nếu có
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
}