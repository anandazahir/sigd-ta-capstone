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

Route::get('/transaksi', [transaksicontroller::class, 'index']);
Route::get('/transaksi/index', [transaksicontroller::class, 'filter']);
Route::get('/transaksi/{id}', [transaksiController::class, 'show'])->name('transaksi.show');
Route::post('/transaksi/store', [transaksicontroller::class, 'storeEntryData'])->name('transaksi.entrydatastore');
Route::put('/transaksi/edit/{id}', [transaksiController::class, 'update'])->name('transaksi.update');
Route::post('/transaksi/delete', [transaksiController::class, 'delete'])->name('transaksi.delete');
Route::get('/peti-kemas', [petikemascontroller::class, 'index']);
Route::get('/peti-kemas/index', [petikemascontroller::class, 'filter']);
Route::get('/peti-kemas/{id}', [petikemasController::class, 'show'])->name('petikemas.show');
Route::post('/peti-kemas', [petikemascontroller::class, 'storePetiKemas'])->name('petikemas.petikemasstore');
Route::delete('/petikemas/{id}', [petikemasController::class, 'delete'])->name('petikemas.delete');
