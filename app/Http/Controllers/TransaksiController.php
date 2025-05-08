<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Exports\TransaksiExport;
use App\Exports\TransaksiMasukExport;
use App\Exports\PenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;


class TransaksiController extends Controller
{
    public function indexKeluar(){
        $trx = Transaksi::where('jenis_transaksi', '<>', 'MASUK')
                    ->leftjoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                    ->select('transaksi.*', 'barang.nama_barang')->orderBy('tgl_transaksi', 'ASC')->get();
        return view('barang_keluar', ['trx' => $trx]);
    }

    public function indexMasuk(){
        $trx = Transaksi::where('jenis_transaksi', '=', 'MASUK')->orderBy('tgl_transaksi', 'ASC')->get();
        return view('barang_masuk', ['trx' => $trx]);
    }

    public function showMasuk(){
        $barang = Barang::all();
        return view('tambah_barang_masuk', ['barang' => $barang]);
    }

    public function showKeluar(){
        $barang = Barang::all();
        return view('barangkeluar/retur_barang', ['barang' => $barang]);
    }

    public function indexPos(){
        $barang = Barang::all();
        return view('pos', ['barang' => $barang]);
    }  
    
    public function getDetails($nmbrg = 0)
    {
        $data = Barang::where('nama_barang', $nmbrg)
            ->leftJoin('suplier', 'barang.id_suplier', '=', 'suplier.id_suplier')
            ->select('barang.*', 'suplier.nama_suplier', 'suplier.pembayaran', 'suplier.keterangan')->get()->first();

        return response()->json($data);
    }

    public function tambahRetur(Request $req){
        //membuat tanggal untuk tanggal transaksi dan untuk kode transaksi
        $date = date_format(date_create(now()), "Y-m-d H:i:s");
        $datenow = date_format(date_create(now()), "dmY");

       //cek data kode transaksi terakhir
        $kode = Transaksi::select('kode_transaksi')->where('kode_transaksi', 'like', '%RT'.'%'.$datenow.'%')->get()->last();

        //set kode transaksi 
        if(empty($kode)){
            $kodebaru = 'RT'. $datenow . '0001';
        }else{
            $kodebaru = json_decode($kode)->kode_transaksi;
            $kd = Str::of($kodebaru)->afterLast($datenow);
            $intKode = (int) $kd->value + 1;
            //mengubah integer Kode Transaksi menjadi string
                if(strlen($intKode)==1){
                     $kodebaru = 'RT'. $datenow . "000" . (string)$intKode;
                }else if(strlen($intKode)==2){
                    $kodebaru = 'RT'. $datenow . "00" . (string)$intKode;
                }else if(strlen($intKode)==3){
                    $kodebaru = 'RT'. $datenow . "0" . (string)$intKode;
                }else{
                    $kodebaru = 'RT'. $datenow . (string)$intKode;
                }
        }
        

        //mengambil id user
        $iduser = User::select('id_pengguna')->where('nama_pengguna' , '=' ,  Session::get('name'))->get();
        $id = json_decode($iduser, true);

        //mengambil data barang untuk mengurangi qty dan menghitung total harga
        $barang = Barang::select('harga_beli', 'jml_brg')->where('kode_barang', '=' , $req->kodebrg)->get();
        $brg = json_decode($barang, true);

        //menghitung total harga
        $intHarga = (int)$brg[0]['harga_beli'] * (int)$req->retur;

        //insert data transaksi
        Transaksi::insert([
            'kode_transaksi'=> $kodebaru ,
            'kode_barang'=> $req->kodebrg,
            'id_pengguna'=> $id[0]['id_pengguna'],
            'jenis_transaksi'=> 'RETUR',
            'jml'=> $req->retur,
            'harga'=> $intHarga,
            'tgl_transaksi'=> $date,
            'keterangan'=> $req->keterangan
        ]);

        //update qty pada tabel barang
        $intQty = (int)$brg[0]['jml_brg'] - (int)$req->retur;
        Barang::where('kode_barang', '=' , $req->kodebrg)->update([
            'jml_brg' => $intQty
        ]);
        return redirect('barang-keluar');
    }

    public function tambahMasuk(Request $req){
        //membuat tanggal untuk tanggal transaksi dan untuk kode transaksi
        $date = date_create(now());
        $datenow = date_format(date_create(now()), "dmY");

       //cek data kode transaksi terakhir
        $kode = Transaksi::select('kode_transaksi')->where('kode_transaksi', 'like', '%BM'.'%'.$datenow.'%')->get()->last();

        //set kode transaksi 
        if(empty($kode)){
            $kodebaru = 'BM'. $datenow . '0001';
        }else{
            $kodebaru = json_decode($kode)->kode_transaksi;
            $kd = Str::of($kodebaru)->afterLast($datenow);
            $intKode = (int) $kd->value + 1;
            //mengubah integer Kode Transaksi menjadi string
                if(strlen($intKode)==1){
                     $kodebaru = 'BM'. $datenow . "000" . (string)$intKode;
                }else if(strlen($intKode)==2){
                    $kodebaru = 'BM'. $datenow . "00" . (string)$intKode;
                }else if(strlen($intKode)==3){
                    $kodebaru = 'BM'. $datenow . "0" . (string)$intKode;
                }else{
                    $kodebaru = 'BM'. $datenow . (string)$intKode;
                }
        }
        

        //mengambil id user
        $iduser = User::select('id_pengguna')->where('nama_pengguna' , '=' ,  Session::get('name'))->get();
        $id = json_decode($iduser, true);

        //mengambil data barang untuk menambah qty dan menghitung total harga
        $barang = Barang::select('harga_beli', 'jml_brg')->where('kode_barang', '=' , $req->kodebrg)->get();
        $brg = json_decode($barang, true);

        //menghitung total harga
        $intHarga = (int)$brg[0]['harga_beli'] * (int)$req->brgMasuk;

        //insert data transaksi
        Transaksi::insert([
            'kode_transaksi'=> $kodebaru ,
            'kode_barang'=> $req->kodebrg,
            'id_pengguna'=> $id[0]['id_pengguna'],
            'jenis_transaksi'=> 'MASUK',
            'jml'=> $req->brgMasuk,
            'harga'=> $intHarga,
            'tgl_transaksi'=> $date,
        ]);
        //update jml pada tabel barang
        $intQty = (int)$brg[0]['jml_brg'] + (int)$req->brgMasuk;
        Barang::where('kode_barang', '=' , $req->kodebrg)->update([
            'jml_brg' => $intQty
        ]);
        return redirect('barang-masuk');
    }

    public function tambahPenjualan(Request $req){
        //membuat tanggal untuk tanggal transaksi dan untuk kode transaksi
        $date = date_create(now());
        $datenow = date_format(date_create(now()), "dmY");

       //cek data kode transaksi terakhir
        $kode = Transaksi::select('kode_transaksi')->where('kode_transaksi', 'like', '%SL'.$datenow.'%')->orderBy('kode_transaksi', 'ASC')->get()->last();

        //set kode transaksi 
        if(empty($kode)){
            $kodebaru = 'SL'. $datenow . '0001';
        }else{
            $kodebaru = json_decode($kode)->kode_transaksi;
            $kd = Str::of($kodebaru)->afterLast($datenow);
            $intKode = (int) $kd->value + 1;
           // mengubah integer Kode Transaksi menjadi string
                if(strlen($intKode)==1){
                    $kodebaru = 'SL'. $datenow . "000" . (string)$intKode;
                }else if(strlen($intKode)==2){
                    $kodebaru = 'SL'. $datenow . "00" . (string)$intKode;
                }else if(strlen($intKode)==3){
                    $kodebaru = 'SL'. $datenow . "0" . (string)$intKode;
                }else{
                    $kodebaru = 'SL'. $datenow . (string)$intKode;
                }
        }
        
        //mengambil id user
        $iduser = User::select('id_pengguna')->where('nama_pengguna' , '=' ,  Session::get('name'))->get();
        $id = json_decode($iduser, true);

        //mengambil data barang untuk mengurangi qty dan menghitung total harga
        $barang = Barang::select('harga_beli', 'jml_brg')->where('kode_barang', '=' , $req->kodebrg)->get();
        $brg = json_decode($barang, true);

        //menghitung total harga
        $intHarga = str_replace(["Rp.", "."],"",$req->total);

        //cek harga dengan diskon
        if($req->disc != null){
            $harga = str_replace(["Rp.", "."],"",$req->harDisc);
        }else{
            $harga = $intHarga;
        }

        //insert data transaksi
        Transaksi::insert([
            'kode_transaksi'=> $kodebaru ,
            'kode_barang'=> $req->kodebrg,
            'id_pengguna'=> $id[0]['id_pengguna'],
            'jenis_transaksi'=> 'POS',
            'jml'=> $req->jml,
            'harga'=> $harga,
            'tgl_transaksi'=> $date,
            'keterangan' => $req->keterangan
        ]);

        //update qty pada tabel barang
        $intQty = (int)$brg[0]['jml_brg'] - (int)$req->jml;
        Barang::where('kode_barang', '=' , $req->kodebrg)->update([
            'jml_brg' => $intQty
        ]);
        return redirect('barang-keluar');
    }

    public function transaksiMasuk(){
        $data = Transaksi::where('jenis_transaksi', 'MASUK')
            ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
            ->select('transaksi.*', 'barang.nama_barang')->get();
        return view('transaksi_masuk', ['trx' => $data]);
    }

    public function export(){
        $datenow = date_format(date_create(now()), "dmY");
        return Excel::download(new TransaksiMasukExport, 'data_barang_masuk_'.$datenow.'.xlsx');
    }

    public function exportTrx(){
        $datenow = date_format(date_create(now()), "dmY");
        return Excel::download(new TransaksiExport, 'data_transaksi_'.$datenow.'.xlsx');
    }

    public function transaksi(){
        $data = Transaksi::leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
            ->select('transaksi.*', 'barang.nama_barang')->orderBy('tgl_transaksi', 'asc')->get();
        return view('laporan/transaksi', ['trx' => $data]);
    }

    public function laporanTransaksi(){
        $data = Transaksi::leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
            ->select('transaksi.*', 'barang.nama_barang')->get();
        return DataTables::of($data)->make(true);
    }

    public function lpTrx(){
        $data = Transaksi::select('jenis_transaksi')->groupBy('jenis_transaksi')->get();
        return view('laporan/laporan_transaksi',  ['data' => $data]);
    }

    public function laporanPenjualan(){
        $data = Transaksi::where('transaksi.jenis_transaksi', 'POS')
                ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                ->groupBy('transaksi.kode_barang')
                ->selectRaw('transaksi.*, barang.nama_barang, barang.satuan, sum(transaksi.jml) as total_brg, sum(transaksi.harga) as total_harga')
                ->orderBy('tgl_transaksi', 'asc')->get();
        return DataTables::of($data)->make(true);
    }
    public function cetakPenjualan(){
        $data = Transaksi::where('transaksi.jenis_transaksi', 'POS')
                ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                ->groupBy('transaksi.kode_barang')
                ->selectRaw('transaksi.*, barang.nama_barang, barang.satuan, sum(transaksi.jml) as total_brg, sum(transaksi.harga) as total_harga')
                ->orderBy('tgl_transaksi', 'asc')->get();
        return view('laporan/penjualan', ['data' => $data]);
    }

    public function exportPenjualan(){
        $datenow = date_format(date_create(now()), "dmY");
        return Excel::download(new PenjualanExport, 'data_penjualan_'.$datenow.'.xlsx');
    }
    

}
