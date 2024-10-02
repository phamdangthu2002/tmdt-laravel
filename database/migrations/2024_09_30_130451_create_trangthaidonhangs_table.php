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
        Schema::create('trangthaidonhangs', function (Blueprint $table) {
            $table->bigIncrements('id_trangdonhang'); // Khóa chính của bảng
            $table->unsignedBigInteger('id_donhang'); // Khóa ngoại đến bảng donhangs
            $table->unsignedBigInteger('id_trangthai'); // Khóa ngoại đến bảng trangthais
            $table->timestamp('ngaycapnhat')->useCurrent(); // Ngày cập nhật tiến trình

            // Khóa ngoại
            $table->foreign('id_donhang')->references('id_donhang')->on('donhangs')->onDelete('cascade');
            $table->foreign('id_trangthai')->references('id_trangthai')->on('trangthais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trangthaidonghangs');
    }
};
