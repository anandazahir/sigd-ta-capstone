<?php

use App\Http\Controllers\petikemascontroller;
use App\Http\Controllers\transaksicontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('peti-kemas/test/{id}', [PetikemasController::class, 'showpetikemas'])->name('direktur.transaksi.index');

Route::get('/', function () {
    if (auth()->check()) {

        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes Direktur
Route::middleware(['auth', 'role:direktur'])->group(function () {
    Route::prefix('direktur')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages/dashboard');
        })->name('direktur.dashboard');

        Route::prefix('transaksi')->group(function () {
            Route::get('/chart/{month}', [TransaksiController::class, 'getSalesData'])->name('direktur.transaksi.chart');
            Route::get('/', [TransaksiController::class, 'index'])->name('direktur.transaksi.index');
            Route::get('/index', [TransaksiController::class, 'filter'])->name('direktur.transaksi.filter');
            Route::get('/{id}', [TransaksiController::class, 'show'])->name('direktur.transaksi.show');
            Route::post('/store', [TransaksiController::class, 'storeEntryData'])->name('direktur.transaksi.transaksistore');
            Route::put('/edit/{id}', [TransaksiController::class, 'update'])->name('direktur.transaksi.update');
            Route::post('/delete', [TransaksiController::class, 'delete'])->name('direktur.transaksi.delete');
            Route::post('/edit/entrydata/{id}', [TransaksiController::class, 'editentrydata'])->name('direktur.transaksi.editentrydata');
            Route::post('/deleteentrydata', [TransaksiController::class, 'deleteentrydata'])->name('direktur.transaksi.deleteentrydata');
            Route::post('/cetakspk/{id}', [TransaksiController::class, 'cetakspk'])->name('direktur.transaksi.cetakspk');
            Route::post('/edit/pembayaran/{id}', [TransaksiController::class, 'editpembayaran'])->name('direktur.transaksi.editpembayaran');
            Route::post('/laporantransaksi', [TransaksiController::class, 'laporanbulanantransaksi'])->name('direktur.transaksi.laporantransaksi');
            Route::post('/store/pengecekan', [TransaksiController::class, 'storepengecekan'])->name('direktur.transaksi.storepengecekan');
            Route::post('/indexkerusakan', [TransaksiController::class, 'indexkerusakan'])->name('direktur.transaksi.indexkerusakan');
            Route::post('/editpengecekan', [TransaksiController::class, 'editpengecekan'])->name('direktur.transaksi.editpengecekan');
            Route::post('/deletekerusakan', [TransaksiController::class, 'deletekerusakan'])->name('direktur.transaksi.deletekerusakan');
            Route::post('/editperbaikan', [TransaksiController::class, 'editperbaikan'])->name('direktur.transaksi.editperbaikan');
            Route::post('/editpenempatan/{id}', [TransaksiController::class, 'editpenempatan'])->name('direktur.transaksi.editpenempatan');
        });

        Route::prefix('peti-kemas')->group(function () {
            Route::get('/', [PetikemasController::class, 'index'])->name('direktur.petikemas.index');
            Route::get('/index', [PetikemasController::class, 'filter'])->name('direktur.petikemas.filter');
            Route::get('/{id}', [PetikemasController::class, 'show'])->name('direktur.petikemas.show');
            Route::post('/store', [PetikemasController::class, 'storePetiKemas'])->name('direktur.petikemas.petikemasstore');
            Route::post('/delete', [PetikemasController::class, 'delete'])->name('direktur.petikemas.delete');
            Route::get('/pengecekanhistory/{id}/kerusakan', [PetikemasController::class, 'listkerusakan'])->name('direktur.petikemas.listkerusakanhistory');
            Route::post('/pengecekanhistory/deletelistkerusakan', [PetikemasController::class, 'deletelistkerusakan'])->name('direktur.petikemas.deletepengecekanhistory');
            Route::post('/pengecekanhistory/filter', [PetikemasController::class, 'filterlistkerusakan'])->name('direktur.petikemas.filterpengecekanhistory');
            Route::get('/perbaikanhistory/{id}/kerusakan', [PetikemasController::class, 'listperbaikan'])->name('direktur.petikemas.listperbaikanhistory');
            Route::post('/perbaikanhistory/deletelistperbaikan', [PetikemasController::class, 'deletelistperbaikan'])->name(',direkturpetikemas.deleteperbaikanhistory');
            Route::post('/perbaikanhistory/filter', [PetikemasController::class, 'filterlistperbaikan'])->name('direktur.petikemas.filterperbaikanhistory');
            Route::post('/penempatanhistory/deletelistpenempatan', [PetikemasController::class, 'deletelistpenempatan'])->name('direktur.petikemas.deletepenempatanhistory');
            Route::post('/penempatanhistory/filter', [PetikemasController::class, 'filterlistpenempatan'])->name('direktur.petikemas.filterpenempatanhistory');
            Route::post('/laporanharian', [PetikemasController::class, 'laporanharian'])->name('direktur.petikemas.laporanharian');
        });
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'index'])->name('direktur.pegawai.index');
            Route::get('/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
            Route::post('/store', [PegawaiController::class, 'store'])->name('pegawai.store');
            Route::put('/edit/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
            Route::post('/delete', [PegawaiController::class, 'delete'])->name('pegawai.delete');
            Route::post('/index', [PegawaiController::class, 'filter'])->name('pegawai.filter');
        });

        Route::get('/notification', function () {
            return view('pages/notification');
        });
        Route::get('/profile', function () {
            return view('pages/profile');
        });
    });
});

//Route Inventory
Route::middleware(['auth', 'role:inventory'])->group(function () {
    Route::prefix('inventory')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages/dashboard');
        })->name('inventory.dashboard');
        Route::prefix('entry-data')->group(function () {
            Route::get('/', [TransaksiController::class, 'entryData'])->name('inventory.transaksi.index');
            Route::get('/index', [TransaksiController::class, 'filter'])->name('inventory.transaksi.filter');
            Route::get('/{id}', [TransaksiController::class, 'entryDataShow'])->name('inventory.transaksi.show');
            Route::post('/store', [TransaksiController::class, 'storeEntryData'])->name('inventory.transaksi.transaksistore');
            Route::post('/cetakspk/{id}', [TransaksiController::class, 'cetakspk'])->name('inventory.transaksi.cetakspk');
        });
        Route::prefix('peti-kemas')->group(function () {
            Route::get('/', [PetikemasController::class, 'index'])->name('inventory.petikemas.index');
            Route::get('/index', [PetikemasController::class, 'filter'])->name('inventory.petikemas.filter');
            Route::get('/{id}', [PetikemasController::class, 'show'])->name('inventory.petikemas.show');
            Route::get('/pengecekanhistory/{id}/kerusakan', [PetikemasController::class, 'listkerusakan'])->name('inventory.petikemas.listkerusakanhistory');
            Route::post('/pengecekanhistory/filter', [PetikemasController::class, 'filterlistkerusakan'])->name('inventory.petikemas.filterpengecekanhistory');
            Route::get('/perbaikanhistory/{id}/kerusakan', [PetikemasController::class, 'listperbaikan'])->name('inventory.petikemas.listperbaikanhistory');
            Route::post('/perbaikanhistory/filter', [PetikemasController::class, 'filterlistperbaikan'])->name('inventory.petikemas.filterperbaikanhistory');
            Route::post('/penempatanhistory/filter', [PetikemasController::class, 'filterlistpenempatan'])->name('inventory.petikemas.filterpenempatanhistory');
            Route::post('/laporanharian', [PetikemasController::class, 'laporanharian'])->name('inventory.petikemas.laporanharian');
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
        });;
    });
});

Route::middleware(['auth', 'role:surveyin'])->group(function () {
    Route::prefix('surveyin')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages/dashboard');
        })->name('surveyin.dashboard');
        Route::prefix('pengecekan')->group(function () {
            Route::get('/', [TransaksiController::class, 'pengecekan'])->name('pengecekan.index');
            Route::get('/index', [TransaksiController::class, 'indexpengecekan']);
            Route::get('/{id}', [TransaksiController::class, 'pengecekanShow']);
            Route::post('/store/pengecekan', [TransaksiController::class, 'storepengecekan'])->name('surveyin.transaksi.storepengecekan');
            Route::post('/deletekerusakan', [TransaksiController::class, 'deletekerusakan'])->name('surveyin.transaksi.deletekerusakan');
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
        });;
    });
});

Route::middleware(['auth', 'role:repair'])->group(function () {
    Route::prefix('repair')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages/dashboard');
        })->name('repair.dashboard');
        Route::prefix('perbaikan')->group(function () {
            Route::get('/', [TransaksiController::class, 'perbaikan'])->name('perbaikan.index');
            Route::get('/index', [TransaksiController::class, 'indexperbaikan']);
            Route::get('/{id}', [TransaksiController::class, 'perbaikanShow']);
            Route::post('/editperbaikan', [TransaksiController::class, 'editperbaikan'])->name('repair.transaksi.editperbaikan');
            Route::post('/deletekerusakan', [TransaksiController::class, 'deletekerusakan'])->name('repair.transaksi.deletekerusakan');
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
        });;
        Route::prefix('peti-kemas')->group(function () {
            Route::get('/', [PetikemasController::class, 'index'])->name('repair.petikemas.index');
            Route::get('/index', [PetikemasController::class, 'filter'])->name('repair.petikemas.filter');
            Route::get('/{id}', [PetikemasController::class, 'show'])->name('repair.petikemas.show');
            Route::get('/pengecekanhistory/{id}/kerusakan', [PetikemasController::class, 'listkerusakan'])->name('repair.petikemas.listkerusakanhistory');
            Route::post('/pengecekanhistory/filter', [PetikemasController::class, 'filterlistkerusakan'])->name('repair.petikemas.filterpengecekanhistory');
            Route::get('/perbaikanhistory/{id}/kerusakan', [PetikemasController::class, 'listperbaikan'])->name('repair.petikemas.listperbaikanhistory');
            Route::post('/perbaikanhistory/filter', [PetikemasController::class, 'filterlistperbaikan'])->name('repair.petikemas.filterperbaikanhistory');
            Route::post('/penempatanhistory/filter', [PetikemasController::class, 'filterlistpenempatan'])->name('repair.petikemas.filterpenempatanhistory');
            Route::post('/laporanharian', [PetikemasController::class, 'laporanharian'])->name('repair.petikemas.laporanharian');
        });
    });
});

Route::middleware(['auth', 'role:tally'])->group(function () {
    Route::prefix('tally')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages/dashboard');
        })->name('tally.dashboard');
    
        Route::prefix('peti-kemas')->group(function () {
            Route::get('/', [PetikemasController::class, 'index'])->name('tally.petikemas.index');
            Route::get('/index', [PetikemasController::class, 'filter'])->name('tally.petikemas.filter');
            Route::get('/{id}', [PetikemasController::class, 'show'])->name('tally.petikemas.show');
            Route::get('/pengecekanhistory/{id}/kerusakan', [PetikemasController::class, 'listkerusakan'])->name('tally.petikemas.listkerusakanhistory');
            Route::post('/pengecekanhistory/filter', [PetikemasController::class, 'filterlistkerusakan'])->name('tally.petikemas.filterpengecekanhistory');
            Route::get('/perbaikanhistory/{id}/kerusakan', [PetikemasController::class, 'listperbaikan'])->name('tally.petikemas.listperbaikanhistory');
            Route::post('/perbaikanhistory/filter', [PetikemasController::class, 'filterlistperbaikan'])->name('tally.petikemas.filterperbaikanhistory');
            Route::post('/penempatanhistory/filter', [PetikemasController::class, 'filterlistpenempatan'])->name('tally.petikemas.filterpenempatanhistory');
            Route::post('/editpenempatan/{id}', [TransaksiController::class, 'editpenempatan'])->name('tally.transaksi.editpenempatan');
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
        });;
    });
});