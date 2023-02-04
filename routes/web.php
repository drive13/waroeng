<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\TransaksiController;
use App\Models\Barang;
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

Route::resource('/kategoris', KategoriController::class);

Route::resource('/barangs', BarangController::class);
Route::get('/barang-ajax', [BarangController::class, 'ajax']);

Route::post('/new-pembeli', [PembeliController::class, 'ajaxPost']);
Route::post('/simpan-transaksi', [TransaksiController::class, 'simpan']);
Route::get('/receipt/{id}', [TransaksiController::class, 'receipt']);

Route::get('/belanja', [TransaksiController::class, 'create'])->name('belanja');
