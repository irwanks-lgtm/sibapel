<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
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
        'foto'
    ];
}
