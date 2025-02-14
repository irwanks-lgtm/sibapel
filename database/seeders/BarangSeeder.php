<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            'kode_barang' => 'BM8023',
            'id_suplier' => 'MSP202401',
            'barcode' => 12491725907,
            'nama_barang' => 'Mesin Cuci Maspion',
            'jml_brg' => 10,
            'satuan' => 'pcs',
            'harga_beli' => '800000',
            'harga_jual' => '1300000',
            'jenis_barang' => 'elektronik',
            'kode_rak' => 'RTK01',
            'tgl_masuk' => now(),
            'qty_min' => 5
        ]);

        DB::table('barang')->insert([
            'kode_barang' => 'BM8024',
            'id_suplier' => 'MYK202401',
            'barcode' => 121513267438,
            'nama_barang' => 'Rice Cooker Miyako',
            'jml_brg' => 20,
            'satuan' => 'pcs',
            'harga_beli' => '50000',
            'harga_jual' => '120000',
            'jenis_barang' => 'elektronik',
            'kode_rak' => 'RTK01',
            'tgl_masuk' => now(),
            'qty_min' => 5
        ]);
    }
}
