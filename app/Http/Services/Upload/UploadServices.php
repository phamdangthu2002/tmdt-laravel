<?php
namespace App\Http\Services\Upload;

use Exception;
use Illuminate\Support\Facades\Log;

class UploadServices
{
    public function store($request)
    {
        try {
            if ($request->hasFile('file')) {
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date('Y/m/d');
                $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                return '/storage/' . $pathFull . '/' . $name;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function storeAnh($request)
    {
        try {
            $urls = []; // Mảng để lưu URL của các file đã lưu

            // Kiểm tra xem có file nào được gửi không
            if ($request->hasFile('files')) {
                // Lặp qua tất cả các file được gửi
                foreach ($request->file('files') as $file) {
                    // Kiểm tra xem file có hợp lệ không
                    if ($file->isValid()) {
                        // Lấy tên gốc của file
                        $name = $file->getClientOriginalName();
                        // Tạo đường dẫn để lưu file
                        $pathFull = 'uploads/' . date('Y/m/d');
                        // Lưu file vào thư mục public/storage
                        $file->storeAs(
                            'public/' . $pathFull,
                            $name
                        );
                        // Thêm URL của file vào mảng
                        $urls[] = '/storage/' . $pathFull . '/' . $name;
                    } else {
                        Log::error('File không hợp lệ: ' . $file->getClientOriginalName());
                    }
                }
            }

            // Trả về mảng chứa URL của các file đã lưu
            return response()->json(['error' => false, 'urls' => $urls]);

        } catch (Exception $e) {
            // Trả về thông báo lỗi nếu có
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }


}