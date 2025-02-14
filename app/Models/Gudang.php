<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;
    protected $table = 'gudang';
    protected $primarykey = 'kode_gudang';
    protected $fillable = [
        'kode_gudang',
        'nama_gudang'
    ];
}
