<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Suplier;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Exports\TransaksiExport;
use App\Exports\TransaksiMasukExport;
use App\Exports\PenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    public function indexKeluar(Request $req){
        $trx = Transaksi::where('jenis_transaksi', '<>', 'MASUK')
                    ->leftjoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                    ->select('transaksi.*', 'barang.nama_barang')->orderBy('transaksi.created_at', 'ASC')->paginate(10);
        if ($req->ajax()) {
            return view('barang_keluar', compact('trx'))->render();
        }
        return view('barang_keluar', ['trx' => $trx]);
    }

    public function indexMasuk(Request $req){
        $trx = Transaksi::where('jenis_transaksi', '=', 'MASUK')
                ->leftjoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                ->select('transaksi.*', 'barang.nama_barang')->orderBy('transaksi.created_at', 'ASC')->paginate(10);

        if ($req->ajax()) {
            return view('barang_masuk', compact('trx'))->render();
        }
        return view('barang_masuk', ['trx' => $trx]);
    }

    public function barangMasuk(){
        $barang = Barang::all();
        return view('tambah_barang_masuk', ['barang' => $barang]);
    }

    public function detailMasuk($id){
        $tr = Transaksi::join('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                        ->join('suplier', 'barang.id_suplier', '=', 'suplier.id_suplier')
                        ->where('kode_transaksi', $id)
                        ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'suplier.nama_suplier')->get();

        return view('detail_barang_masuk', ['tr' => $tr]);
    }

    public function detailKeluar($id){
        $tr = Transaksi::join('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                        ->join('suplier', 'barang.id_suplier', '=', 'suplier.id_suplier')
                        ->where('kode_transaksi', $id)
                        ->select('transaksi.*', 'barang.kode_barang', 'barang.nama_barang', 'suplier.nama_suplier')->get();

        return view('detail_barang_keluar', ['tr' => $tr]);
    }

    public function barangKeluar(){
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
        try{
        //membuat tanggal untuk kode transaksi
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
            'keterangan'=> $req->keterangan,
            'created_at' => now()
        ]);

        //update qty pada tabel barang
        $intQty = (int)$brg[0]['jml_brg'] - (int)$req->retur;
        Barang::where('kode_barang', '=' , $req->kodebrg)->update([
            'jml_brg' => $intQty
        ]);
        return redirect('barang-keluar');
    }catch(ValidationException $excep){
        return redirect('retur-barang');
    }
    }

    public function tambahMasuk(Request $req){
        try{
            $validatedData = $req->validate([
                'jml' => "required|numeric"
            ]);

            //membuat tanggal untuk kode transaksi
            $datenow = date_format(date_create(now()), "dmY");

            //cek data kode transaksi terakhir
            $prefix = 'BM'.$datenow;
            $kode = Transaksi::where('kode_transaksi', 'like', $prefix.'%')->orderByDesc('kode_transaksi')->value('kode_transaksi');
            //set kode transaksi
            if(empty($kode)){
                $kodeBaru = $prefix . '0001';
            }else{
                $lastNumber = (int) substr($kode, strlen($prefix));
                $next = $lastNumber + 1;
                $kodeBaru = $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
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
                'kode_transaksi'=> $kodeBaru ,
                'kode_barang'=> $req->kodebrg,
                'id_pengguna'=> $id[0]['id_pengguna'],
                'jenis_transaksi'=> 'MASUK',
                'jml'=> $req->brgMasuk,
                'harga'=> $intHarga,
                'created_at' => now()
            ]);
            //update jml pada tabel barang
            $intQty = (int)$brg[0]['jml_brg'] + (int)$req->brgMasuk;
            Barang::where('kode_barang', '=' , $req->kodebrg)->update([
                'jml_brg' => $intQty
            ]);
            return redirect('barang-masuk');
        }catch(ValidationException $e){
            return redirect('tambah-barang-masuk');
        }
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
        $barang = Barang::select('harga_jual','jml_brg')->where('kode_barang', '=' , $req->kodebrg)->get();
        $brg = json_decode($barang, true);

        // cek jml_brg dari modal atau tidak dan menghitung harga
        if(!empty($req->jmlBrg)){
            $jumlah = $req->jmlBrg;
            //menghitung total harga
            $intHarga = (int)$brg[0]['harga_jual'] * $jumlah;
        }else{
            $jumlah = $req->jml;
            //menghitung total harga
            $intHarga = str_replace(["Rp.", "."],"",$req->total);
        }

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
            'jenis_transaksi'=> 'JUAL',
            'jml'=> $jumlah,
            'harga'=> $harga,
            'keterangan' => $req->keterangan,
            'created_at' => now()
        ]);

        //update qty pada tabel barang
        $intQty = (int)$brg[0]['jml_brg'] - (int)$jumlah;
        Barang::where('kode_barang', '=' , $req->kodebrg)->update([
            'jml_brg' => $intQty
        ]);
        return redirect('barang-keluar')->with(['success' => 'Penjualan Berhasil']);
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

    public function exportTrx($daterange){
        $date = explode(' - ',$daterange);
        $startDate = date_format(date_create($date[0]), 'Y-m-d H:i:s');
        $endDate = date_format(date_create($date[1]), 'Y-m-d') . " 23:59:59";
        $datenow = date_format(date_create(now()), "dmY");
        return Excel::download(new TransaksiExport($startDate,$endDate), 'laporan_transaksi_'.$datenow.'.xlsx');
    }

    public function transaksi(Request $req){
        $daterange = $req->daterange;
        $date = explode(' - ',$daterange);
        $startDate = date_format(date_create($date[0]), 'Y-m-d H:i:s');
        $endDate = date_format(date_create($date[1]), 'Y-m-d') . " 23:59:59";
        $data = Transaksi::leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
            ->select('transaksi.*', 'barang.nama_barang')->whereBetween('transaksi.created_at', [$startDate, $endDate])->orderBy('transaksi.created_at', 'asc')->get();
        return view('laporan/transaksi', ['trx' => $data, 'daterange' => $daterange]);
    }

    public function laporanTransaksi( Request $req ){
        $data = Transaksi::leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
            ->select('transaksi.*', 'barang.nama_barang');
        return DataTables::of($data)
                ->filter(function($instence) use ($req){
                    if($req->filled('startDate') && $req->filled('endDate')){
                        $instence->whereBetween('transaksi.created_at', [$req->startDate, $req->endDate]);
                    }elseif($req->filled('startDate') == $req->filled('endDate')){
                        $instence->whereBetween('transaksi.created_at', [$req->startDate, $req->endDate]);
                    }
                })
                ->make(true);
    }

    public function lpTrx(){
        $data = Transaksi::select('jenis_transaksi')->groupBy('jenis_transaksi')->get();
        return view('laporan/laporan_transaksi',  ['data' => $data]);
    }

    public function laporanPenjualan( Request $req){
        $data = Transaksi::where('transaksi.jenis_transaksi', 'JUAL')
                ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                ->groupBy('transaksi.kode_barang')
                ->selectRaw('transaksi.*, barang.nama_barang, barang.satuan, sum(transaksi.jml) as total_brg, sum(transaksi.harga) as total_harga')
                ->orderBy('transaksi.created_at', 'asc');
        return DataTables::of($data)
                    ->filter(function($instence) use ($req){
                        if($req->filled('startDate') && $req->filled('endDate')){
                            $instence->whereBetween('transaksi.created_at', [$req->startDate, $req->endDate]);
                        }elseif($req->filled('startDate') == $req->filled('endDate')){
                            $instence->whereBetween('transaksi.created_at', [$req->startDate, $req->endDate]);
                        }
                    })
                    ->make(true);
    }
    public function cetakPenjualan(Request $req){
        $daterange = $req->daterange;
        $date = explode(' - ',$daterange);
        $startDate = date_format(date_create($date[0]), 'Y-m-d H:i:s');
        $endDate = date_format(date_create($date[1]), 'Y-m-d') . " 23:59:59";
        $data = Transaksi::where('transaksi.jenis_transaksi', 'JUAL')
                ->leftJoin('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                ->groupBy('transaksi.kode_barang')
                ->selectRaw('transaksi.*, barang.nama_barang, barang.satuan, sum(transaksi.jml) as total_brg, sum(transaksi.harga) as total_harga')->whereBetween('transaksi.created_at', [$startDate, $endDate])
                ->orderBy('transaksi.created_at', 'asc')->get();
        return view('laporan/penjualan', ['data' => $data, 'daterange' => $daterange]);
    }

    public function exportPenjualan($daterange){
        $date = explode(' - ',$daterange);
        $startDate = date_format(date_create($date[0]), 'Y-m-d H:i:s');
        $endDate = date_format(date_create($date[1]), 'Y-m-d') . " 23:59:59";
        $datenow = date_format(date_create(now()), "dmY");
        return Excel::download(new PenjualanExport($startDate,$endDate), 'laporan_penjualan_'.$datenow.'.xlsx');
    }

    public function hapus($id){
        try{
            Transaksi::where('kode_transaksi', $id)->delete();
            return redirect()->back()->with(['success'=>'Data Transaksi Sudah Di Hapus']);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->with(['failed'=>'Data Transaksi Tidak Dapat Di Hapus, Karena Masih Digunakan']);
        }
    }
}
