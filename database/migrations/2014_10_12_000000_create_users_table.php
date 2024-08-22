<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên người dùng
            $table->string('email')->unique(); // Email, duy nhất
            $table->string('password'); // Mật khẩu
            $table->string('phone')->nullable(); // Số điện thoại, có thể null
            $table->string('address')->nullable(); // Địa chỉ, có thể null
            $table->string('avatar')->nullable(); // Đường dẫn ảnh đại diện, có thể null
            $table->string('role')->default('2'); // Vai trò mặc định là '2'
            $table->integer('trangthai')->default(1); // Trạng thái mặc định là 1
            $table->timestamp('email_verified_at')->nullable(); // Thời gian xác nhận email, có thể null
            $table->rememberToken(); // Token nhớ đăng nhập
            $table->timestamps(); // Thêm các cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
