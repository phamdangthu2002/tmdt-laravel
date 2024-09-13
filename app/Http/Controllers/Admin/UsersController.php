<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\User\UserServices;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function create()
    {
        return view('Admin.user.add', [
            'title' => 'Thêm người dùng',
        ]);
    }

    public function store(UserRequest $userRequest)
    {
        $this->userServices->add($userRequest);
        return redirect()->back();
    }

    public function show()
    {
        $users = $this->userServices->show();
        return view('Admin.user.show', [
            'title' => 'Danh sách người dùng',
            'users' => $users,
        ]);
    }

    public function __store($id)
    {
        $users = $this->userServices->show();
        $useredits = $this->userServices->edit($id);
        return view('Admin.user.store', [
            'title' => 'Cập nhật người dùng',
            'users' => $users,
            'useredits' => $useredits,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $this->userServices->update($request, $id);
        return redirect()->back();
    }

    public function destroy($id){
        $this->userServices->delete($id);
        return redirect()->route('admin.show.user')->with('success', 'Người dùng đã được xóa thành công.');
    }

}
