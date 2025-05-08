<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primarykey = 'kode_barang';
    protected $fillable = [
        'kode_barang',
        'id_suplier',
        'barcode',
        'nama_barang',
        'satuan',
        'jml_brg',
        'harga_beli',
        'harga_jual',
        'jenis_barang',
        'kode_rak',
        'tgl_masuk',
        'qty_min',
        'waktu_tg'
    ];

    public function dataBarang(){
        Barang::leftJoin('suplier', 'barang.id_suplier', '=', 'suplier.id_suplier')
            ->select('barang.*', 'suplier.nama_suplier')->get();
    }
}
