<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $barangList = DB::table('barang')->get();
        $kodeUrutHarian = [];

        // 300 transaksi bulan Juli
        for ($i = 0; $i < 300; $i++) {
            $this->buatTransaksi($barangList, 7, 2025, $kodeUrutHarian);
        }

        // 20 transaksi bulan Agustus
        for ($i = 0; $i < 20; $i++) {
            $this->buatTransaksi($barangList, 8, 2025, $kodeUrutHarian);
        }
    }

    private function buatTransaksi($barangList, $bulan, $tahun, &$kodeUrutHarian)
    {
        // Tentukan tanggal random di bulan
        $tanggal = Carbon::create($tahun, $bulan, mt_rand(1, Carbon::create($tahun, $bulan)->daysInMonth));

        // Pilih barang acak
        $barang = $barangList->random();

        // Generate kode urut per hari
        $keyTanggal = $tanggal->format('dmY');
        if (!isset($kodeUrutHarian[$keyTanggal])) {
            $kodeUrutHarian[$keyTanggal] = 1;
        } else {
            $kodeUrutHarian[$keyTanggal]++;
        }
        $urut = str_pad($kodeUrutHarian[$keyTanggal], 4, '0', STR_PAD_LEFT);

        // Buat kode transaksi
        $kodeTransaksi = 'SL' . $tanggal->format('dmY') . $urut;

        // Jumlah pembelian
        $jumlah = mt_rand(1, 8);

        // Cek stok
        if ($barang->jml_brg < $jumlah) {
            return;
        }

        // Hitung harga total
        $hargaTotal = $barang->harga_jual * $jumlah;

        // Insert transaksi
        DB::table('transaksi')->insert([
            'kode_transaksi' => $kodeTransaksi,
            'kode_barang'    => $barang->kode_barang,
            'id_pengguna'    => 'ADM0001',
            'jenis_transaksi'=> 'POS',
            'jml'            => $jumlah,
            'harga'          => $hargaTotal,
            'keterangan'     => '',
            'created_at'     => $tanggal,
            'updated_at'     => $tanggal
        ]);

        // Update stok barang
        DB::table('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->decrement('jml_brg', $jumlah);
    }
}
