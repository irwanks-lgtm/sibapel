<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gudang')->insert([
            'kode_gudang' => 'GTK01',
            'nama_gudang' => 'Gudang Toko'
        ]);
    }
}
