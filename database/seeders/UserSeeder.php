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
        $date = date_create('2000-01-01');
        date_format($date, 'Y-m-d');
        DB::table('users')->insert([
            'id' => 1234,
            'email' => 'irwan@gmail.com',
            'nama_pengguna' => 'irwan kurniadi',
            'password' => Hash::make('secret'),
            'alamat' => 'jagalan',
            'tempat_lhr' => 'semarang',
            'tgl_lhr' => date_format($date, 'Y-m-d'),
            'nomor_hp' => '089503488468',
            'tgl_masuk' => date_format($date, 'Y-m-d'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
