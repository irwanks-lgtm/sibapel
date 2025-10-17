<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Barang;
use App\Models\User;
use App\Models\Stok;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StokOpnameExport;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class StokOpnameController extends Controller
{
    public function indexOpname(Request $req){
        $stok = Stok::join('user', 'stok_opname.id_pengguna', '=', 'user.id_pengguna')
                            ->select('stok_opname.*', 'user.nama_pengguna')->groupBy('kode_stok')->orderBy('stok_opname.created_at')->paginate(15);
        if ($req->ajax()) {
            return view('stok_opname', compact('stok'))->render();
        }
        return view('stok_opname', ['stok' => $stok]);
    }

    public function buatOpname(){
        $rak = Barang::select('kode_rak')->groupBy('kode_rak')->get();
        $pic = User::all();
        return view('tambah_stok_opname', ['rak' => $rak, 'pic' => $pic]);
    }

    public function dataOpname($kode_stok){
        $dataOpname = Stok::join('barang', 'stok_opname.kode_barang', '=', 'barang.kode_barang')
                            ->join('user', 'stok_opname.id_pengguna', '=', 'user.id_pengguna')
                            ->select('stok_opname.*', 'barang.kode_barang', 'barang.nama_barang', 'user.nama_pengguna')
                            ->where('stok_opname.kode_stok', $kode_stok)->get();
        return view('data_opname', ['dataOpname' => $dataOpname, 'kodeStok' => $kode_stok]);
    }

    public function simpanOpname(Request $req){
        $validatedData = Validator::make($req->all(), [
            '*.*.aktual' => "required|numeric"
        ]);
        if ($validatedData->fails()) {
        // Melempar ValidationException secara manual dengan data error disimpan ke session
        return redirect('data-stok/'.$req->kodeStok)->with(['failed'=>'Pastikan Input dengan Benar']);
        }
            if(Str::contains(Session::get('idUser'), 'ADM')){
                $index = 1;
                foreach($req->data as $data){

                    $dataOpname = Stok::where('kode_stok', $req->kodeStok)->where('kode_barang', $req->data[$index]['kdbrg'])->update([
                        'jml_aktual' => $req->data[$index]['aktual'],
                        'selisih' => $req->data[$index]['selisih'],
                        'status' => 'SELESAI',
                        'keterangan' => $req->data[$index]['keterangan'],
                        'updated_at' => now()
                    ]);

                    $updateBarang = Barang::where('kode_barang', $req->data[$index]['kdbrg'])->update([
                        'jml_brg' => $req->data[$index]['aktual'],
                        'updated_at' => now()
                    ]);
                    $index++;
                }
                return redirect('validasi-stok')->with(['success'=>'Data Opname Berhasil Di Simpan']);
            }else{
                $index = 1;
                foreach($req->data as $data){
                    $dataOpname = Stok::where('kode_stok', $req->kodeStok)->where('kode_barang', $req->data[$index]['kdbrg'])->update([
                        'jml_aktual' => $req->data[$index]['aktual'],
                        'keterangan' => $req->data[$index]['keterangan'],
                        'updated_at' => now()
                    ]);
                    $index++;
                }
                return redirect('validasi-stok')->with(['success'=>'Data Opname Berhasil Di Simpan']);
            }
    }


    public function tambahOpname(Request $req){
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
        $barang = Barang::where('kode_rak', $req->rak)->get();
        foreach($barang as $brg){
            Stok::insert([
                'kode_stok' => $kodebaru,
                'kode_barang' => $brg->kode_barang,
                'jml_sistem' => $brg->jml_brg,
                'jml_aktual' => 0,
                'selisih' => 0,
                'id_pengguna' => $req->pic,
                'kode_rak' => $req->rak,
                'status' => 'PROSES',
                'created_at' => now()
            ]);
        }
        return redirect('validasi-stok');
    }

    public function export($kodeStok){
        $datenow = date_format(date_create(now()), "dmY");
        $status = Stok::select('status')->where('kode_stok', $kodeStok)->get();
        if($status[0]->status=="PROSES"){
            $namaFile = 'Form_validasi_stok_';
        }else{
            $namaFile = 'Laporan_validasi_stok_';
        }
        return Excel::download(new StokOpnameExport($kodeStok), $namaFile. $datenow .'_'. $kodeStok .'.xlsx');
    }
}
