<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;

class SuplierController extends Controller
{
    public function show(){
        $suplier = Suplier::orderBy('created_at', 'ASC')->get();
        return view('data_suplier', ['suplier' => $suplier]);
    }
    
    public function tambah(Request $req){
        Suplier::insert([
            'id_suplier' => $req->idsup,
            'nama_suplier' => $req->namasup,
            'alamat' => $req->alamat,
            'no_hp' => $req->nohp,
            'pembayaran' => $req->pembayaran,
            'keterangan' => $req->keterangan,
            'created_at' => now()
        ]);
        return redirect('data-suplier');
    }

    public function indexEdit($id){
        $suplier = Suplier::all()->where('id_suplier', $id);
        return view('edit/edit_suplier', ['suplier' => $suplier]);
    }

    public function edit(Request $req){
        Suplier::where('id_suplier', $req->idsup)->update([
            'nama_suplier' => $req->namasup,
            'alamat' => $req->alamat,
            'no_hp' => $req->nohp,
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
