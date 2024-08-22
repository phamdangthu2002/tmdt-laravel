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
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id_slider');
            $table->string('name', 255);
            $table->string('url', 255)->nullable();
            $table->string('hinhanh', 255);
            $table->integer('sort_by');
            $table->tinyInteger('trangthai')->default(1); // 1: Hiển thị, 0: Không hiển thị
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
