<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DanhmucController;
use App\Http\Controllers\Admin\SanphamController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Auth\Users\LoginController;
use App\Http\Controllers\Users\UserController;
use App\Http\Middleware\AuthenticateMiddleware;
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



Route::middleware(['admin'])->group(function () {

    Route::prefix('Admin')->group(function () {
        // trangchu
        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
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
            // Route::get('/show-slider', [SliderController::class, 'show'])->name('admin.show-san-pham');
            // Route::get('{id_slider}/store-edit-slider', [SliderController::class, '__store'])->name('admin.store-edit-slider');
            // Route::post('{id_slider}/edit-slider', [SliderController::class, 'edit'])->name('admin.edit-slider');
            // Route::post('{id_slider}/delete-slider', [SliderController::class, 'destroy'])->name('admin.delete-slider');

        });
        //upload
        Route::post('/upload/services', [UploadController::class, 'store'])->name('admin.upload-services');
    });
});