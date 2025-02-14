<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'suplier';
    protected $primarykey = 'id_suplier';
    protected $fillable = [
        'id_suplier',
        'nama_suplier',
        'alamat',
        'telp',
        'pembayaran',
        'keterangan'
    ];
}
