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
        Schema::create('data_opname', function (Blueprint $table) {
            $table->increments('id');
            $table->char('kode_stok', length: 15);
            $table->foreign('kode_stok')->references('kode_stok')->on('stok_opname');
            $table->string('kode_barang', length: 25);
            $table->foreign('kode_barang')->references('kode_barang')->on('barang');
            $table->string('jml_sistem', length: 10);
            $table->string('jml_aktual', length: 10);
            $table->string('selisih', length: 10);
            $table->dateTime('waktu_stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_stok');
    }
};
