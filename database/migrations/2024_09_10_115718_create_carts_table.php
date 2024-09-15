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
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id_giohang');
            $table->unsignedBigInteger('id_sanpham');
            $table->unsignedBigInteger('id_user');
            $table->string('size');
            $table->string('color');
            $table->integer('quantity');
            $table->integer('gia');
            $table->integer('dadathang')->default(1);
            $table->tinyInteger('trangthai')->default(1);
            // Khóa ngoại liên kết với bảng 'sanphams'
            $table->foreign('id_sanpham')
                ->references('id_sanpham')
                ->on('sanphams')
                ->onDelete('cascade'); // Khi xóa sản phẩm, sẽ tự động xóa giỏ hàng liên quan

            // Khóa ngoại liên kết với bảng 'users'
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Khi xóa user, sẽ tự động xóa giỏ hàng liên quan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
