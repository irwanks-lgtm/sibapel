<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return view('data_pengguna', ['user' => $user]);
    }

    public function indexEdit($id){
        $user = User::where('id_pengguna', $id)->get();
        return view('edit/edit_data_pengguna', ['user' => $user]);
    }

    public function editPengguna(Request $req){

        $validatedData = $req->validate([
            'email' => "required|email",
            'nama' => "required|max:100",
            'password' => "required|min:6",
            'alamat' => "required|max:50",
            'tmpt' => "required|max:30",
            'tgl_lhr' => "required",
            'nohp' => "required|numeric",
            'role' => "required",
        ]);

        User::where('id_pengguna', $req->id)->update([
            'email' => $req->email,
            'nama_pengguna' => $req->nama,
            'password' => Hash::make($req->password),
            'alamat' => $req->alamat,
            'tempat_lhr' => $req->tmpt,
            'tgl_lhr' => $req->tgl_lhr,
            'nomor_hp' => $req->nohp,
            'role' => $req->role,
            'updated_at' => now()
        ]);
        
        return redirect('data-pengguna');
    }

    public function tambah(Request $req){
        try{
            $validatedData = $req->validate([
                'email' => "required|email",
                'nama' => "required|max:100",
                'password' => "required|min:6",
                'alamat' => "required|max:50",
                'tmpt' => "required|max:30",
                'tgl_lhr' => "required",
                'nohp' => "required|numeric",
                'role' => "required",
            ]);
               //cek role user baru
            if($req->role == 'admin'){
                $role = "ADM";
            }else{
                $role = "KWN";
            }

            //mengambil id user terakhir
            $idUser = User::where('id_pengguna', 'like', $role . '%')->get()->last();
            if(empty($idUser)){
                $idBaru = $role . '0001';
            }else{
                $idBaru = json_decode($idUser)->id_pengguna;
                $id = Str::of($idBaru)->afterLast($role);
                $intId = (int) $id->value + 1;

                //mengubah integer Kode Transaksi menjadi string
                if(strlen($intId)==1){
                    $idBaru = $role . '000' . (string)$intId;
                }else if(strlen($intId)==2){
                    $idBaru = $role . '00' . (string)$intId;
                }else if(strlen($intId)==3){
                    $idBaru = $role . '0' . (string)$intId;
                }else{
                    $idBaru = $role . (string)$intId;
                }
            }
            User::insert([
                'id_pengguna' => $idBaru,
                'email' => $req->email,
                'nama_pengguna' => $req->nama,
                'password' => Hash::make($req->password),
                'alamat' => $req->alamat,
                'tempat_lhr' => $req->tmpt,
                'tgl_lhr' => $req->tgl_lhr,
                'nomor_hp' => $req->nohp,
                'role' => $req->role,
                'created_at' => now()
            ]);
            return redirect('data-pengguna');
        }catch(ValidationException $excep){
            return redirect('tambah-pengguna');
        }
    }

    public function hapus($id){
        User::where('id_pengguna', $id)->delete();
        return redirect('data-pengguna')->with(['success'=>'Data Berhasil di Hapus']);
    }
}
