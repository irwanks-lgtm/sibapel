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
            $table->increments('id_stok');
            $table->char('kode_stok', length: 15)->index();
            $table->char('kode_barang', length: 15);
            $table->foreign('kode_barang')->references('kode_barang')->on('barang');
            $table->integer('jml_sistem');
            $table->integer('jml_aktual');
            $table->integer('selisih');
            $table->string('kode_rak', length: 5);
            $table->string('status', length: 8);
            $table->char('id_pengguna', length: 15);
            $table->foreign('id_pengguna')->references('id_pengguna')->on('user');
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
