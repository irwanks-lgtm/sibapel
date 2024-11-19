<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Rak;

class BarangController extends Controller
{
    public function show(){
        $barang = Barang::all();
        return view('barang_masuk', ['barang' => $barang]);
    }

    public function tambahbarang(){
        $suplier = Suplier::all();
        $rak = Rak::all();
        return view('tambah_barang_masuk', ['suplier' => $suplier, 'rak' => $rak]);
    }


    public function tambah(Request $req){
        $hbeli = $req->harga_beli;
        $inthbeli = str_replace('Rp. ','', $hbeli);
        $beli = str_replace('.','', $inthbeli);

        $hjual = $req->harga_jual;
        $inthjual = str_replace('Rp. ','', $hjual);
        $jual = str_replace('.','', $inthjual);

        Barang::insert([
            'kode_barang' => $req->kdbrg,
            'id_suplier' => $req->suplier,
            'barcode' => $req->barcode,
            'nama_barang' => $req->nmbrg,
            'jml_brg' => $req->jml,
            'satuan' => $req->satuan,
            'harga_beli' => $beli,
            'harga_jual' => $jual,
            'jenis_barang' => $req->jenis,
            'kode_rak' => $req->rak,
            'tgl_masuk' => now(),
            'qty_min' => 5,
            'foto' => $req->ftbrg
        ]);
        return redirect('/barang-masuk');
    }

    public function hapus($id){
        Barang::where('kode_barang', $id)->delete();
        return redirect('barang-masuk')->with(['success'=>'Data Barang Sudah Di Hapus']);
    }
    
}
