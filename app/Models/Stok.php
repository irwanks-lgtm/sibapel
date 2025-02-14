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
        'id_pengguna',
        'kode_rak',
        'tgl_stok',
        'status'
    ];
}
