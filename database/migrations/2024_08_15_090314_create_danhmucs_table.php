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
        Schema::create('danhmucs', function (Blueprint $table) {
            $table->bigIncrements('id_danhmuc');
            $table->string('tendanhmuc',255);
            $table->text('mota');
            $table->string('hinhanh', 255);
            $table->tinyInteger('trangthai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhmucs');
    }
};
