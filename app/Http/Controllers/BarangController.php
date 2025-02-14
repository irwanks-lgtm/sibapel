<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Rak;
use App\Models\User;
use App\Models\Stok;
use App\Models\DataOpname;

class BarangController extends Controller
{
    public function show(){
        $barang = Barang::all();
        return view('data_barang', ['barang' => $barang]);
    }

    public function tambahbarang(){
        $suplier = Suplier::all();
        $rak = Rak::all();
        return view('tambah_data_barang', ['suplier' => $suplier, 'rak' => $rak]);
    }

    public function lihatOpname(){
        $rak = Rak::all();
        $user = User::all();
        $stok = Stok::all();
        return view('stok_opname', ['user' => $user, 'rak' => $rak, 'stok' => $stok]);
    }

    public function detailOpname($kdstok){
        $data = DataOpname::where('kode_stok', $kdstok)
                    ->leftJoin('barang', 'data_opname.kode_barang', '=', 'barang.kode_barang')
                    ->select('data_opname.*', 'barang.nama_barang')->get();
        return view('detail_opname', ['data' => $data]);
    }

    public function dataOpname(Request $req){
        //membuat tanggal untuk tanggal transaksi dan untuk kode transaksi
        $datenow = date_format(date_create(now()), "dmY");

       //cek data kode transaksi terakhir
        $kode = Stok::select('kode_stok')->where('kode_stok', 'like', '%SO'.'%'.$datenow.'%')->get()->last();

        //set kode transaksi 
        if(empty($kode)){
            $kodebaru = 'SO'. $datenow . '0001';
        }else{
            $kodebaru = json_decode($kode)->kode_stok;
            $kd = Str::of($kodebaru)->afterLast($datenow);
            $intKode = (int) $kd->value + 1;
            //mengubah integer Kode Transaksi menjadi string
                if(strlen($intKode)==1){
                     $kodebaru = 'SO'. $datenow . "000" . (string)$intKode;
                }else if(strlen($intKode)==2){
                    $kodebaru = 'SO'. $datenow . "00" . (string)$intKode;
                }else if(strlen($intKode)==3){
                    $kodebaru = 'SO'. $datenow . "0" . (string)$intKode;
                }else{
                    $kodebaru = 'SO'. $datenow . (string)$intKode;
                }
        }
        Stok::insert([
            'kode_stok' => $kodebaru,
            'id_pengguna' => $req->pic,
            'kode_rak' => $req->rak,
            'tgl_stok' => now(),
            'status' => 'PROSES'
        ]);
        $barang = Barang::where('kode_rak', $req->rak)->get();
        return view('data_opname', ['brg' => $barang, 'idStok' => $kodebaru]);
    }

    public function simpanOpname(Request $req){
        $index = 0;
        foreach($req->kdbrg as $num){
            DataOpname::insert([
                'kode_stok' => $req->kdstok,
                'kode_barang' => $req->kdbrg[$index],
                'jml_sistem' => $req->jml[$index],
                'jml_aktual' => $req->aktual[$index],
                'selisih' => $req->selisih[$index],
                'waktu_stok' => date_format(date_create($req->waktu[$index]), 'Y-m-d H:i:s'),
                'created_at' => now()
            ]);
            $index++;
        }
        Stok::where('kode_stok', '=' , $req->kdstok)->update([
            'status' => 'SELESAI'
        ]);
        return redirect('stok-opname')->with(['success'=>'Data Opname Berhasil Di Simpan']);
    }

    public function tambahDataBarang(Request $req){
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
            'jml_min' => 5,
            'created_at' => now()
        ]);
        return redirect('data-barang');
    }

    public function hapus($id){
        Barang::where('kode_barang', $id)->delete();
        return redirect('data-barang')->with(['success'=>'Data Barang Sudah Di Hapus']);
    }

    public function cetakBarang(){
        $barang = Barang::leftJoin('suplier', 'barang.id_suplier', '=', 'suplier.id_suplier')
        ->select('barang.*', 'suplier.nama_suplier')->get();
        return view('barang', ['barang' => $barang]);
    }

    public function export(){
        $datenow = date_format(date_create(now()), "dmY");
        return Excel::download(new BarangExport, 'data_barang'.$datenow.'.xlsx');
    }

    
}
