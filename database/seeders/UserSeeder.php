<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'id_pengguna' => 'ADM0001',
            'email' => 'admin@sibapel.com',
            'nama_pengguna' => 'admin',
            'password' => Hash::make('adminsibapel'),
            'alamat' => 'jagalan',
            'tempat_lhr' => 'semarang',
            'tgl_lhr' => now(),
            'nomor_hp' => '089503488468',
            'role' => 'admin',
            'created_at' => now(),
        ]);
    }
}
