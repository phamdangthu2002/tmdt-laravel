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
        Schema::create('chitietdonghangs', function (Blueprint $table) {
            $table->bigIncrements('id_ctdh');
            $table->unsignedBigInteger('id_donhang');
            $table->unsignedBigInteger('id_sanpham'); // Khóa ngoại liên kết với bảng sanphams
            $table->unsignedBigInteger('id_size');
            $table->unsignedBigInteger('id_color');
            $table->foreign('id_size')->references('id_size')->on('sizes')->onDelete('cascade');
            $table->foreign('id_color')->references('id_color')->on('colors')->onDelete('cascade');
            $table->unsignedBigInteger('id_trangthai')->default(1); // Đảm bảo rằng giá trị mặc định tồn tại trong bảng trangthais
            $table->integer('soluong');
            $table->decimal('gia', 15, 2);
            // Khóa ngoại nếu cần thiết
            $table->foreign('id_trangthai')->references('id_trangthai')->on('trangthais')->onDelete('cascade');
            $table->foreign('id_donhang')->references('id_donhang')->on('donhangs')->onDelete('cascade');
            $table->foreign('id_sanpham')->references('id_sanpham')->on('sanphams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdonghangs');
    }
};
