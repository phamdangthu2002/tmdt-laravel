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
            $table->bigIncrements('id_donhang');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_trangthai');
            // Liên kết khóa ngoại với bảng users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); // Khi xóa user, sẽ tự động xóa giỏ hàng liên quan
            // Liên kết khóa ngoại với bảng trangthais
            $table->foreign('id_trangthai')->references('id_trangthai')->on('trangthais')->onDelete('cascade');
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
