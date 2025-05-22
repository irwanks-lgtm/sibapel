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
            $table->char('kode_transaksi', length: 15);
            $table->primary('kode_transaksi');
            $table->char('kode_barang', length: 15);
            $table->foreign('kode_barang')->references('kode_barang')->on('barang');
            $table->char('id_pengguna', length: 15);
            $table->foreign('id_pengguna')->references('id_pengguna')->on('user');
            $table->string('jenis_transaksi', length: 8);
            $table->integer('jml');
            $table->string('harga', length: 10);
            $table->string('keterangan', length: 20)->nullable();
            $table->timestamps();

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
