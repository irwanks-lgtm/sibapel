<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = date_create('2000-01-01');
        DB::table('suplier')->insert([
            'id_suplier' => 'MSP202401',
            'nama_suplier' => 'Maspion Jogja',
            'alamat' => 'Yogyakarta',
            'telp' => '08231546834',
            'kategori' => 'Elektronik',
            'pembayaran' => 'Transfer',
            'keterangan' => 'BCA - 104521957'
        ]);

        DB::table('suplier')->insert([
            'id_suplier' => 'MYK202401',
            'nama_suplier' => 'Miyako Jogja',
            'alamat' => 'Yogyakarta',
            'telp' => '08231546834',
            'kategori' => 'Elektronik',
            'pembayaran' => 'Tunai',
            'keterangan' => ''
        ]);
    }
}
