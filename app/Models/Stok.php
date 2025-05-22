<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok_opname';
    protected $primarykey = 'kode_stok';
    protected $fillable = [
        'kode_stok',
        'kode_barang',
        'jml_sistem',
        'jml_aktual',
        'selisih',
        'kode_rak',
        'status',
        'id_pengguna',
    ];

    public function dataStok(){
        Stok::join('barang', 'stok_opname.kode_barang', '=', 'barang.kode_barang')
                        ->join('user', 'stok_opname.id_pengguna', '=', 'user.id_pengguna')
                        ->select('stok_opname.*','barang.nama_barang', 'user.nama_pengguna')->get();
    }
}
