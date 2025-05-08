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
            $table->char('kode_barang', length: 15)->unique();
            $table->primary('kode_barang');
            $table->string('id_suplier', length: 15);
            $table->foreign('id_suplier')->references('id_suplier')->on('suplier');
            $table->string('barcode', length: 20)->nullable();
            $table->string('nama_barang', length: 30);
            $table->string('satuan', length: 5);
            $table->integer('jml_brg');
            $table->string('harga_beli', length: 10);
            $table->string('harga_jual', length: 10);
            $table->string('jenis_barang', length: 20);
            $table->string('kode_rak', length: 5);
            $table->dateTime('tgl_masuk');
            $table->integer('jml_min');
            $table->string('waktu_tg', length: 3);
            $table->timestamps();

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
