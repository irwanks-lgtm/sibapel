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
        Schema::create('rak', function (Blueprint $table) {
            $table->char('kode_rak', length: 15)->unique();
            $table->primary('kode_rak');
            $table->string('kode_gudang', length: 15);
            $table->foreign('kode_gudang')->references('kode_gudang')->on('gudang');
            $table->string('nama_rak', length: 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rak');
    }
};
