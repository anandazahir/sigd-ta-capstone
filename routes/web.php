<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\petikemascontroller;
use App\Http\Controllers\transaksicontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\PengajuanController;
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



Route::get('/', function () {
    if (auth()->check()) {
        // Get the authenticated user
        $user = auth()->user();

        // Assuming you are using a package like Spatie's Laravel-Permission
        $roles = $user->getRoleNames(); // This returns a collection of role names

        // Convert the roles to a string
        $roleString = $roles->implode(','); // Convert collection to comma-separated string if necessary

        // Remove any unwanted characters if necessary
        $cleaned = str_replace(['[', ']', '"'], '', $roleString);

        // Redirect to the appropriate dashboard
        return redirect('/' . $cleaned . '/dashboard');
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
            Route::post('/changefotoprofil', [PegawaiController::class, 'changeprofilpicture'])->name('direktur.pegawai.changeprofilpicture');
            Route::post('/reset-password', [AuthController::class, 'updatepassword'])->name('direktur.pegawai.resetpassword');
            Route::post('/reset-password-pegawai', [PegawaiController::class, 'resetpass'])->name('direktur.pegawai.resetpasswordpegawai');
        });

        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('direktur.notifikasi.index');
            Route::get('/filter', [NotificationController::class, 'filter'])->name('direktur.notifikasi.filter');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('direktur.notifikasi.delete');
        });

        Route::get('/profile', function () {
            return view('pages/profile');
        });

        Route::prefix('pengajuan')->group(function () {
            Route::post('/create', [PengajuanController::class, 'store'])->name('direktur.pengajuan.store');
            Route::post('/edit', [PengajuanController::class, 'edit'])->name('direktur.pengajuan.edit');
        });
        Route::prefix('absensi')->group(function () {
            Route::post('/edit/{id}', [AbsensiController::class, 'update']);
        });
    });
});

// Routes M.Operasional
Route::middleware(['auth', 'role:mops'])->group(function () {
    Route::prefix('mops')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages/dashboard');
        })->name('mops.dashboard');

        Route::prefix('transaksi')->group(function () {
            Route::get('/chart/{month}', [TransaksiController::class, 'getSalesData'])->name('mops.transaksi.chart');
            Route::get('/', [TransaksiController::class, 'index'])->name('mops.transaksi.index');
            Route::get('/index', [TransaksiController::class, 'filter'])->name('mops.transaksi.filter');
            Route::get('/{id}', [TransaksiController::class, 'show'])->name('mops.transaksi.show');
            Route::post('/store', [TransaksiController::class, 'storeEntryData'])->name('mops.transaksi.transaksistore');
            Route::put('/edit/{id}', [TransaksiController::class, 'update'])->name('mops.transaksi.update');
            Route::post('/delete', [TransaksiController::class, 'delete'])->name('mops.transaksi.delete');
            Route::post('/edit/entrydata/{id}', [TransaksiController::class, 'editentrydata'])->name('mops.transaksi.editentrydata');
            Route::post('/deleteentrydata', [TransaksiController::class, 'deleteentrydata'])->name('mops.transaksi.deleteentrydata');
            Route::post('/cetakspk/{id}', [TransaksiController::class, 'cetakspk'])->name('mops.transaksi.cetakspk');
            Route::post('/edit/pembayaran/{id}', [TransaksiController::class, 'editpembayaran'])->name('mops.transaksi.editpembayaran');
            Route::post('/laporantransaksi', [TransaksiController::class, 'laporanbulanantransaksi'])->name('mops.transaksi.laporantransaksi');
            Route::post('/store/pengecekan', [TransaksiController::class, 'storepengecekan'])->name('mops.transaksi.storepengecekan');
            Route::post('/indexkerusakan', [TransaksiController::class, 'indexkerusakan'])->name('mops.transaksi.indexkerusakan');
            Route::post('/editpengecekan', [TransaksiController::class, 'editpengecekan'])->name('mops.transaksi.editpengecekan');
            Route::post('/deletekerusakan', [TransaksiController::class, 'deletekerusakan'])->name('mops.transaksi.deletekerusakan');
            Route::post('/editperbaikan', [TransaksiController::class, 'editperbaikan'])->name('mops.transaksi.editperbaikan');
            Route::post('/editpenempatan/{id}', [TransaksiController::class, 'editpenempatan'])->name('mops.transaksi.editpenempatan');
        });

        Route::prefix('peti-kemas')->group(function () {
            Route::get('/', [PetikemasController::class, 'index'])->name('mops.petikemas.index');
            Route::get('/index', [PetikemasController::class, 'filter'])->name('mops.petikemas.filter');
            Route::get('/{id}', [PetikemasController::class, 'show'])->name('mops.petikemas.show');
            Route::post('/store', [PetikemasController::class, 'storePetiKemas'])->name('mops.petikemas.petikemasstore');
            Route::post('/delete', [PetikemasController::class, 'delete'])->name('mops.petikemas.delete');
            Route::get('/pengecekanhistory/{id}/kerusakan', [PetikemasController::class, 'listkerusakan'])->name('mops.petikemas.listkerusakanhistory');
            Route::post('/pengecekanhistory/deletelistkerusakan', [PetikemasController::class, 'deletelistkerusakan'])->name('mops.petikemas.deletepengecekanhistory');
            Route::post('/pengecekanhistory/filter', [PetikemasController::class, 'filterlistkerusakan'])->name('mops.petikemas.filterpengecekanhistory');
            Route::get('/perbaikanhistory/{id}/kerusakan', [PetikemasController::class, 'listperbaikan'])->name('mops.petikemas.listperbaikanhistory');
            Route::post('/perbaikanhistory/deletelistperbaikan', [PetikemasController::class, 'deletelistperbaikan'])->name(',mopspetikemas.deleteperbaikanhistory');
            Route::post('/perbaikanhistory/filter', [PetikemasController::class, 'filterlistperbaikan'])->name('mops.petikemas.filterperbaikanhistory');
            Route::post('/penempatanhistory/deletelistpenempatan', [PetikemasController::class, 'deletelistpenempatan'])->name('mops.petikemas.deletepenempatanhistory');
            Route::post('/penempatanhistory/filter', [PetikemasController::class, 'filterlistpenempatan'])->name('mops.petikemas.filterpenempatanhistory');
            Route::post('/laporanharian', [PetikemasController::class, 'laporanharian'])->name('mops.petikemas.laporanharian');
        });
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'indexpegawai']);
            Route::post('/changefotoprofil', [PegawaiController::class, 'changeprofilpicture'])->name('mops.pegawai.changeprofilpicture');
            Route::post('/reset-password', [AuthController::class, 'updatepassword'])->name('mops.pegawai.resetpassword');
        });

        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('mops.notifikasi.index');
            Route::get('/filter', [NotificationController::class, 'filter'])->name('mops.notifikasi.filter');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('mops.notifikasi.delete');
        });

        Route::get('/profile', function () {
            return view('pages/profile');
        });
        Route::prefix('pengajuan')->group(function () {
            Route::post('/create', [PengajuanController::class, 'store'])->name('mops.pengajuan.store');
        });
        Route::prefix('absensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'getData'])->name('direktur.absensi');
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
        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('inventory.notifikasi.index');
            Route::get('/filter', [NotificationController::class, 'filter'])->name('inventory.notifikasi.filter');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('inventory.notifikasi.delete');
        });
        Route::get('/profile', function () {
            return view('pages/profile');
        });
        Route::prefix('pengajuan')->group(function () {
            Route::post('/create', [PengajuanController::class, 'store'])->name('inventory.pengajuan.store');
        });
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'indexpegawai']);
            Route::post('/changefotoprofil', [PegawaiController::class, 'changeprofilpicture'])->name('inventory.pegawai.changeprofilpicture');
            Route::post('/reset-password', [AuthController::class, 'updatepassword'])->name('inventory.pegawai.resetpassword');
        });
        Route::prefix('absensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'getData'])->name('direktur.absensi');
        });
    });
});

//Route Survey In
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
        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('surveyin.notifikasi.index');
            Route::get('/filter', [NotificationController::class, 'filter'])->name('surveyin.notifikasi.filter');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('surveyin.notifikasi.delete');
        });
        Route::get('/profile', function () {
            return view('pages/profile');
        });
        Route::prefix('pengajuan')->group(function () {
            Route::post('/create', [PengajuanController::class, 'store'])->name('surveyin.pengajuan.store');
        });
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'indexpegawai']);
            Route::post('/changefotoprofil', [PegawaiController::class, 'changeprofilpicture'])->name('surveyin.pegawai.changeprofilpicture');
            Route::post('/reset-password', [AuthController::class, 'updatepassword'])->name('surveyin.pegawai.resetpassword');
        });
        Route::prefix('absensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'getData'])->name('direktur.absensi');
        });
    });
});

//Route Repair
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
        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('repair.notifikasi.index');
            Route::get('/filter', [NotificationController::class, 'filter'])->name('repair.notifikasi.filter');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('repair.notifikasi.delete');
        });
        Route::get('/profile', function () {
            return view('pages/profile');
        });
        Route::prefix('pengajuan')->group(function () {
            Route::post('/create', [PengajuanController::class, 'store'])->name('repair.pengajuan.store');
        });
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'indexpegawai']);
            Route::post('/changefotoprofil', [PegawaiController::class, 'changeprofilpicture'])->name('repair.pegawai.changeprofilpicture');
            Route::post('/reset-password', [AuthController::class, 'updatepassword'])->name('repair.pegawai.resetpassword');
        });
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
        Route::prefix('absensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'getData'])->name('direktur.absensi');
        });
    });
});

//Route Tally
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
            Route::post('/editpenempatan', [PetikemasController::class, 'editpenempatan'])->name('tally.petikemas.editpenempatan');
            Route::get('/{id}/get-petikemas', [PetikemasController::class, 'getLatestPenempatan']);
        });
        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('tally.notifikasi.index');
            Route::get('/filter', [NotificationController::class, 'filter'])->name('tally.notifikasi.filter');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('tally.notifikasi.delete');
        });
        Route::get('/profile', function () {
            return view('pages/profile');
        });
        Route::prefix('pengajuan')->group(function () {
            Route::post('/create', [PengajuanController::class, 'store'])->name('tally.pengajuan.store');
        });
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'indexpegawai']);
            Route::post('/changefotoprofil', [PegawaiController::class, 'changeprofilpicture'])->name('tally.pegawai.changeprofilpicture');
            Route::post('/reset-password', [AuthController::class, 'updatepassword'])->name('tally.pegawai.resetpassword');
        });
        Route::prefix('absensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'getData'])->name('direktur.absensi');
        });
    });
});

//Route Kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::prefix('kasir')->group(function () {
        Route::get('/dashboard', function () {
            return view('pages/dashboard');
        })->name('kasir.dashboard');
        Route::prefix('pembayaran')->group(function () {
            Route::get('/', [TransaksiController::class, 'indexKasir'])->name('kasir.transaksi.index');
            Route::get('/index', [TransaksiController::class, 'filterKasir'])->name('kasir.transaksi.filter');
            Route::get('/{id}', [TransaksiController::class, 'kasirShow'])->name('kasir.transaksi.show');
            Route::post('/edit/pembayaran/{id}', [TransaksiController::class, 'editpembayaran'])->name('kasir.transaksi.editpembayaran');
        });

        Route::prefix('notifikasi')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('kasir.notifikasi.index');
            Route::get('/filter', [NotificationController::class, 'filter'])->name('kasir.notifikasi.filter');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('kasir.notifikasi.delete');
        });
        Route::get('/profile', function () {
            return view('pages/profile');
        });
        Route::prefix('pengajuan')->group(function () {
            Route::post('/create', [PengajuanController::class, 'store'])->name('kasir.pengajuan.store');
        });
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'indexpegawai']);
            Route::post('/changefotoprofil', [PegawaiController::class, 'changeprofilpicture'])->name('kasir.pegawai.changeprofilpicture');
            Route::post('/reset-password', [AuthController::class, 'updatepassword'])->name('kasir.pegawai.resetpassword');
        });
        Route::prefix('absensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'getData'])->name('direktur.absensi');
        });;
    });
});
