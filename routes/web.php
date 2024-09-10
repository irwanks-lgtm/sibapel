<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('data-pengguna', function () {
		return view('user-management');
	})->name('data-pengguna');

	Route::get('data-suplier', function () {
		return view('data_suplier');
	})->name('data-suplier');

	Route::get('data-barang', function () {
		return view('data_barang');
	})->name('data-barang');

	Route::get('barang-masuk', function () {
		return view('barang_masuk');
	})->name('barang-masuk');

	Route::get('barang-keluar', function () {
		return view('barang_keluar');
	})->name('barang-keluar');

	Route::get('tambah-barang-keluar', function () {
		return view('tambah_barang_keluar');
	})->name('tambah-barang-keluar');

	Route::get('stok-opname', function () {
		return view('stok_opname');
	})->name('stok-opname');

    Route::get('detail-stok-opname', function () {
		return view('detail_so');
	})->name('Detail Stok Opname');

	Route::get('detail-barang-masuk', function () {
		return view('detail_barang_masuk');
	})->name('detail-barang-masuk');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create']);
    Route::post('/session', [LoginController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');