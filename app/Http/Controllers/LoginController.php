<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }
    
    public function store(){
        $users = DB::select('select * from users');

    }
}
