<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primarykey = 'kode_transaksi';
    protected $fillable = [
        'kode_transaksi',
        'kode_barang',
        'id_pengguna',
        'jenis_transaksi',
        'qty',
        'harga',
        'tgl_transaksi',
        'keterangan'
    ];

    public function dataMasuk(){
        Transaksi::where('jenis_transaksi', 'MASUK')
        ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
        ->select('transaksi.*', 'barang.nama_barang')->get();
    }

    public function dataTrx(){
        Transaksi::leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
        ->select('transaksi.*', 'barang.nama_barang')->get();
    }

    public function dataPenjualan(){
        Transaksi::leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
        ->select('transaksi.*', 'barang.nama_barang')->get();
    }
}
