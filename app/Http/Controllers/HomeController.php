<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Suplier;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        $jmlBrg = Barang::all()->count();
        $jmlUser = User::all()->count();
        $jmlSup = Suplier::all()->count();

        //total penjualan dalam 1 bulan
        // ambil bln sekarang
        $bulan = Carbon::now()->format('m');
        $totalsale = Transaksi::where('jenis_transaksi', 'JUAL')->whereMonth('created_at', $bulan)->sum('harga');
        $hotsale = Barang::leftJoin('transaksi', 'barang.kode_barang', '=', 'transaksi.kode_barang')
        ->select('barang.nama_barang', DB::raw('sum(transaksi.jml) as jual'))->where('jenis_transaksi', 'JUAL')->groupBy('barang.kode_barang')->orderBy('jual', 'DESC')->whereMonth('transaksi.created_at', $bulan)->get();
        $stokbrg = Barang::whereColumn('jml_brg', '<=','jml_min')->get();
        return view('dashboard', ['jmlBrg' => $jmlBrg, 'jmlUser' => $jmlUser, 'jmlSup' => $jmlSup, 'total' => $totalsale, 'hotsale' => $hotsale, 'stokbrg' => $stokbrg ]);

    }
}
