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
        Schema::create('suplier', function (Blueprint $table) {
            $table->char('id_suplier', length: 25)->unique();
            $table->primary('id_suplier');
            $table->string('nama_suplier', length: 50);
            $table->string('alamat', length: 80);
            $table->string('no_hp', length: 20);
            $table->string('pembayaran', length: 20);
            $table->string('keterangan', length: 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suplier');
    }
};
