<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Suplier;
use App\Models\User;
use App\Models\Transaksi;

class HomeController extends Controller
{
    public function home()
    {
        $jmlBrg = Barang::all()->count();
        $jmlUser = User::all()->count();
        $jmlSup = Suplier::all()->count();

        //total penjualan dalam 1 bulan
        // ambil bln sekarang
        $bulan = date_format(date_create(now()), 'm');
        $totalsale = Transaksi::where('jenis_transaksi', 'POS')->whereMonth('tgl_transaksi', $bulan)->sum('harga');
        return view('dashboard', ['jmlBrg' => $jmlBrg, 'jmlUser' => $jmlUser, 'jmlSup' => $jmlSup, 'total' => $totalsale]);
    }
}
