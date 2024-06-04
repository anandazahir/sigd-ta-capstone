<?php

use App\Http\Controllers\petikemascontroller;
use App\Http\Controllers\transaksicontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages/dashboard');
});
Route::get('/notification', function () {
    return view('pages/notification');
});
Route::get('/profile', function () {
    return view('pages/profile');
});
Route::get('/pegawai/more', function () {
    return view('pages/pegawai-more');
});
Route::get('/pegawai', function () {
    return view('pages/pegawai');
});
Route::get('/login', function () {
    return view('pages/login');
});
Route::get('/setting', function () {
    return view('pages/setting');
});
Route::prefix('transaksi')->group(function () {
    Route::get('/', [transaksiController::class, 'index']);
    Route::get('/index', [transaksiController::class, 'filter']);
    Route::get('/{id}', [transaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/store', [transaksiController::class, 'storeEntryData'])->name('transaksi.transaksistore');
    Route::put('/edit/{id}', [transaksiController::class, 'update'])->name('transaksi.update');
    Route::post('/delete', [transaksiController::class, 'delete'])->name('transaksi.delete');
    Route::post('/edit/entrydata/{id}', [transaksiController::class, 'editentrydata'])->name('transaksi.editentrydata');
    Route::post('/deleteentrydata', [transaksiController::class, 'deleteentrydata']);
    Route::post('/cetakspk/{id}', [transaksiController::class, 'cetakspk'])->name('transaksi.cetakspk');
    Route::post('/edit/pembayaran/{id}', [transaksiController::class, 'editpembayaran'])->name('transaksi.editpembayaran');
    Route::post('/laporantransaksi', [TransaksiController::class, 'laporanbulanantransaksi'])->name('transaksi.laporantransaksi');
    Route::post('/store/pengecekan', [TransaksiController::class, 'storepengecekan'])->name('transaksi.storepengecekan');
    Route::post('/indexkerusakan', [TransaksiController::class, 'indexkerusakan'])->name('transaksi.indexkerusakan');
    Route::post('/editpengecekan', [TransaksiController::class, 'editpengecekan'])->name('transaksi.editpengecekan');
    Route::post('/deletekerusakan', [TransaksiController::class, 'deletekerusakan'])->name('transaksi.deletekerusakan');
    Route::post('/editperbaikan', [TransaksiController::class, 'editperbaikan'])->name('transaksi.editperbaikan');
});

Route::prefix('peti-kemas')->group(function () {
    Route::get('/', [petikemascontroller::class, 'index']);
    Route::get('/index', [petikemascontroller::class, 'filter']);
    Route::get('/{id}', [petikemasController::class, 'show'])->name('petikemas.show');
    Route::post('/store', [petikemascontroller::class, 'storePetiKemas'])->name('petikemas.petikemasstore');
    Route::post('/delete', [petikemasController::class, 'delete'])->name('petikemas.delete');
});
