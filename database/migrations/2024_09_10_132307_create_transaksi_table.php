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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kode_transaksi', length: 30);
            $table->primary('kode_transaksi');
            $table->string('kode_barang', length: 25);
            $table->foreign('kode_barang')->references('kode_barang')->on('barang');
            $table->string('id_pengguna', length: 50);
            $table->foreign('id_pengguna')->references('id')->on('user');
            $table->string('jenis_transaksi', length: 30);
            $table->string('qty', length: 10);
            $table->string('harga', length: 20);
            $table->date('tgl_transaksi');
            $table->string('keterangan', length: 80);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
