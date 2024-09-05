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
        Schema::create('sanphams', function (Blueprint $table) {
            $table->bigIncrements('id_sanpham');
            $table->string('tensanpham', 255);
            $table->text('mota');
            $table->unsignedBigInteger('id_danhmuc');
            $table->foreign('id_danhmuc')->references('id_danhmuc')->on('danhmucs')->onDelete('cascade');
            $table->decimal('gia');
            $table->integer('sale')->nullable();
            $table->integer('luotxem')->nullable();
            $table->integer('luotmua')->nullable();
            $table->integer('soluong');
            $table->string('hinhanh', 255)->nullable();
            $table->tinyInteger('trangthai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanphams');
    }
};
