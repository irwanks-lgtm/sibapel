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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->string('id_pengguna', length: 50)->unique();
            $table->primary('id_pengguna');
            $table->string('nama_pengguna', length: 50);
            $table->string('password', length: 80);
            $table->string('alamat', length: 80);
            $table->date('tempat_lhr');
            $table->date('tgl_lhr');
            $table->string('nomor_hp', length: 13);
            $table->date('tgl_masuk');
            $table->string('role', length: 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
