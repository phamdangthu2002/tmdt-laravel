<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donhangs', function (Blueprint $table) {
            $table->bigIncrements('id_donhang'); // Khóa chính của bảng
            $table->unsignedBigInteger('id_user'); // Khóa ngoại liên kết với bảng users
            $table->unsignedBigInteger('id_trangthai')->default(1); // Đảm bảo rằng giá trị mặc định tồn tại trong bảng trangthais
            $table->foreign('id_trangthai')->references('id_trangthai')->on('trangthais')->onDelete('cascade');

            $table->integer('tong');
            $table->tinyInteger('trangthai')->default(1);


            // Liên kết khóa ngoại với bảng users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); // Khi xóa user, sẽ tự động xóa đơn hàng liên quan


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donhangs');
    }
};
