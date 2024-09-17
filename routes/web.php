<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnhController;
use App\Http\Controllers\Admin\DanhmucController;
use App\Http\Controllers\Admin\DonhangController;
use App\Http\Controllers\Admin\SanphamController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TrangthaiController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\Users\LoginController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('index');

Route::get('/Auth/users/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/Auth/users/login/store', [LoginController::class, 'store'])->name('auth.store');
Route::get('/Auth/users/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/Auth/users/register/store-register', [LoginController::class, 'add'])->name('auth.store-register');
Route::get('/Auth/users/logout', [LoginController::class, 'logout'])->name('auth.logout');


//admin
Route::middleware(['admin'])->group(function () {
    Route::prefix('Admin')->group(function () {
        // trangchu
        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
        //user
        Route::prefix('User')->group(function () {
            Route::get('/add', [UsersController::class, 'create'])->name('admin.create.user');
            Route::post('/add-new-user', [UsersController::class, 'store'])->name('admin.add.user');
            Route::get('/add-show-user', [UsersController::class, 'show'])->name('admin.show.user');
            Route::get('{id}/add-store-edit-user', [UsersController::class, '__store'])->name('admin.store.user');
            Route::post('{id}/add-edit-user', [UsersController::class, 'edit'])->name('admin.edit.user');
            Route::post('{id}/add-delete-user', [UsersController::class, 'destroy'])->name('admin.delete.user');
        });
        // danhmuc
        Route::prefix('Danhmuc')->group(function () {
            Route::get('/add', [DanhmucController::class, 'create'])->name('admin.create-danh-muc');
            Route::post('/add-new-danh-muc', [DanhmucController::class, 'store'])->name('admin.store-danh-muc');
            Route::get('/show-danh-muc', [DanhmucController::class, 'show'])->name('admin.show-danh-muc');
            Route::get('{id_danhmuc}/store-edit-danh-muc', [DanhmucController::class, '__store'])->name('admin.store-edit-danh-muc');
            Route::post('{id_danhmuc}/edit-danh-muc', [DanhmucController::class, 'edit'])->name('admin.edit-danh-muc');
            Route::post('{id_danhmuc}/delete-danh-muc', [DanhmucController::class, 'destroy'])->name('admin.delete-danh-muc');
        });
        //sanpham
        Route::prefix('Sanpham')->group(function () {
            Route::get('/add', [SanphamController::class, 'create'])->name('admin.create-san-pham');
            Route::post('/add-new-san-pham', [SanphamController::class, 'store'])->name('admin.store-san-pham');
            Route::get('/show-san-pham', [SanphamController::class, 'show'])->name('admin.show-san-pham');
            Route::get('{id_sanpham}/store-edit-san-pham', [SanphamController::class, '__store'])->name('admin.store-edit-san-pham');
            Route::post('{id_sanpham}/edit-san-pham', [SanphamController::class, 'edit'])->name('admin.edit-san-pham');
            Route::post('{id_sanpham}/delete-san-pham', [SanphamController::class, 'destroy'])->name('admin.delete-san-pham');

        });
        //slider
        Route::prefix('Slider')->group(function () {
            Route::get('/add', [SliderController::class, 'create'])->name('admin.create-slider');
            Route::post('/add-new-slider', [SliderController::class, 'store'])->name('admin.store-slider');
            Route::get('/show-slider', [SliderController::class, 'show'])->name('admin.show-slider');
            Route::get('{id_slider}/store-edit-slider', [SliderController::class, '__store'])->name('admin.store-edit-slider');
            Route::post('{id_slider}/edit-slider', [SliderController::class, 'edit'])->name('admin.edit-slider');
            Route::post('{id_slider}/delete-slider', [SliderController::class, 'destroy'])->name('admin.delete-slider');

        });
        //anhsp
        Route::prefix('Anhsp')->group(function () {
            Route::get('{id}/add', [AnhController::class, 'add'])->name('admin.add-anh');
            Route::post('{id}/add-new-anh', [AnhController::class, 'store'])->name('admin.store-anh');
            Route::post('{id}/destroy-anh', [AnhController::class, 'destroy'])->name('admin.destroy-anh');
        });

        //donhang
        Route::prefix('Donhang')->group(function () {
            Route::get('/show-don-hang', [DonhangController::class, 'show'])->name('admin.show-donhang');
            Route::get('{id}/show-don-hang-detail', [DonhangController::class, 'edit'])->name('admin.editdonhang');
        });
        // trangthai
        Route::prefix('Trangthai')->group(function () {
            Route::get('/add-trang-thai', [TrangthaiController::class, 'create'])->name('admin.trangthai');
            Route::post('/add-new-trang-thai', [TrangthaiController::class, 'store'])->name('admin.store-trangthai');
            Route::get('/show-trang-thai', [TrangthaiController::class, 'show'])->name('admin.show.trangthai');
            Route::get('{id}/store/edit-trang-thai', [TrangthaiController::class, '__store'])->name('admin.edit.trangthai');
            Route::post('{id}/edit-trang-thai', [TrangthaiController::class, 'edit'])->name('admin.store.edit.trangthai');
            Route::post('{id}/delete-trang-thai', [TrangthaiController::class, 'destroy'])->name('admin.delete-trangthai');
        });
        //trangthaidonhang
        Route::prefix('Trangthaidonhang')->group(function () {
            Route::get('/show', [TrangthaiController::class, 'show_trangthai'])->name('admin.showtrangthai');
            Route::post('/add-trang-thai-don-hang', [TrangthaiController::class, 'updateStatus'])->name('admin.updateStatus');
        });
        //upload
        Route::post('/upload/services', [UploadController::class, 'store'])->name('admin.upload-services');
        Route::post('/uploadAnh/services', [UploadController::class, 'storeAnh'])->name('admin.uploadAnh-services');
    });
});

//user
Route::prefix('User')->group(function () {
    // trangchu
    Route::get('/trang-chu', [UserController::class, 'index'])->name('user.index');
    Route::post('/load-more', [UserController::class, 'load'])->name('user.load');

    //danhmuc
    Route::get('{id}/load-danhmuc', [UserController::class, 'danhmuc'])->name('user.danhmuc');
    Route::get('{id}/chi-tiet', [UserController::class, 'chitiet'])->name('user.chitiet');

    //giohang
    Route::post('/gio-hang', [UserController::class, 'giohang'])->name('user.giohang');
    Route::get('/gio-hang-show', [UserController::class, 'giohangshow'])->name('user.giohangshow');
    Route::post('/update-cart', [UserController::class, 'update'])->name('user.update-cart');
    Route::get('{id}/delete-cart', [UserController::class, 'destroy'])->name('user.delete-cart');

    //donhang
    Route::post('{id}/don-hang', [UserController::class, 'donhang'])->name('user.add-donghang');
    Route::get('{id}/show-don-hang', [UserController::class, 'showdonhang'])->name('user.show-donhang');
    //timkiem
    Route::get('/search', [UserController::class, 'search'])->name('search');
    //thanhtoan
    Route::get('/thanh-toan', [UserController::class, 'buy'])->name('user.thanh-toan');
    //edit profile
    Route::get('{id}/edit-profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('{id}/update-profile', [UserController::class, 'update_profile'])->name('user.update-profile');
    //lienhe
    Route::get('/lien-he', [UserController::class, 'lienhe'])->name('user.lienhe');
    //thongtin
    Route::get('/thong-tin', [UserController::class, 'thongtin'])->name('user.thongtin');

});