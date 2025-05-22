<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Transaksi;
use Carbon\Carbon;

class BarangController extends Controller
{
    public function show(){
        $barang = Barang::orderBy('created_at', 'ASC')->get();
        return view('data_barang', ['barang' => $barang]);
    }

    public function indexEdit($id){
        $barang = Barang::where('kode_barang', $id)->get();
        $suplier = Suplier::all();
        return view('edit/edit_data_barang', ['barang' => $barang, 'suplier' => $suplier]);
    }

    public function detailBarang($id){
        $barang = Barang::where('kode_barang', $id)->get();
        return view('detail_barang', ['barang' => $barang]);
    }

    public function tambahDataBarang(Request $req){

        $validatedData = $req->validate([
            'kdbrg' => "required",
            'suplier' => "required",
            'nmbrg' => "required",
            'jml' => "required|numeric",
            'satuan' => "required",
            'harga_beli' => "required",
            'harga_jual' => "required",
            'jenis' => "required",
            'rak' => "required|max:5",
            'waktu_tg' => "required|numeric"
        ]);

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
            'jml_min' => 0,
            'waktu_tg' => $req->waktu_tg,
            'created_at' => now()
        ]);
        return redirect('data-barang');
    }

    public function editBarang(Request $req){
        $hbeli = $req->harga_beli;
        $inthbeli = str_replace('Rp. ','', $hbeli);
        $beli = str_replace('.','', $inthbeli);

        $hjual = $req->harga_jual;
        $inthjual = str_replace('Rp. ','', $hjual);
        $jual = str_replace('.','', $inthjual);

        Barang::where('kode_barang', $req->kdbrg)->update([
            'id_suplier' => $req->suplier,
            'barcode' => $req->barcode,
            'nama_barang' => $req->nmbrg,
            'jml_brg' => $req->jml,
            'satuan' => $req->satuan,
            'harga_beli' => $beli,
            'harga_jual' => $jual,
            'jenis_barang' => $req->jenis,
            'kode_rak' => $req->rak,
            'jml_min' => $req->jml_min
        ]);
        return redirect('data-barang');
    }

    public function tambahbarang(){
        $suplier = Suplier::all();
        return view('tambah_data_barang', ['suplier' => $suplier]);
    }

    public function stokMin(){

        $bulanLalu = Carbon::now()->subMonth()->format('m');
        $jual = Transaksi::where('transaksi.jenis_transaksi', 'POS')
                            ->join('barang', 'transaksi.kode_barang', '=', 'barang.kode_barang')
                            ->groupBy('transaksi.kode_barang')
                            ->selectRaw('transaksi.*, barang.nama_barang, sum(transaksi.jml) as total, barang.waktu_tg')
                            ->whereMonth('transaksi.tgl_transaksi', $bulanLalu)->get();

        foreach($jual as $j){
            //menghitung safety stock
            $safety = ($j->total - ($j->total/30)) * ($j->waktu_tg/30);

            //menghitung stock minimum
            $minimum = (($j->total/30) * ($j->waktu_tg/30)) * $safety;

            //mengubah stok minimum pada database
            Barang::where('kode_barang', $j->kode_barang)->update([
                'jml_min' => $minimum
            ]);
        };

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
