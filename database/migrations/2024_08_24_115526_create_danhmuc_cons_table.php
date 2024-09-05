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
        Schema::create('danhmuc_cons', function (Blueprint $table) {
            $table->bigIncrements('id_danhmuccon');
            $table->string('tendanhmuccon', 255);
            $table->text('mota');
            $table->unsignedBigInteger('id_danhmuc');
            $table->tinyInteger('trangthai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhmuc_cons');
    }
};
