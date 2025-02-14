<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
       
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            $name = User::select('nama_pengguna', 'id_pengguna')->where('email', '=', $attributes['email'])->first();

            Session::put('name', $name['nama_pengguna']);
            Session::put('idUser', $name['id_pengguna']);
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();
        Session::flush();
        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
