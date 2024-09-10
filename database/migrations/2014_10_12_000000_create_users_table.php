<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', length: 50)->unique();
            $table->primary('id');
            $table->string('email', length: 50);
            $table->string('nama_pengguna', length: 50);
            $table->string('password', length: 80);
            $table->string('alamat', length: 80);
            $table->string('tempat_lhr', length: 30);
            $table->date('tgl_lhr');
            $table->string('nomor_hp', length: 13);
            $table->date('tgl_masuk');
            $table->string('role', length: 20);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
