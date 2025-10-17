<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $barang = [
            // --- Data asli ---
            ['kode_barang' => 'MSPCEF2025', 'id_suplier' => 'MSP202519', 'barcode' => '1285621783512', 'nama_barang' => 'Exhaust fan Maspion Ventilating Fan 10 Inch', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 325000, 'harga_jual' => 450000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'T.2.1', 'jml_min' => 0],
            ['kode_barang' => 'MSPEX1010BB', 'id_suplier' => 'MSP202519', 'barcode' => '12856219882136', 'nama_barang' => 'Setrika Listrik Maspion Anti Lengket', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 95000, 'harga_jual' => 125000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'T.2.1', 'jml_min' => 1],
            ['kode_barang' => 'MSPF170SL', 'id_suplier' => 'MSP202519', 'barcode' => '12845612984', 'nama_barang' => 'Kipas Angin Maspion Stand Fan', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 240000, 'harga_jual' => 315000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'T.1.1', 'jml_min' => 17],
            ['kode_barang' => 'MSPMEK1803KL', 'id_suplier' => 'MSP202519', 'barcode' => '21547612731', 'nama_barang' => 'Maspion Teko Elektrik Stainless Steel 1,8 L', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 200000, 'harga_jual' => 245000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'T.1.2', 'jml_min' => 0],
            ['kode_barang' => 'MYKCH208MA', 'id_suplier' => 'MYK202519', 'barcode' => '2151862938612', 'nama_barang' => 'Blender Miyako Chopper 2L', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 500000, 'harga_jual' => 552000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'T.1.2', 'jml_min' => 0],
            ['kode_barang' => 'MYKMCM508SBC', 'id_suplier' => 'MYK202519', 'barcode' => '821659812631', 'nama_barang' => 'Rice Cooker Miyako 1.8 L', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 125000, 'harga_jual' => 165000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'R.4.1', 'jml_min' => 0],
            ['kode_barang' => 'MYKWDP300', 'id_suplier' => 'MYK202519', 'barcode' => '2189561293183', 'nama_barang' => 'Dispenser Miyako Galon Bawah', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 475000, 'harga_jual' => 530000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'R.4.1', 'jml_min' => 0],
            ['kode_barang' => 'PRTBKE310009', 'id_suplier' => 'PRT202519', 'barcode' => '128654912836', 'nama_barang' => 'Toples Small 400ml', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 12000, 'harga_jual' => 24000, 'jenis_barang' => 'Perlengkapan Dapur', 'kode_rak' => 'T.3.1', 'jml_min' => 52],
            ['kode_barang' => 'PRTHL22039', 'id_suplier' => 'PRT202519', 'barcode' => '128562198312', 'nama_barang' => 'Bunga Pot Keramik', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 30000, 'harga_jual' => 47000, 'jenis_barang' => 'Pot Bunga', 'kode_rak' => 'T.1.1', 'jml_min' => 1],
            ['kode_barang' => 'PRTSWAF24P', 'id_suplier' => 'PRT202519', 'barcode' => '127541872351', 'nama_barang' => 'Samono 2.4 L mini air fryer', 'satuan' => 'pcs', 'jml_brg' => 50, 'harga_beli' => 525000, 'harga_jual' => 600000, 'jenis_barang' => 'Elektronik', 'kode_rak' => 'T.2.2', 'jml_min' => 74],
        ];

        // --- Tambahan 10 data otomatis ---
        $tambahan = [
            ['MSP202519', 'MSPBL300', 'Blender Maspion 3 Kecepatan', 'Elektronik', 'T.1.3', 0, 275000, 330000],
            ['MSP202519', 'MSPWF12', 'Wall Fan Maspion 12 Inch', 'Elektronik', 'T.2.3', 5, 210000, 265000],
            ['MYK202519', 'MYKTCM100', 'Toaster Miyako 4 Slice', 'Elektronik', 'R.3.1', 0, 320000, 390000],
            ['MYK202519', 'MYKHG300', 'Hair Dryer Miyako Compact', 'Elektronik', 'R.2.4', 0, 85000, 120000],
            ['PRT202519', 'PRTGLS250', 'Gelas Set Isi 6 Pcs', 'Tableware', 'T.3.2', 10, 45000, 80000],
            ['PRT202519', 'PRTPAN28', 'Panci Stainless 28cm', 'Perlengkapan Dapur', 'T.3.4', 3, 95000, 135000],
            ['PRT202519', 'PRTFUR01', 'Rak Buku Kayu Minimalis', 'Furniture', 'R.1.1', 0, 550000, 750000],
            ['PRT202519', 'PRTFUR02', 'Meja Lipat Serbaguna', 'Furniture', 'R.1.2', 0, 325000, 470000],
            ['PRT202519', 'PRTPB001', 'Pot Bunga Plastik Besar', 'Pot Bunga', 'T.4.1', 0, 18000, 35000],
            ['PRT202519', 'PRTPB002', 'Pot Bunga Rotan Sintetis', 'Pot Bunga', 'T.4.2', 0, 27000, 48000],
        ];

        foreach ($tambahan as $t) {
            $barang[] = [
                'kode_barang' => $t[1],
                'id_suplier' => $t[0],
                'barcode' => strval(rand(100000000000, 999999999999)),
                'nama_barang' => $t[2],
                'satuan' => 'pcs',
                'jml_brg' => 50,
                'harga_beli' => $t[6],
                'harga_jual' => $t[7],
                'jenis_barang' => $t[3],
                'kode_rak' => $t[4],
                'jml_min' => $t[5],
            ];
        }

        // Tambahkan waktu_tg & created_at
        foreach ($barang as &$b) {
            $b['waktu_tg'] = rand(1, 7);
            $b['created_at'] = Carbon::create(2025, 6, rand(1, 30), rand(0, 23), rand(0, 59), rand(0, 59));
            $b['updated_at'] = now();
        }

        DB::table('barang')->insert($barang);
    }
}

