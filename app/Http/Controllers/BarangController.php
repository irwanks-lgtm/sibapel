<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function show(Request $req){
        $query = Barang::orderBy('created_at', 'ASC');
        if ($req->filled('keyword')) {
            $query->where('nama_barang', 'like', "%{$req->keyword}%")
                ->orWhere('kode_barang', 'like', "%{$req->keyword}%");
        }
        $barang = $query->paginate(10);
        return view('data_barang', compact('barang'));
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
            'deskripsi' => "required",
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
        try{
            Barang::insert([
                'kode_barang' => $req->kdbrg,
                'id_suplier' => $req->suplier,
                'barcode' => $req->barcode,
                'nama_barang' => $req->nmbrg,
                'jml_brg' => $req->jml,
                'satuan' => $req->satuan,
                'harga_beli' => $beli,
                'harga_jual' => $jual,
                'deskripsi' => $req->deskripsi,
                'jenis_barang' => $req->jenis,
                'kode_rak' => $req->rak,
                'jml_min' => 0,
                'waktu_tg' => $req->waktu_tg,
                'created_at' => now()
            ]);
            return redirect('data-barang')->with(['success'=>'Data Barang Berhasil Di Tambah']);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect('data-barang')->with(['failed'=>'Data Barang Sudah Ada']);;
        }
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
            'kode_barang' => $req->kdbaru,
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
            ->selectRaw('transaksi.kode_barang, barang.nama_barang, SUM(transaksi.jml) as total, barang.waktu_tg')
            ->whereMonth('transaksi.created_at', $bulanLalu)
            ->groupBy('transaksi.kode_barang', 'barang.nama_barang', 'barang.waktu_tg')
            ->get();

        foreach ($jual as $j) {
            Session::forget($j->kode_barang);

            // Rata-rata penggunaan harian
            $averageUsage = $j->total / 30;

            // Ambil penggunaan harian tertinggi di bulan lalu
            $maxUsage = Transaksi::where('kode_barang', $j->kode_barang)
                ->whereMonth('created_at', $bulanLalu)
                ->selectRaw('SUM(jml) as total_harian')
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderByDesc('total_harian')
                ->value('total_harian');

            // Hitung safety stock
            $safety = ($maxUsage - $averageUsage) * $j->waktu_tg;

            // Hitung minimum level
            $minimum = ceil(($averageUsage * $j->waktu_tg) + $safety);

            // Update stok minimum di database
            Barang::where('kode_barang', $j->kode_barang)->update([
                'jml_min' => $minimum
            ]);

            Session::put($j->kode_barang, $minimum);
        }
        return redirect('data-barang')->with(['success' => 'Stok Minimum Sudah diperbarui']);
    }

    public function hapus($id){
        try{
            Barang::where('kode_barang', $id)->delete();
            return redirect()->back()->with(['success'=>'Data Barang Sudah Di Hapus']);
        }catch(QueryException $e){
            return redirect()->back()->with(['failed'=>'Data Barang Tidak Dapat Di Hapus, Karena Masih Digunakan']);
        }
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
