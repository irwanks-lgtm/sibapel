<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Models\Rak;

class GudangController extends Controller
{
    public function index(){
        $gudang = Gudang::all();
        $rak = Rak::all();
        return view('gudang/data_gudang', ['gudang' => $gudang, 'rak' => $rak]);
    }

    public function tambahRak(){
        $gudang = Gudang::all();
        return view('gudang/tambah_rak', ['gudang' => $gudang]);
    }

    public function simpanGudang(Request $req){
        Gudang::insert([
            'kode_gudang' => $req->kdgd,
            'nama_gudang' => $req->nmgd
        ]);
        return redirect('data-gudang');
    }

    public function simpanRak(Request $req){
        Rak::insert([
            'kode_rak' => $req->kdrk,
            'kode_gudang' => $req->kdgd,
            'nama_rak' => $req->nmrk
        ]);
        return redirect('data-gudang');
    }

    public function getDetailGudang($nmgd = 0)
    {
    $data = Gudang::where('nama_gudang',$nmgd)->first();
    
    return response()->json($data);
    }

    public function hapusGudang($kdgd){
        Gudang::where('kode_gudang', $kdgd)->delete();
        return redirect('data-gudang')->with(['success'=>'Data Gudang Sudah Di Hapus']);
    }

    public function hapusRak($kdrk){
        Rak::where('kode_rak', $kdrk)->delete();
        return redirect('data-gudang')->with(['success'=>'Data Rak Sudah Di Hapus']);
    }
}
