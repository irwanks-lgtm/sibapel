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
            $validatedData = $req->validate([
                'idsup' => "required|max:100",
                'namasup' => "required|max:100",
                'alamat' => "required|max:50",
                'nohp' => "required|numeric",
                'pembayaran' => "required"
            ]);
        try{
            Suplier::insert([
                'id_suplier' => $req->idsup,
                'nama_suplier' => $req->namasup,
                'alamat' => $req->alamat,
                'no_hp' => $req->nohp,
                'pembayaran' => $req->pembayaran,
                'keterangan' => $req->keterangan,
                'created_at' => now()
            ]);
            return redirect('data-suplier')->with(['success' => 'Data Suplier Berhasil Di Tambah']);
        }catch(\Illuminate\Database\QueryException $excep){
            return back()->with(['failed' => 'Data Suplier Sudah Ada']);
        }

    }

    public function indexEdit($id){
        $suplier = Suplier::all()->where('id_suplier', $id);
        return view('edit/edit_suplier', ['suplier' => $suplier]);
    }

    public function editSuplier(Request $req){

        $validatedData = $req->validate([
            'namasup' => "required|max:100",
            'alamat' => "required|max:50",
            'nohp' => "required|numeric",
            'pembayaran' => "required"
        ]);

        Suplier::where('id_suplier', $req->idsup)->update([
            'nama_suplier' => $req->namasup,
            'alamat' => $req->alamat,
            'no_hp' => $req->nohp,
            'pembayaran' => $req->pembayaran,
            'keterangan' => $req->keterangan,
            'updated_at' => now()
        ]);
        return redirect('data-suplier');
    }

    public function hapus($id){
        try{
            Suplier::where('id_suplier', $id)->delete();
            return redirect('data-suplier')->with(['success'=>'Data Suplier Sudah Di Hapus']);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect('data-suplier')->with(['failed'=>'Data Suplier Tidak Dapat Di Hapus, Karena Masih Digunakan']);
        }
    }
}
