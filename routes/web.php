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
Route::get('/transaksi', function () {
    return view('pages/transaksi');
});

Route::get('/petikemas', [petikemascontroller::class, 'index']);
Route::get('/transaksi', [transaksicontroller::class, 'index']);
Route::get('/transaksi/{id}', [transaksiController::class, 'show'])->name('transaksi.show');
Route::get('/petikemas/more', function () {
    return view('pages/petikemas-more');
});
