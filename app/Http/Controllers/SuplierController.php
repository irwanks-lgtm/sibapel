<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;

class SuplierController extends Controller
{
    public function show(){
        $suplier = Suplier::all();
        return view('data_suplier', ['suplier' => $suplier]);
    }
    public function tambah(Request $req){
        Suplier::insert([
            'id_suplier' => $req->idsup,
            'nama_suplier' => $req->namasup,
            'alamat' => $req->alamat,
            'telp' => $req->telp,
            'pembayaran' => $req->pembayaran,
            'keterangan' => $req->keterangan
        ]);
        return redirect('data-suplier');
    }

    public function hapus($id){
        Suplier::where('id_suplier', $id)->delete();
        return redirect('data-suplier')->with(['success'=>'Data Suplier Sudah Di Hapus']);
    }
}
