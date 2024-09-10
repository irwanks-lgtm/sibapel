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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang', length: 25)->unique();
            $table->primary('kode_barang');
            $table->string('id_suplier', length: 25);
            $table->foreign('id_suplier')->references('id_suplier')->on('suplier');
            $table->string('barcode', length: 30);
            $table->string('nama_barang', length: 80);
            $table->string('satuan', length: 20);
            $table->string('harga_beli', length: 15);
            $table->string('harga_jual', length: 15);
            $table->string('jenis_barang', length: 20);
            $table->string('kode_rak', length: 15);
            $table->foreign('kode_rak')->references('kode_rak')->on('rak');
            $table->date('tgl_masuk');
            $table->string('qty_min', length: 10);
            $table->string('foto', length: 30);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
