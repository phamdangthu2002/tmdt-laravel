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
        Schema::create('trangthais', function (Blueprint $table) {
            $table->bigIncrements('id_trangthai'); // Khóa chính của bảng
            $table->string('tentrangthai');
            $table->string('mota');
            $table->tinyInteger('trangthai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trangthais');
    }
};
