<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\TransaksiController;
use App\Models\Pembeli;
use App\Models\Transaksi;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::resource('/barangs', BarangController::class);

Route::post('/new-pembeli', [PembeliController::class, 'ajaxPost']);
Route::post('/simpan-transaksi', [TransaksiController::class, 'simpan']);
Route::get('/receipt/{id}', [TransaksiController::class, 'receipt']);
// Route::get('/')

Route::get('/belanja', [TransaksiController::class, 'create'])->name('belanja');

// Route::get('/tes', function () {
//     $tes = Pembeli::select('id', 'nama')->latest()->first();
//     dd($tes);
// });
