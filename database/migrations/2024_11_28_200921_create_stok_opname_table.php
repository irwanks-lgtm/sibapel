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
        Schema::create('stok_opname', function (Blueprint $table) {
            $table->char('kode_stok', length: 15)->unique();
            $table->primary('kode_stok');
            $table->string('id_pengguna', length: 50);
            $table->foreign('id_pengguna')->references('id_pengguna')->on('user');
            $table->string('kode_rak', length: 15);
            $table->foreign('kode_rak')->references('kode_rak')->on('rak');
            $table->dateTime('tgl_stok');
            $table->string('status', length: 20);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_opname');
    }
};
