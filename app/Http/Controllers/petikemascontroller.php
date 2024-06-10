<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\petikemas;
use App\Models\kerusakan;
use App\Models\kerusakanhistory;
use App\Models\penempatan;
use App\Models\penempatanhistory;
use App\Models\pengecekan;
use App\Models\pengecekanhistory;
use App\Models\perbaikan;
use App\Models\perbaikanhistory;
use App\Models\transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class petikemascontroller extends Controller
{
    public function index()
    {
        $petikemas = petikemas::all();

        // Total sums
        $totalIn = $petikemas->where('status_ketersediaan', 'in')->count();
        $totalOut = $petikemas->where('status_ketersediaan', 'out')->count();
        $totalAvailable = $petikemas->where('status_kondisi', 'available')->count();
        $totalDamage = $petikemas->where('status_kondisi', 'damage')->count();

        // Current date
        $today = Carbon::today();

        // Total Hari Ini
        $todayIn = $petikemas->where('status_ketersediaan', 'in')->where('updated_at', '>=', $today)->count();
        $todayOut = $petikemas->where('status_ketersediaan', 'out')->where('updated_at', '>=', $today)->count();
        $todayAvailable = $petikemas->where('status_kondisi', 'available')->where('updated_at', '>=', $today)->count();
        $todayDamage = $petikemas->where('status_kondisi', 'damage')->where('updated_at', '>=', $today)->count();

        // Current week sums
        $currentWeek = Carbon::now()->startOfWeek();
        $weekIn = $petikemas->where('status_ketersediaan', 'in')->where('updated_at', '>=', $currentWeek)->count();
        $weekOut = $petikemas->where('status_ketersediaan', 'out')->where('updated_at', '>=', $currentWeek)->count();
        $weekAvailable = $petikemas->where('status_kondisi', 'available')->where('updated_at', '>=', $currentWeek)->count();
        $weekDamage = $petikemas->where('status_kondisi', 'damage')->where('updated_at', '>=', $currentWeek)->count();

        // Current month sums
        $currentMonth = Carbon::now()->startOfMonth();
        $monthIn = $petikemas->where('status_ketersediaan', 'in')->where('updated_at', '>=', $currentMonth)->count();
        $monthOut = $petikemas->where('status_ketersediaan', 'out')->where('updated_at', '>=', $currentMonth)->count();
        $monthAvailable = $petikemas->where('status_kondisi', 'available')->where('updated_at', '>=', $currentMonth)->count();
        $monthDamage = $petikemas->where('status_kondisi', 'damage')->where('updated_at', '>=', $currentMonth)->count();

        return view('pages.petikemas', compact(
            'totalIn',
            'totalOut',
            'totalAvailable',
            'totalDamage',
            'todayIn',
            'todayOut',
            'todayAvailable',
            'todayDamage',
            'weekIn',
            'weekOut',
            'weekAvailable',
            'weekDamage',
            'monthIn',
            'monthOut',
            'monthAvailable',
            'monthDamage'
        ));
    }
    public function show($id)
    {
        $petikemas = Petikemas::with([
            'pengecekanhistories' => function ($query) {
                $query->whereNotNull('survey_in'); // Replace 'some_field' with the actual field name you want to check for null
            },
            'perbaikanhistories' => function ($query) {
                $query->whereNotNull('repair'); // Replace 'some_field' with the actual field name you want to check for null
            },
            'penempatanhistories' => function ($query) {
                $query->whereNotNull('tally'); // Replace 'some_field' with the actual field name you want to check for null
            },
        ])->findOrFail($id);

        return view('pages.petikemas-more', compact('petikemas'));
    }

    public function listkerusakan($id)
    {
        $kerusakanhistories = kerusakanhistory::where('id_pengecekanhistory', $id)->get();
        return response()->json($kerusakanhistories);
    }

    public function deletelistkerusakan(Request $request)
    {
        $pengecekanhistory = pengecekanhistory::findOrFail($request->id);
        // Hapus data terkait di tabel kerusakanhistories
        $kerusakanhistory = kerusakanhistory::where('id_pengecekanhistory', $pengecekanhistory->id)->get();
        foreach ($kerusakanhistory as $item) {
            $item->delete();
        }

        // Hapus data pengecekanhistory
        $pengecekanhistory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Riwayat Pengecekan Berhasil Dihapus!',
        ]);
    }

    public function filterlistkerusakan(Request $request)
    {
        $selectedDate = $request->input('tanggal_pengecekanhistory');

        $query = pengecekanhistory::query();

        if ($selectedDate) {
            $query->whereDate('tanggal_pengecekan', $selectedDate);
        }

        $filteredData = $query->get();

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData,
        ]);
    }

    public function listperbaikan($id)
    {
        $perbaikanhistories = kerusakanhistory::where('id_perbaikanhistory', $id)->get();
        return response()->json($perbaikanhistories);
    }

    public function deletelistperbaikan(Request $request)
    {
        $perbaikanhistory = perbaikanhistory::findOrFail($request->id);
        // Hapus data terkait di tabel kerusakanhistories
        $kerusakanhistory = kerusakanhistory::where('id_perbaikanhistory', $perbaikanhistory->id)->get();
        foreach ($kerusakanhistory as $item2) {
            $item2->delete();
        }

        // Hapus data perbaikanhistory
        $perbaikanhistory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Riwayat Perbaikan Berhasil Dihapus!',
        ]);
    }

    public function filterlistperbaikan(Request $request)
    {
        $selectedDate = $request->input('tanggal_perbaikanhistory');

        $query = perbaikanhistory::query();

        if ($selectedDate) {
            $query->whereDate('tanggal_perbaikan', $selectedDate);
        }

        $filteredData = $query->get();

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData,
        ]);
    }

    public function deletelistpenempatan(Request $request)
    {
        // Cari dan hapus data berdasarkan id yang diterima dari request
        $penempatanhistory = penempatanHistory::findOrFail($request->id);

        // Hapus data yang ditemukan
        $penempatanhistory->delete();

        // Kembalikan response json sebagai tanda berhasil
        return response()->json([
            'success' => true,
            'message' => 'Data Riwayat Penempatan Berhasil Dihapus!',
        ]);
    }


    public function filterlistpenempatan(Request $request)
    {
        $selectedDate = $request->input('tanggal_penempatanhistory');

        $query = penempatanhistory::query();

        if ($selectedDate) {
            $query->whereDate('tanggal_penempatan', $selectedDate);
        }

        $filteredData = $query->get();

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData,
        ]);
    }

    public function storePetiKemas(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'no_petikemas' => 'required|unique:petikemas',
            'jenis_ukuran' => 'required',
            'pelayaran' => 'required',

        ]);
        if ($Validator->fails()) {
            return response()->json(['errors' => $Validator->errors()], 422);
        }
        $jenis_ukuran = $request->jenis_ukuran;
        $hargasesuaijenis = 0;
        if (strpos($jenis_ukuran, "20") !== false) {
            $hargasesuaijenis = 255000;
        } elseif (strpos($jenis_ukuran, "40") !== false || (strpos($jenis_ukuran, "45")) !== false) {
            $hargasesuaijenis = 345000;
        }
        $harga = 25000 + $hargasesuaijenis + (0.1 * $hargasesuaijenis);

        $petikemas = new Petikemas();
        $petikemas->no_petikemas = $request->no_petikemas;
        $petikemas->jenis_ukuran = $request->jenis_ukuran;
        $petikemas->pelayaran = $request->pelayaran;
        $petikemas->tanggal_keluar = null;
        $petikemas->tanggal_masuk = now();
        $petikemas->harga = $harga;
        $petikemas->status_ketersediaan = "in";
        $petikemas->status_kondisi = "available";
        $petikemas->status_order = "true";
        $petikemas->lokasi = "pending";

        $petikemas->save();



        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Dibuat!',
        ]);
    }

    public function delete(Request $request)
    {

        $petikemas = petikemas::findOrFail($request->id);
        $petikemas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Dihapus!',
        ]);
    }


    public function filter(Request $request)
    {

        $searchTerm = $request->input('search');
        $idpetikemas = $request->input('id');
        $jenis_transaksi = $request->input('jenis_transaksi');
        $condition = $request->input('condition');
        $blok = $request->input('blok');
        $row = $request->input('row');
        $tier = $request->input('tier');
        $query = petikemas::query();
        if ($idpetikemas) {
            $petikemas = Petikemas::where('id', $request->id)->get();
            return response()->json([
                'DataPetikemas' => $petikemas,
            ]);
        }
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('no_petikemas', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jenis_ukuran', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pelayaran', 'like', '%' . $searchTerm . '%');
            });
        }
        if ($jenis_transaksi == 'impor') {
            $query->where('status_ketersediaan', 'out')->where('status_order', 'true');
        } else  if ($jenis_transaksi == 'ekspor') {
            $query->where('status_ketersediaan', 'in')->where('status_order', 'true');
        }
        if ($condition == 'available' || $condition == 'damage') {
            $query->where('status_kondisi', $condition);
        } else if ($condition == 'out' || $condition == 'in') {
            $query->where('status_ketersediaan', $condition);
        } else if ($condition == 'petikemas-tidak-dipesan') {
            $query->where('status_order', 'true');
        } else if ($condition == 'petikemas-dipesan') {
            $query->where('status_order', 'false');
        } else if ($condition == 'pending') {
            $query->where('lokasi', $condition);
        }
        if ($blok) {
            $query->where('lokasi', $blok);
        }
        if ($row) {
            $query->where('lokasi', $row);
        }
        if ($tier) {
            $query->where('lokasi', $tier);
        }
        $data = $query->get();
        $perPage = 3;
        $filteredData = $query->paginate($perPage);

        if ($filteredData->isEmpty()) {
            $jenis_transaksi = $request->input('jenis_transaksi');
            return response()->json(['message' => 'No data found', 'test' => $jenis_transaksi]);
        }
        return response()->json([
            'Data' => $filteredData->items(),
            'AllData' => $data,
            'meta' => [
                'current_page' => $filteredData->currentPage(),
                'last_page' => $filteredData->lastPage(),
                'per_page' => $filteredData->perPage(),
            ],
            'count' => $filteredData->total(),
        ]);
    }
    public  function laporanharian(Request $request)
    {
        $condition = $request->input('condition');
        $query = petikemas::query();
        if ($condition == 'available' || $condition == 'damage') {
            $query->where('status_kondisi', $condition);
        } else if ($condition == 'out' || $condition == 'in') {
            $query->where('status_ketersediaan', $condition);
        } else if ($condition == 'petikemas-tidak-dipesan') {
            $query->where('status_order', 'true');
        } else if ($condition == 'petikemas-dipesan') {
            $query->where('status_order', 'false');
        } else if ($condition == 'pending') {
            $query->where('lokasi', $condition);
        }
        $data = $query->get();
        $pdf = Pdf::loadView('pdf.laporanharianpetikemas', [
            'selectedValue' => $condition,
            'petikemas' => $data,
        ]);

        return $pdf->download('laporan_harian_petikemas.pdf');
    }
}
