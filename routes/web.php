<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
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

    Route::get('/', function () {
		return redirect('dashboard');
	})->name('returnDashboard');
	Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');

	Route::get('data-pengguna', [UserController::class, 'index'])->name('data-pengguna');
	Route::post('simpan-pengguna', [UserController::class, 'tambah'])->name('simpan-pengguna');
	Route::get('edit-pengguna/{id}', [UserController::class, 'indexEdit'])->name('edit-pengguna');
	Route::post('/editpengguna', [UserController::class, 'editPengguna'])->name('editPengguna');
	Route::get('tambah-pengguna', function () {
		return view('tambah_data_pengguna');
	})->name('tambah-pengguna');
	Route::get('hapus-pengguna/{id}', [UserController::class, 'hapus'])->name('hapus-pengguna');


	Route::get('stok-opname', [StokOpnameController::class, 'indexOpname'])->name('stok-opname');
	Route::get('buat-opname', [StokOpnameController::class, 'buatOpname'])->name('buat-opname');
    Route::get('data-opname/{kode_stok}', [StokOpnameController::class, 'dataOpname'])->name('data-opname');
	Route::post('tambah-opname', [StokOpnameController::class, 'tambahOpname'])->name('tambah-opname');
	Route::post('simpan-opname', [StokOpnameController::class, 'simpanOpname'])->name('simpan-opname');
    Route::get('download/opname/{kode_stok}', [StokOpnameController::class, 'export'])->name('cetak-opname');

	Route::controller(TransaksiController::class)->group(function(){
		Route::get('retur-barang','showKeluar')->name('showKeluar');
		Route::get('barang-keluar','indexKeluar')->name('barang-keluar');
		Route::post('retur','tambahRetur')->name('returBarang');
		Route::get('pos','indexPos')->name('pointofsale');
		Route::post('penjualan','tambahPenjualan')->name('penjualan');
		Route::get('get/detail/{nmbrg}','getDetails')->name('getDetails');
		Route::get('barang-masuk', 'indexMasuk')->name('barang-masuk');
		Route::post('tambah-masuk','tambahMasuk')->name('tambahMasuk');
		Route::get('tambah-barang-masuk','showMasuk')->name('showMasuk');

		Route::get('laporanTransaksi', 'laporanTransaksi')->name('laporan.transaksi');
		Route::get('laporan-transaksi', 'lpTrx')->name('laporanTransaksi');
		Route::get('transaksi','transaksi')->name('transaksi');
		Route::get('/download/transaksi','exportTrx')->name('download.transaksi');

		Route::get('laporan-penjualan', function () {
			return view('laporan/laporan_penjualan');
		})->name('laporan.penjualan');
		Route::get('laporanPenjualan', 'laporanPenjualan')->name('laporanPenjualan');
		Route::get('cetak-penjualan','cetakPenjualan')->name('cetak.penjualan');
		Route::get('/download/laporan-penjualan','exportPenjualan')->name('download.penjualan');

		Route::get('cetak-transaksi','transaksiMasuk')->name('cetakTransaksiMasuk');
		Route::get('/download/transaksi/masuk','export')->name('download.transaksi.masuk');
	});

	Route::get('data-barang', [BarangController::class, 'show'])->name('data-barang');
	Route::get('tambah-data-barang', [BarangController::class, 'tambahbarang'])->name('tambah-data-barang');
	Route::post('/tambah', [BarangController::class, 'tambahDataBarang']);
	Route::get('cetak-barang', [BarangController::class, 'cetakBarang'])->name('cetakBarang');
	Route::get('/download/barang',[BarangController::class, 'export'])->name('download.barang');
	Route::get('detail-barang/{id}', [BarangController::class, 'detailBarang']);
	Route::get('edit-barang/{id}', [BarangController::class, 'indexEdit']);
	Route::post('editbarang', [BarangController::class, 'editBarang']);
	Route::get('hapus/{id}', [BarangController::class, 'hapus']);

	Route::get('data-suplier', [SuplierController::class, 'show'])->name('data-suplier');
	Route::post('/tambahsuplier', [SuplierController::class, 'tambah']);
	Route::get('tambah-suplier', function () { return view('tambah_suplier');})->name('tambah-suplier');
	Route::get('edit-suplier/{id}', [SuplierController::class, 'indexEdit']);
	Route::post('/editsuplier', [SuplierController::class, 'editSuplier']);
	Route::get('hapussup/{id}', [SuplierController::class, 'hapus']);

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
	});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
