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
            $table->char('id_suplier', length: 15);
            $table->foreign('id_suplier')->references('id_suplier')->on('suplier')->onUpdate('cascade')->onDelete('restrict');
            $table->string('barcode', length: 20)->nullable();
            $table->string('nama_barang', length: 60);
            $table->string('satuan', length: 5);
            $table->integer('jml_brg')->unsigned()->default(0);
            $table->decimal('harga_beli', 12, 2)->unsigned(); // max 9999999999.99
            $table->decimal('harga_jual', 12, 2)->unsigned();
            $table->text('deskripsi')->nullable();
            $table->string('jenis_barang', length: 20);
            $table->string('kode_rak', length: 5);
            $table->integer('jml_min')->unsigned()->default(0);
            $table->tinyInteger('waktu_tg')->unsigned();
            $table->unique(['id_suplier', 'nama_barang']);
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
