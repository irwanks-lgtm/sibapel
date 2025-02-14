<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'rak';
    protected $primarykey = 'kode_rak';
    protected $fillable = [
        'kode_rak',
        'kode_gudang',
        'nama_rak'
    ];
}
