<?php
namespace App\Http\Services\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class UserServices
{
    public function add($userRequest)
    {
        try {
            User::create([
                'name' => $userRequest->input('name'),
                'email' => $userRequest->input('email'),
                'password' => bcrypt($userRequest->input('password')),
                'phone' => $userRequest->input('phone'),
                'address' => $userRequest->input('address'),
                'role' => $userRequest->input('role'),
                'avatar' => $userRequest->input('file'),
                'trangthai' => (int) $userRequest->input('trangthai'), // Chuyển đổi thành số nguyên

            ]);
            session()->flash('success', 'Thêm người dùng thành công');
        } catch (Exception $e) {
            session()->flash('error', 'Thêm người dùng thất bại: ' . $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function show()
    {
        $users = User::all();
        return $users;
    }

    public function edit($id)
    {
        return User::find($id);
    }

    public function update($request, $id)
    {
        // Lấy thông tin người dùng hiện tại
        $user = User::findOrFail($id);
        // $name = $request->input('name');
        // Kiểm tra từng trường và chỉ cập nhật khi có thay đổi
        if ($user->name != $request->name) {
            $user->name = $request->name;
        }

        if ($user->email != $request->email) {
            $user->email = $request->email;
        }

        if ($user->phone != $request->phone) {
            $user->phone = $request->phone;
        }

        if ($user->address != $request->address) {
            $user->address = $request->address;
        }

        if ($user->role != $request->role) {
            $user->role = $request->role;
        }
        if ($request->input('file')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $user->avatar = $request->input('file');
        }


        if ($user->trangthai != $request->trangthai) {
            $user->trangthai = $request->trangthai;
        }

        // Chỉ mã hóa và cập nhật mật khẩu nếu mật khẩu mới được nhập
        if ($request->input('password_new')) {
            $user->password = bcrypt($request->input('password_new'));
        }

        // Lưu lại thay đổi
        if ($user->isDirty()) {
            $user->save();
            return redirect()->back()->with('success', 'Người dùng đã được cập nhật.');
        } else {
            return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
        }
    }

    public function delete($id)
    {
        return User::where('id', $id)->first()->delete();
    }
}