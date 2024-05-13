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

Route::prefix('transaksi')->group(function () {
    Route::get('/', [TransaksiController::class, 'index']);
    Route::get('/index', [TransaksiController::class, 'filter']);
    Route::get('/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::post('/store', [TransaksiController::class, 'storeEntryData'])->name('transaksi.transaksistore');
    Route::put('/edit/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::post('/delete', [TransaksiController::class, 'delete'])->name('transaksi.delete');
    Route::post('/edit/entrydata/{id}', [TransaksiController::class, 'editentrydata'])->name('transaksi.editentrydata');
});
Route::prefix('peti-kemas')->group(function () {
    Route::get('/', [petikemascontroller::class, 'index']);
    Route::get('/index', [petikemascontroller::class, 'filter']);
    Route::get('/{id}', [petikemasController::class, 'show'])->name('petikemas.show');
    Route::post('/store', [petikemascontroller::class, 'storePetiKemas'])->name('petikemas.petikemasstore');
    Route::post('/delete', [petikemasController::class, 'delete'])->name('petikemas.delete');
});
