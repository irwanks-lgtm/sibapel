<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOpname extends Model
{
    use HasFactory;

    protected $table = 'data_opname';
    protected $fillable = [
        'kode_stok',
        'id_pengguna',
        'kode_rak',
        'tgl_stok',
        'status'
    ];
}
