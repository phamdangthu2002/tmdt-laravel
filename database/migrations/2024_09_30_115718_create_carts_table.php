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
            $table->unsignedBigInteger('id_size');
            $table->unsignedBigInteger('id_color');
            $table->integer('quantity');
            $table->integer('gia');
            $table->integer('dadathang')->default(1);
            $table->tinyInteger('trangthai')->default(1);

            // Khóa ngoại
            $table->foreign('id_sanpham')->references('id_sanpham')->on('sanphams')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_size')->references('id_size')->on('sizes')->onDelete('cascade');
            $table->foreign('id_color')->references('id_color')->on('colors')->onDelete('cascade');

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
