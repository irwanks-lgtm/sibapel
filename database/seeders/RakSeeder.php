<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rak')->insert([
            'kode_rak' => 'RTK01',
            'kode_gudang' => 'GTK01',
            'nama_rak' => 'Rak Toko 1'
        ]);
    }
}
