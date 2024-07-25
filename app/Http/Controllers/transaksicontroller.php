<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Kerusakanhistory;
use App\Models\Pembayaran;
use App\Models\Penempatan;
use App\Models\penempatanhistory;
use App\Models\Pengecekan;
use App\Models\pengecekanhistory;
use App\Models\Penghubung;
use App\Models\Perbaikan;
use App\Models\notifikasi;
use App\Models\perbaikanhistory;
use App\Models\petikemas;
use App\Models\User;
use DateTime;
use Carbon\Carbon;
use App\Rules\RequiredArrayValuesFoto;
use App\Rules\UniqueArrayValueFoto;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;
use App\Rules\UniqueArrayValues;
use App\Rules\RequiredArrayValues;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = transaksi::all();
        $totaltransaksi = count($transaksi);
        $totaltransaksiimpor = count($transaksi->where('jenis_kegiatan', 'impor'));
        $totaltransaksiekspor = count($transaksi->where('jenis_kegiatan', 'ekspor'));
        $totalHarga = 0;
        foreach ($transaksi as $transaksis) {
            // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'lunas' and date conditions
            $lunasPenghubungs = $transaksis->penghubungs()->whereHas('pembayaran', function ($query) {
                $query->where('status_pembayaran', 'sudah lunas')
                    ->whereYear('tanggal_pembayaran', date('Y'))  // Current year
                    ->whereMonth('tanggal_pembayaran', date('m')); // Current month
            })->with('petikemas')->get();
            // Extract and sum the harga values from the related petikemas models for each transaksi
            $totalHarga += $lunasPenghubungs->pluck('petikemas.harga')->sum();
        }

        return view('pages.transaksi', compact('transaksi', 'totaltransaksi', 'totaltransaksiekspor', 'totaltransaksiimpor', 'totalHarga'));
    }

    public function indexpengecekan(Request $request)
    {
        $transaksiCollection = collect(); // Inisialisasi koleksi kosong
        $searchTerm = $request->input('search');

        // Ambil semua transaksi dengan jenis_kegiatan 'impor'
        $transaksi = Transaksi::where('jenis_kegiatan', 'impor')->get();

        foreach ($transaksi as $transaksis) {
            // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
            $lunasPenghubungs = $transaksis->penghubungs()->whereHas('pembayaran', function ($query) {
                $query->where('status_cetak_spk', 'sudah cetak');
            })->whereHas('petikemas', function ($query) {
                $query->where('status_order', 'false'); // Ganti 'false' dengan nilai yang sesuai
            })->get();

            // Jika ada penghubung yang memenuhi syarat, tambahkan transaksi ke koleksi
            if ($lunasPenghubungs->isNotEmpty()) {
                $transaksiCollection->push($transaksis);
            }
        }

        if ($searchTerm) {
            $transaksiCollection = $transaksiCollection->filter(function ($item) use ($searchTerm) {
                return strpos($item->no_transaksi, $searchTerm) !== false ||
                    strpos($item->jenis_kegiatan, $searchTerm) !== false ||
                    strpos($item->no_do, $searchTerm) !== false ||
                    strpos($item->perusahaan, $searchTerm) !== false ||
                    strpos($item->jumlah_petikemas, $searchTerm) !== false ||
                    strpos($item->kapal, $searchTerm) !== false ||
                    strpos($item->emkl, $searchTerm) !== false;
            });
        }

        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $transaksiCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $filteredData = new LengthAwarePaginator($currentPageItems, $transaksiCollection->count(), $perPage, $currentPage);

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData->items(),
            'Count' => $filteredData->total(),
            'meta' => [
                'current_page' => $filteredData->currentPage(),
                'last_page' => $filteredData->lastPage(),
                'per_page' => $filteredData->perPage(),
            ],
        ]);
    }

    public function indexKasir()
    {
        $transaksi = transaksi::all();
        $totaltransaksiimpor = count($transaksi->where('jenis_kegiatan', 'impor'));
        $totaltransaksiekspor = count($transaksi->where('jenis_kegiatan', 'ekspor'));

        return view('pages.kasir.pembayaran', compact('totaltransaksiimpor', 'totaltransaksiekspor'));
    }
    public function kasirShow($id)
    {
        $transaksi = Transaksi::with('penghubungs.petikemas')->findOrFail($id);
        return view('pages.kasir.pembayaran-more', compact('transaksi'));
    }
    public function filterKasir(Request $request)
    {
        $transaksiCollection = collect(); // Inisialisasi koleksi kosong
        $searchTerm = $request->input('search');
        $filtervalue = $request->input('filter');
        // Ambil semua transaksi dengan jenis_kegiatan 'impor'
        $transaksi = Transaksi::all();

        foreach ($transaksi as $transaksis) {
            // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
            $lunasPenghubungs = $transaksis->penghubungs()->whereHas('pembayaran', function ($query) {
                $query->where('status_pembayaran', 'belum lunas');
            })->whereHas('petikemas', function ($query) {
                $query->where('status_order', 'false'); // Ganti 'false' dengan nilai yang sesuai
            })->get();

            // Jika ada penghubung yang memenuhi syarat, tambahkan transaksi ke koleksi
            if ($lunasPenghubungs->isNotEmpty()) {
                $transaksiCollection->push($transaksis);
            }
        }

        if ($searchTerm) {
            $transaksiCollection = $transaksiCollection->filter(function ($item) use ($searchTerm) {
                return strpos($item->no_transaksi, $searchTerm) !== false ||
                    strpos($item->jenis_kegiatan, $searchTerm) !== false ||
                    strpos($item->no_do, $searchTerm) !== false ||
                    strpos($item->perusahaan, $searchTerm) !== false ||
                    strpos($item->jumlah_petikemas, $searchTerm) !== false ||
                    strpos($item->kapal, $searchTerm) !== false ||
                    strpos($item->emkl, $searchTerm) !== false;
            });
        }

        if ($filtervalue) {
            $transaksiCollection = $transaksiCollection->filter(function ($item) use ($filtervalue) {
                return strpos($item->jenis_kegiatan, $filtervalue) !== false;
            });
        }
        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $transaksiCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $filteredData = new LengthAwarePaginator($currentPageItems, $transaksiCollection->count(), $perPage, $currentPage);

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData->items(),
            'Count' => $filteredData->total(),
            'meta' => [
                'current_page' => $filteredData->currentPage(),
                'last_page' => $filteredData->lastPage(),
                'per_page' => $filteredData->perPage(),
            ],
        ]);
    }

    public function pengecekanShow($id)
    {
        $transaksi = Transaksi::with('penghubungs.petikemas')->findOrFail($id);
        $user = user::all();
        return view('pages.survey in.pengecekan-more', compact('transaksi', 'user'));
    }

    public function pengecekan()
    {
        $transaksiCollection = collect(); // Inisialisasi koleksi kosong
        $transaksi = transaksi::where('jenis_kegiatan', 'impor')->get();

        foreach ($transaksi as $transaksis) {
            // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
            $lunasPenghubungs = $transaksis->penghubungs()->whereHas('pembayaran', function ($query) {
                $query->where('status_pembayaran', 'belum lunas');
            })->whereHas('petikemas', function ($query) {
                $query->where('status_order', 'false'); // Ganti 'false' dengan nilai yang sesuai
            })->get();

            // Jika ada penghubung yang memenuhi syarat, tambahkan transaksi ke koleksi
            if ($lunasPenghubungs->isNotEmpty()) {
                $transaksiCollection->push($transaksis);
            }
        }
        $totaltransaksilunas = $transaksiCollection->count();

        return view('pages.survey in.pengecekan', compact('totaltransaksilunas'));
    }

    public function indexperbaikan(Request $request)
    {
        $transaksiCollection = collect(); // Inisialisasi koleksi kosong
        $searchTerm = $request->input('search');

        // Ambil semua transaksi dengan jenis_kegiatan 'impor'
        $transaksi = Transaksi::where('jenis_kegiatan', 'impor')->get();

        foreach ($transaksi as $transaksis) {
            // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
            $lunasPenghubungs = $transaksis->penghubungs()->whereHas('pembayaran', function ($query) {
                $query->where('status_cetak_spk', 'sudah cetak');
            })->whereHas('petikemas', function ($query) {
                $query->where('status_order', 'false')->where('status_kondisi', 'damage'); // Ganti 'false' dengan nilai yang sesuai
            })->get();

            // Jika ada penghubung yang memenuhi syarat, tambahkan transaksi ke koleksi
            if ($lunasPenghubungs->isNotEmpty()) {
                $transaksiCollection->push($transaksis);
            }
        }

        if ($searchTerm) {
            $transaksiCollection = $transaksiCollection->filter(function ($item) use ($searchTerm) {
                return strpos($item->no_transaksi, $searchTerm) !== false ||
                    strpos($item->jenis_kegiatan, $searchTerm) !== false ||
                    strpos($item->no_do, $searchTerm) !== false ||
                    strpos($item->perusahaan, $searchTerm) !== false ||
                    strpos($item->jumlah_petikemas, $searchTerm) !== false ||
                    strpos($item->kapal, $searchTerm) !== false ||
                    strpos($item->emkl, $searchTerm) !== false;
            });
        }

        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $transaksiCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $filteredData = new LengthAwarePaginator($currentPageItems, $transaksiCollection->count(), $perPage, $currentPage);

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData->items(),
            'Count' => $filteredData->total(),
            'meta' => [
                'current_page' => $filteredData->currentPage(),
                'last_page' => $filteredData->lastPage(),
                'per_page' => $filteredData->perPage(),
            ],
        ]);
    }

    public function perbaikanShow($id)
    {
        $transaksi = Transaksi::with('penghubungs.petikemas')->findOrFail($id);
        $user = user::all();
        return view('pages.repair.perbaikan-more', compact('transaksi', 'user'));
    }

    public function perbaikan()
    {
        $transaksiCollection = collect(); // Inisialisasi koleksi kosong
        $transaksi = transaksi::where('jenis_kegiatan', 'impor')->get();

        foreach ($transaksi as $transaksis) {
            // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
            $lunasPenghubungs = $transaksis->penghubungs()->whereHas('pembayaran', function ($query) {
                $query->where('status_cetak_spk', 'sudah cetak');
            })->whereHas('petikemas', function ($query) {
                $query->where('status_order', 'false')->where('status_kondisi', 'damage'); // Ganti 'false' dengan nilai yang sesuai
            })->get();

            // Jika ada penghubung yang memenuhi syarat, tambahkan transaksi ke koleksi
            if ($lunasPenghubungs->isNotEmpty()) {
                $transaksiCollection->push($transaksis);
            }
        }
        $totalperbaikanpetikemas = $transaksiCollection->count();

        return view('pages.repair.perbaikan', compact('totalperbaikanpetikemas'));
    }
    public function entryData()
    {
        $transaksi = transaksi::all();
        $totaltransaksiimpor = count($transaksi->where('jenis_kegiatan', 'impor'));
        $totaltransaksiekspor = count($transaksi->where('jenis_kegiatan', 'ekspor'));

        return view('pages.inventory.entry-data', compact('totaltransaksiimpor', 'totaltransaksiekspor'));
    }
    public function entryDataShow($id)
    {
        $transaksi = Transaksi::with('penghubungs.petikemas')->findOrFail($id);
        return view('pages.inventory.entry-data-more', compact('transaksi'));
    }
    public function show($id)
    {
        $user = User::all();
        $transaksi = Transaksi::with('penghubungs.petikemas')->findOrFail($id);
        return view('pages.transaksi-more', compact('transaksi', 'user'));
    }
    public function getSalesData($month)
    {
        // Get the current month
        $currentMonth = date('n'); // n for numeric month without leading zeros
        $currentYear = date('Y');
        $dataImpor = [];
        $dataEkspor = [];

        // Retrieve all Transaksi instances once
        $transaksiCollectionImpor = Transaksi::where('jenis_kegiatan', 'impor')->get();
        $transaksiCollectionEkspor = Transaksi::where('jenis_kegiatan', 'ekspor')->get();
        if ($month === 'all') {
            for ($i = 1; $i <= $currentMonth; $i++) {
                $totalpetikemasImpor = 0;
                $totalpetikemasEkspor = 0;

                foreach ($transaksiCollectionImpor as $transaksi) {
                    // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
                    $lunasPenghubungs = $transaksi->penghubungs()->whereHas('pembayaran', function ($query) use ($currentYear, $i) {
                        $query->where('status_pembayaran', 'sudah lunas')
                            ->whereYear('tanggal_pembayaran', $currentYear)
                            ->whereMonth('tanggal_pembayaran', $i);
                    })->with('petikemas')->get();

                    // Sum the harga values from the related petikemas models for each transaksi
                    $totalpetikemasImpor += $lunasPenghubungs->pluck('petikemas')->count();
                }
                foreach ($transaksiCollectionEkspor as $transaksi) {
                    // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
                    $lunasPenghubungs = $transaksi->penghubungs()->whereHas('pembayaran', function ($query) use ($currentYear, $i) {
                        $query->where('status_pembayaran', 'sudah lunas')
                            ->whereYear('tanggal_pembayaran', $currentYear)
                            ->whereMonth('tanggal_pembayaran', $i);
                    })->with('petikemas')->get();

                    // Sum the harga values from the related petikemas models for each transaksi
                    $totalpetikemasEkspor += $lunasPenghubungs->pluck('petikemas')->count();
                }
                // Store the total harga for the current month
                $dataImpor[Carbon::create()->month($i)->format('M')] = $totalpetikemasImpor;
                $dataEkspor[Carbon::create()->month($i)->format('M')] = $totalpetikemasEkspor;
                $total = $totalpetikemasImpor + $totalpetikemasEkspor;
            }
            return response()->json([
                'impor' =>  $dataImpor,
                'ekspor' => $dataEkspor,
                'total' => $total,
                'isMonthly' => true
            ]);
        } else {
            // Determine the number of days in the given month
            $year = date('Y'); // Use the current year
            $date = new DateTime("$year-$month-01");
            $daysInMonth = $date->format('t'); // 't' returns the number of days in the month
            $transaksiCollectionImpor = Transaksi::where('jenis_kegiatan', 'impor')->get();
            $transaksiCollectionEkspor = Transaksi::where('jenis_kegiatan', 'ekspor')->get();
            // Generate sales and returns data for each day of the given month
            $dataImpor = [];
            $dataEkspor = [];
            $totalmonth = 0;
            $transaksiall = Transaksi::all();



            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
                $totalpetikemasImpor = 0;
                $totalpetikemasEkspor = 0;
                foreach ($transaksiall as $transaksis) {
                    // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
                    $lunasPenghubungs = $transaksis->penghubungs()->whereHas('pembayaran', function ($query) use ($date) {
                        $query->where('status_pembayaran', 'sudah lunas')
                            ->whereDate('tanggal_pembayaran', $date);
                    })->with('petikemas')->get();

                    // Sum the harga values from the related petikemas models for each transaksi
                    $totalmonth += $lunasPenghubungs->pluck('petikemas')->count();
                    /*if ($totalpetikemasImpor > 0) {
                        $totalmonth++;
                    }*/
                };
                foreach ($transaksiCollectionImpor as $transaksi) {
                    // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
                    $lunasPenghubungs = $transaksi->penghubungs()->whereHas('pembayaran', function ($query) use ($date) {
                        $query->where('status_pembayaran', 'sudah lunas')
                            ->whereDate('tanggal_pembayaran', $date);
                    })->with('petikemas')->get();

                    // Sum the harga values from the related petikemas models for each transaksi
                    $totalpetikemasImpor += $lunasPenghubungs->pluck('petikemas')->count();
                    /*if ($totalpetikemasImpor > 0) {
                        $totalmonth++;
                    }*/
                };
                foreach ($transaksiCollectionEkspor as $transaksi) {
                    // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'sudah lunas' and date conditions
                    $lunasPenghubungs = $transaksi->penghubungs()->whereHas('pembayaran', function ($query) use ($date) {
                        $query->where('status_pembayaran', 'sudah lunas')
                            ->whereDate('tanggal_pembayaran', $date);
                    })->with('petikemas')->get();

                    // Sum the harga values from the related petikemas models for each transaksi
                    $totalpetikemasEkspor += $lunasPenghubungs->pluck('petikemas')->count();
                }

                // Store the total harga for the current day
                $dataImpor[Carbon::parse($date)->format('d M ')] = $totalpetikemasImpor;
                $dataEkspor[Carbon::parse($date)->format('d M')] = $totalpetikemasEkspor;
            }

            return response()->json([
                'impor' =>  $dataImpor,
                'ekspor' => $dataEkspor,
                'total' =>  $totalmonth,
                'isMonthly' => false
            ]);
        }
    }

    private function createRelatedRecords($penghubungId, $transaksiId, $petikemas)
    {
        Pembayaran::create([
            'penghubung_id' => $penghubungId,
            'transaksi_id' => $transaksiId,
            'status_cetak_spk' => 'belum cetak',
            'status_pembayaran' => 'belum lunas',
        ]);
        $pengecekan = Pengecekan::create([
            'penghubung_id' => $penghubungId,
            'transaksi_id' => $transaksiId,
        ]);

        $perbaikan = Perbaikan::create([
            'penghubung_id' => $penghubungId,
            'transaksi_id' => $transaksiId,
        ]);

        $penempatan = Penempatan::create([
            'penghubung_id' => $penghubungId,
            'transaksi_id' => $transaksiId,
        ]);

        pengecekanhistory::create([
            'id_pengecekan' => $pengecekan->id,
            'status_kondisi' => $petikemas->status_kondisi,
            'petikemas_id' => $petikemas->id,
        ]);

        perbaikanhistory::create([
            'id_perbaikan' => $perbaikan->id,
            'status_kondisi' => $petikemas->status_kondisi,
            'petikemas_id' => $petikemas->id,
        ]);

        penempatanhistory::create([
            'id_penempatan' => $penempatan->id,
            'lokasi' => $petikemas->lokasi,
            'status_ketersediaan' => $petikemas->status_ketersediaan,
            'petikemas_id' => $petikemas->id,
        ]);
    }

    public function storeEntryData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_kegiatan' => 'required|in:impor,ekspor',
            'perusahaan' => 'required',
            'no_do' => 'required|min:8|unique:transaksis',
            'tanggal_DO_rilis' => 'required|date|before:tanggal_DO_exp',
            'tanggal_DO_exp' => 'required|date',
            'kapal' => 'required|max:255',
            'emkl' => 'required',
            'jumlah_petikemas' => 'required|numeric|min:1|max:10',
            'no_petikemas' => ['required', 'array', new UniqueArrayValues()],
            'jenis_ukuran' => 'required',
            'pelayaran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $current_date = now();
        $jenis_kegiatan = $request->jenis_kegiatan == 'impor' ? 'DO.IN' : 'DO.OUT';
        $latest_transaction = Transaksi::latest()
            ->where('jenis_kegiatan', $request->jenis_kegiatan)
            ->first();
        $no_urut = $latest_transaction ? intval(substr($latest_transaction->no_transaksi, 0, 6)) + 1 : 1;
        $nomor_urut = str_pad($no_urut, 6, '0', STR_PAD_LEFT);
        $bulan_tahun = date('mY', strtotime($current_date));
        $no_transaksi = $nomor_urut . '-' . $jenis_kegiatan . '-' . $bulan_tahun;

        $transaksi = Transaksi::create([
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'perusahaan' => $request->perusahaan,
            'no_do' => $request->no_do,
            'tanggal_DO_rilis' => $request->tanggal_DO_rilis,
            'tanggal_DO_exp' => $request->tanggal_DO_exp,
            'kapal' => $request->kapal,
            'emkl' => $request->emkl,
            'jumlah_petikemas' => $request->jumlah_petikemas,
            'inventory' => auth()->user()->username,
            'foto_profil' => auth()->user()->foto,
            'no_transaksi' => $no_transaksi,
        ]);

        foreach ($request->no_petikemas as $no_petikemas) {
            $penghubung = Penghubung::create([
                'transaksi_id' => $transaksi->id,
                'petikemas_id' => $no_petikemas,
            ]);
            $petikemas = petikemas::find($no_petikemas);
            $petikemas->update([
                'status_order' => 'false',
            ]);
            $this->createRelatedRecords($penghubung->id, $transaksi->id, $petikemas);
        }

        $user = User::all();
        $transaksiId = $transaksi->id;

        // Check if the user has 'direktur' or 'mops' role

        if (auth()->user()->hasRole('direktur')) {
            foreach ($user as $item) {
                if ($item->hasRole('kasir') || $item->hasRole('mops')) {
                    $link = $item->hasRole(['direktur', 'mops'])
                        ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                        : '/kasir/pembayaran/' . $transaksiId;
                    notifikasi::create([
                        'message' => 'Transaksi baru dengan No. ' . $transaksi->no_transaksi . ' telah dibuat, segera lakukan pembayaran.',
                        'tanggal_kirim' => now(),
                        'sender' => auth()->user()->username,
                        'foto_profil' => auth()->user()->foto,
                        'user_id' => $item->id,
                        'link' => $link
                    ]);
                }
            }
        } else if (auth()->user()->hasRole('inventory')) {
            foreach ($user as $item) {
                if ($item->hasRole('kasir') || $item->hasRole('mops') || $item->hasRole('direktur')) {
                    $link = $item->hasRole(['direktur', 'mops'])
                        ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                        : '/kasir/pembayaran/' . $transaksiId;
                    notifikasi::create([
                        'message' => 'Transaksi baru dengan No. ' . $transaksi->no_transaksi . ' telah dibuat, segera lakukan pembayaran.',
                        'tanggal_kirim' => now(),
                        'sender' => auth()->user()->username,
                        'foto_profil' => auth()->user()->foto,
                        'user_id' => $item->id,
                        'link' => $link
                    ]);
                }
            }
        } else if (auth()->user()->hasRole('mops')) {
            foreach ($user as $item) {
                if ($item->hasRole('kasir')  || $item->hasRole('direktur')) {
                    $link = $item->hasRole(['direktur', 'mops'])
                        ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                        : '/kasir/pembayaran/' . $transaksiId;
                    notifikasi::create([
                        'message' => 'Transaksi baru dengan No. ' . $transaksi->no_transaksi . ' telah dibuat, segera lakukan pembayaran.',
                        'tanggal_kirim' => now(),
                        'sender' => auth()->user()->username,
                        'foto_profil' => auth()->user()->foto,
                        'user_id' => $item->id,
                        'link' => $link
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Ditambahkan!',
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'jenis_kegiatan' => 'required|in:impor,ekspor',
            'perusahaan' => 'required',
            'tanggal_DO_rilis' => 'required|date|before:tanggal_DO_exp',
            'tanggal_DO_exp' => 'required|date',
            'kapal' => 'required|max:255',
            'emkl' => 'required',
            'inventory' => 'required',
            'tanggal_transaksi'
        ];

        if ($request->has('no_do')) {
            $rules['no_do'] = 'required|min:8|unique:transaksis,no_do,' . $id;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $transaksi = Transaksi::findOrFail($id);
        $user = user::where('username', $request->inventory)->first();
        if ($transaksi->jenis_kegiatan !== $request->jenis_kegiatan && $transaksi->tanggal_transaksi) {

            $transaksi->update(
                [
                    'jenis_kegiatan' => $transaksi->jenis_kegiatan,
                    'perusahaan' => $request->perusahaan,
                    'no_do' => $request->no_do,
                    'tanggal_DO_rilis' => $request->tanggal_DO_rilis,
                    'tanggal_DO_exp' => $request->tanggal_DO_exp,
                    'kapal' => $request->kapal,
                    'emkl' => $request->emkl,
                    'inventory' => $request->inventory,
                    'tanggal_transaksi' => $request->tanggal_transaksi,
                    'foto_profil' => $user->foto
                ]
            );
        } else {
            $transaksi->update($request->all());
        }
        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Diubah!',
        ]);
    }

    public function delete(Request $request)
    {
        $transaksi = Transaksi::with('penghubungs.petikemas')->findOrFail($request->id);
        foreach ($transaksi->penghubungs as $item) {
            $petikemas = petikemas::where('id', $item->petikemas->id)->first();
            $petikemas->update(['status_order' => 'true']);
        }
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Dihapus!',
        ]);
    }

    public function filter(Request $request)
    {
        $selectedValue = $request->input('jenis_kegiatan');
        $selectedMonth = $request->input('bulan_transaksi');
        $searchTerm = $request->input('search');

        $query = Transaksi::query();

        if ($selectedValue) {
            if ($selectedValue == 'impor' || $selectedValue == 'ekspor') {
                $query->where('jenis_kegiatan', $selectedValue);
            } else if ($selectedValue == 'transaksi-belum-selesai') {
                $query->whereNull('tanggal_transaksi');
            } else if ($selectedValue == 'transaksi-selesai') {
                $query->whereNotNull('tanggal_transaksi');
            }
        }

        if ($selectedMonth) {
            $query->whereMonth('tanggal_transaksi', date('m', strtotime($selectedMonth)));
        }

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query
                    ->where('no_transaksi', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jenis_kegiatan', 'like', '%' . $searchTerm . '%')
                    ->orWhere('no_do', 'like', '%' . $searchTerm . '%')
                    ->orWhere('perusahaan', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jumlah_petikemas', 'like', '%' . $searchTerm . '%')
                    ->orWhere('kapal', 'like', '%' . $searchTerm . '%')
                    ->orWhere('emkl', 'like', '%' . $searchTerm . '%');
            });
        }

        $perPage = 3;
        $filteredData = $query->paginate($perPage);

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData->items(),
            'Count' => $filteredData->total(),
            'meta' => [
                'current_page' => $filteredData->currentPage(),
                'last_page' => $filteredData->lastPage(),
                'per_page' => $filteredData->perPage(),
            ],

        ]);
    }


    public function laporanbulanantransaksi(Request $request)
    {
        $selectedValue = $request->input('jenis_kegiatan');
        $selectedMonth = $request->input('bulan_transaksi');

        $query = Transaksi::query();

        if ($selectedValue == 'impor' || $selectedValue == 'ekspor') {
            $query->where('jenis_kegiatan', $selectedValue);
        }

        if ($selectedMonth) {
            $query->whereMonth('tanggal_transaksi', date('m', strtotime($selectedMonth)));
        }

        $filteredData = $query->with('penghubungs.petikemas')->get();

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        $pdf = Pdf::loadView('pdf.laporanbulanantransaksi', [
            'selectedValue' => $selectedValue,
            'selectedMonth' => $selectedMonth,
            'transaksis' => $filteredData,
        ]);

        return $pdf->download('laporan_bulanan_transaksi.pdf');
    }
    public function editEntryData(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'no_petikemas' => ['required', 'array', 'min:1', new UniqueArrayValues(), new RequiredArrayValues],
            'jenis_ukuran' => 'required',
            'pelayaran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $existingPenghubung = Penghubung::where('transaksi_id', $id)->get();
        $noPetikemas = $request->no_petikemas;

        foreach ($existingPenghubung as $index => $item) {

            if (isset($noPetikemas[$index])) {
                $petikemas = petikemas::where(['id' => $item->petikemas_id])->first();
                $newPetikemasId = $noPetikemas[$index];
                if ($item->petikemas_id != $newPetikemasId) {
                    $this->resetRelatedEntries($item->id);
                    $this->resethistory($item->id, $petikemas);
                    $item->update(['petikemas_id' => $newPetikemasId]);
                    $newpetikemas = petikemas::where(['id' => $newPetikemasId])->first();
                    $newpetikemas->update([
                        'status_order' => 'false',
                    ]);
                }
            }
        }

        if (count($noPetikemas) > count($existingPenghubung)) {
            for ($i = 0; $i < count($noPetikemas) - count($existingPenghubung); $i++) {
                $new_penghubung = Penghubung::create([
                    'transaksi_id' => $id,
                    'petikemas_id' => $noPetikemas[$i + count($existingPenghubung)],
                ]);
                $petikemas = petikemas::where('id', $noPetikemas[$i + count($existingPenghubung)])->first();
                $petikemas->update([
                    'status_order' => 'false',
                ]);
                $this->createRelatedRecords($new_penghubung->id, $id, $petikemas);
            }
        }

        $updatedPenghubungCount = Penghubung::where('transaksi_id', $id)->count();
        $transaksi->update(['jumlah_petikemas' => $updatedPenghubungCount]);

        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Diubah!',
        ]);
    }

    private function resetRelatedEntries($penghubungId)
    {
        Pembayaran::where('penghubung_id', $penghubungId)->update([
            'tanggal_pembayaran' => null,
            'status_pembayaran' => 'belum lunas',
            'kasir' => null,
            'metode' => null,
            'status_cetak_spk' => 'belum cetak',
        ]);

        $pengecekan = Pengecekan::where('penghubung_id', $penghubungId);
        $pengecekan->update([
            'jumlah_kerusakan' => null,

            'tanggal_pengecekan' => null,
            'survey_in' => null,
        ]);
        $perbaikan = Perbaikan::where('penghubung_id', $penghubungId)->first();

        $perbaikan->update([
            'tanggal_perbaikan' => null,
            'repair' => null,
        ]);
        $kerusakans = Kerusakan::where('perbaikan_id', $perbaikan->id)->get();
        // Loop through each Kerusakan record
        foreach ($kerusakans as $kerusakan) {
            // Check if the file exists and delete it
            if (Storage::disk('public')->exists($kerusakan->foto_pengecekan)) {
                Storage::disk('public')->delete($kerusakan->foto_pengecekan);
            }

            // Delete the Kerusakan record
            $kerusakan->delete();
        }
        $penempatan = Penempatan::where('penghubung_id', $penghubungId);
        $penempatan->update([
            'tanggal_penempatan' => null,
            'operator_alat_berat' => null,
            'tally' => null,
        ]);
    }
    private function resethistory($penghubungId, $petikemas)
    {
        $pengecekan = Pengecekan::where('penghubung_id', $penghubungId)->first();
        $perbaikan = Perbaikan::where('penghubung_id', $penghubungId)->first();
        $penempatan = Penempatan::where('penghubung_id', $penghubungId)->first();
        $pengecekanhistory = pengecekanhistory::where('id_pengecekan', $pengecekan->id)
            ->orderBy('created_at', 'asc')
            ->first();
        $penempatanhistory = penempatanhistory::where('id_penempatan', $penempatan->id)
            ->orderBy('created_at', 'asc')
            ->first();

        $petikemas->update([
            'status_kondisi' => $pengecekanhistory->status_kondisi,
            'status_order' => 'true',
            'lokasi' => $penempatanhistory->lokasi,
            'status_ketersediaan' => $penempatanhistory->status_ketersediaan,
        ]);
        $pengecekanhistories = pengecekanhistory::where('id_pengecekan', $pengecekan->id)
            ->orderBy('created_at', 'desc')->get();
        $perbaikanshistories = perbaikanhistory::where('id_perbaikan', $perbaikan->id)
            ->orderBy('created_at', 'asc')->get();
        $penempatanhistories = penempatanhistory::where('id_penempatan', $penempatan->id)
            ->orderBy('created_at', 'asc')->get();
        // Exclude the oldest record
        $idsToDeletepengecekan = $pengecekanhistories->slice(1);
        $idsToDeleteperbaikan = $perbaikanshistories->slice(1);
        $idsToDeletepenempatan = $penempatanhistories->slice(1);
        foreach ($idsToDeletepengecekan as $value) {
            $value->delete();
            $kerusakanhistory = kerusakanhistory::where('id_pengecekanhistory', $value->id);
            foreach ($kerusakanhistory as $item) {
                $item->delete();
            }
        };
        foreach ($idsToDeleteperbaikan as $value) {
            $value->delete();
            $kerusakanhistory = kerusakanhistory::where('id_perbaikanhistory', $value->id);
            foreach ($kerusakanhistory as $item) {
                $item->delete();
            }
        };
        foreach ($idsToDeletepenempatan as $value) {
            $value->delete();
        }
    }
    public function deleteentrydata(Request $request)
    {
        $penghubungId = $request->id;

        // Use DB transaction for better performance and data consistency
        DB::transaction(function () use ($penghubungId) {
            // Get the associated transaksi_id before deletion
            $penghubung = Penghubung::findOrFail($penghubungId);
            $transaksiId = $penghubung->transaksi_id;
            $petikemas = petikemas::where('id', $penghubung->petikemas_id)->first();
            $this->resethistory($penghubungId, $petikemas);
            $transaksi = Transaksi::where('id', $transaksiId);
            // if ($transaksi->jenis_kegiatan == "impor") {
            //     $petikemas->status_ketersediaan = "out";
            //     $petikemas->lokasi = "out";
            // } else {
            //     $petikemas->status_ketersediaan = "in";
            //     $petikemas->lokasi = "pending";
            // }
            // $petikemas->save();
            // Delete the Penghubung record
            $penghubung->delete();

            // Update the jumlah_petikemas field in the related transaksi record
            $transaksi->decrement('jumlah_petikemas');
        });

        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Dihapus!',
        ]);
    }

    public function cetakspk(Request $request, $id)
    {
        $statusCetakSpk = $request->input('status');
        $idPenghubung = $request->input('id_penghubung');

        $transaksi = Transaksi::with([
            'penghubungs' => function ($query) use ($idPenghubung) {
                $query->where('id', $idPenghubung);
            },
            'penghubungs.pembayaran',
        ])->findOrFail($id);
        $user = User::all();
        $transaksiId = $transaksi->id;
        $petikemas_id = '';
        foreach ($transaksi->penghubungs as $value) {
            $petikemas_id = $value->petikemas_id;
        }
        $petikemas = petikemas::where('id', $petikemas_id)->first();

        if ($transaksi->jenis_kegiatan == 'impor') {
            if (auth()->user()->hasRole('direktur')) {
                foreach ($user as $item) {
                    if ($item->hasRole('surveyin') || $item->hasRole('mops')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/surveyin/pengecekan/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Telah dicetak SPK dengan peti kemas No. ' . $petikemas->no_petikemas . '. Mohon segera diperiksa.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('inventory')) {
                foreach ($user as $item) {
                    if ($item->hasRole('surveyin') || $item->hasRole('mops') || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/surveyin/pengecekan/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Telah dicetak SPK dengan peti kemas No. ' . $petikemas->no_petikemas . '. Mohon pindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('mops')) {
                foreach ($user as $item) {
                    if ($item->hasRole('surveyin')  || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/surveyin/pengecekan/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Telah dicetak SPK dengan peti kemas No. ' . $petikemas->no_petikemas . '. Mohon segera diperiksa.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            }
        } else {
            if (auth()->user()->hasRole('direktur')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally') || $item->hasRole('mops')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';
                        notifikasi::create([
                            'message' => 'Telah dicetak SPK dengan peti kemas No. ' . $petikemas->no_petikemas . '. Mohon pindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('inventory')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally') || $item->hasRole('mops') || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';
                        notifikasi::create([
                            'message' => 'Telah dicetak SPK dengan peti kemas No. ' . $petikemas->no_petikemas . '. Mohon pindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('mops')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally')  || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';
                        notifikasi::create([
                            'message' => 'Telah dicetak SPK dengan peti kemas No. ' . $petikemas->no_petikemas . '. Mohon pindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            }
        }


        $relatedPenghubung = $transaksi->penghubungs->first();

        $relatedPenghubung->pembayaran->update(['status_cetak_spk' => $statusCetakSpk]);
        if (!Session::has('spk_counter')) {
            Session::put('spk_counter', 0);
        }

        // Get the current counter value from the session
        $currentCounter = Session::get('spk_counter');

        // Increment the counter
        $currentCounter++;

        // Save the new counter value back to the session
        Session::put('spk_counter', $currentCounter);

        $date = Carbon::now();
        $formattedDate = $date->format('dmy');
        $no_spk = 'SPK-' . ($transaksi->jenis_transaksi == 'impor' ? 'IN' : 'OUT') . '/' . $formattedDate . '/' . str_pad($currentCounter, 4, '0', STR_PAD_LEFT);

        $pdf = PDF::loadView('pdf.spk', [
            'transaksi' => $transaksi,
            'penghubung' => $relatedPenghubung,
            'no_spk' => $no_spk,
        ]);

        return $pdf->download('spk.pdf');
    }

    public function editpembayaran(Request $request, $id_transaksi)
    {
        $id_penghubung = $request->input('id_penghubung');
        $metode = $request->input('metode');
        $i = 0;

        $transaksi = Transaksi::with([
            'penghubungs' => function ($query) use ($id_penghubung) {
                $query->whereIn('id', $id_penghubung);
            },
            'penghubungs.petikemas',
        ])->findOrFail($id_transaksi);
        foreach ($id_penghubung as $id) {
            $pembayaran = Pembayaran::where('penghubung_id', $id)->first();
            $pembayaran->metode = $metode[$i];
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->status_pembayaran = 'sudah lunas';
            $pembayaran->save();
            $penghubung = penghubung::findOrFail($id);
            $petikemas = petikemas::where('id', $penghubung->petikemas_id)->first();
            $i++;
            if ($transaksi->jenis_kegiatan == "impor") {
                $petikemas->status_ketersediaan = "in";
                $petikemas->lokasi = "pending";
                $petikemas->tanggal_masuk = now();
                $petikemas->save();
            }
            $user = User::all();
            $transaksiId = $transaksi->id;
            if (auth()->user()->hasRole('direktur')) {
                foreach ($user as $item) {
                    if ($item->hasRole('inventory') || $item->hasRole('mops')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/inventory/entry-data/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Telah dilunasi peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera mencetak SPK.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('kasir')) {
                foreach ($user as $item) {
                    if ($item->hasRole('inventory') || $item->hasRole('mops') || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/inventory/entry-data/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Telah dilunasi peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera mencetak SPK.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('mops')) {
                foreach ($user as $item) {
                    if ($item->hasRole('inventory')  || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/inventory/entry-data/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Telah dilunasi peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera mencetak SPK.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            }
        }

        $relatedPenghubung = $transaksi->penghubungs;
        foreach ($relatedPenghubung as $item) {
            if ($i == $item->pembayaran->count() &&  $transaksi->tanggal_transaksi == null) {
                // If condition is met, update the transaction date and save
                $transaksi->tanggal_transaksi = now();
                $transaksi->save();
                break; // Assuming you want to update the date and save only once if any penghubung meets the condition
            }
        }
        if (!Session::has('kwitansi_counter')) {
            Session::put('kwitansi_counter', 0);
        }

        // Get the current counter value from the session
        $currentCounter = Session::get('kwitansi_counter');

        // Increment the counter
        $currentCounter++;

        // Save the new counter value back to the session
        Session::put('kwitansi_counter', $currentCounter);
        $date = new DateTime();
        $formattedDate = $date->format('dmy');
        $no_kwitansi = 'KW-' . ($transaksi->jenis_transaksi == 'impor'  ? 'IN' : 'OUT') . '/' . $formattedDate . '/' . str_pad($currentCounter, 4, '0', STR_PAD_LEFT);

        $pdf = PDF::loadView('pdf.kwitansi', [
            'transaksi' => $transaksi,
            'penghubung' => $relatedPenghubung,
            'no_kwitansi' => $no_kwitansi
        ]);

        return $pdf->download('kwitansi.pdf');
    }

    public function storepengecekan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_petikemas' => 'required',
            'jumlah_kerusakan' => 'required|numeric|min:0|max:10',
            'jenis_ukuran_pengecekan' => 'required',
            'lokasi_kerusakan' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'komponen' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'metodes' => ['array', new UniqueArrayValueFoto('metode_value'), new RequiredArrayValuesFoto('metode_value')],
            'foto_pengecekan' => ['array', new UniqueArrayValueFoto('foto_pengecekan_name'), new RequiredArrayValuesFoto('foto_pengecekan_name')],
            'foto_pengecekan.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_pengecekan_name' => ['array', new RequiredArrayValues()],
            'metode_value' => ['array', new RequiredArrayValues()]
        ]);

        if ($request->input('jumlah_kerusakan') > 0) {
            $validator->sometimes('foto_pengecekan_name', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });



            $validator->sometimes('lokasi_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });


            $validator->sometimes('komponen', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });



            $validator->sometimes('metodes', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });


            $validator->sometimes('foto_pengecekan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $penghubung = Penghubung::findOrFail($request->no_petikemas);

        $petikemas = Petikemas::findOrFail($penghubung->petikemas_id);
        $pengecekan = Pengecekan::where('penghubung_id', $request->no_petikemas)->first();
        $perbaikan = Perbaikan::where('penghubung_id', $request->no_petikemas)->first();
        $perbaikan->jumlah_perbaikan = $request->jumlah_kerusakan;
        $pengecekan->update([
            'jumlah_kerusakan' => $request->jumlah_kerusakan,
            'tanggal_pengecekan' => now(),
            'survey_in' => auth()->user()->username,
            'foto_profil' => auth()->user()->foto
        ]);

        $petikemas->update(['status_kondisi' => $request->jumlah_kerusakan > 0 ? 'damage' : 'available', 'status_order' => $request->jumlah_kerusakan > 0 ? 'false' : 'true']);

        $perbaikan->update(['jumlah_perbaikan' => $pengecekan->jumlah_kerusakan]);
        $pengecekanhistory = pengecekanhistory::create([
            'id_pengecekan' => $pengecekan->id,
            'jumlah_kerusakan' => $pengecekan->jumlah_kerusakan,
            'tanggal_pengecekan' => $pengecekan->tanggal_pengecekan,
            'survey_in' => $pengecekan->survey_in,
            'petikemas_id' => $petikemas->id,
            'status_kondisi' => $petikemas->status_kondisi,
            'foto_profil' => auth()->user()->foto
        ]);

        if ($request->jumlah_kerusakan > 0) {
            foreach ($request->lokasi_kerusakan as $index => $lokasi) {
                $path = $request->file('foto_pengecekan')[$index]->store('uploads', 'public');
                $newFileName = $request->file('foto_pengecekan')[$index]->getClientOriginalName();
                $kerusakan = Kerusakan::create([
                    'lokasi_kerusakan' => $lokasi,
                    'komponen' => $request->komponen[$index],
                    'status' => 'damage',
                    'metode' => $request->metodes[$index],
                    'foto_pengecekan' => $path,
                    'foto_pengecekan_name' => $newFileName,
                    'pengecekan_id' => $pengecekan->id,
                    'perbaikan_id' => $perbaikan->id,
                ]);
                kerusakanhistory::create([
                    'lokasi_kerusakan' => $kerusakan->lokasi_kerusakan,
                    'komponen' => $kerusakan->komponen,
                    'status' => $kerusakan->status,
                    'metode' => $kerusakan->metode,
                    'harga' => $kerusakan->harga,
                    'foto_pengecekan' => $kerusakan->foto_pengecekan,
                    'foto_perbaikan' => $kerusakan->foto_perbaikan,
                    'tanggal_perubahan' => now(),
                    'id_kerusakan' => $kerusakan->id,
                    'id_pengecekanhistory' => $pengecekanhistory->id,
                    'petikemas_id' => $petikemas->id,
                ]);
            }
            $transaksiId = $penghubung->transaksi_id;
            $user = User::all();
            if (auth()->user()->hasRole('direktur')) {
                foreach ($user as $item) {
                    if ($item->hasRole('repair') || $item->hasRole('mops')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/repair/perbaikan/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Terdapat kerusakan pada peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera diperbaiki.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('surveyin')) {
                foreach ($user as $item) {
                    if ($item->hasRole('repair') || $item->hasRole('mops') || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/repair/perbaikan/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Terdapat kerusakan pada peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera diperbaiki.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('mops')) {
                foreach ($user as $item) {
                    if ($item->hasRole('repair')  || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/repair/perbaikan/' . $transaksiId;
                        notifikasi::create([
                            'message' => 'Terdapat kerusakan pada peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera diperbaiki.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link,
                        ]);
                    }
                }
            }
        } else {
            $user = User::all();
            $transaksiId = $penghubung->transaksi_id;
            if (auth()->user()->hasRole('direktur')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally') || $item->hasRole('mops')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';
                        notifikasi::create([
                            'message' => 'Tidak ada kerusakan pada peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera pindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('surveyin')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally') || $item->hasRole('mops') || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';
                        notifikasi::create([
                            'message' => 'Tidak ada kerusakan pada peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera pindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('mops')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally')  || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';
                        notifikasi::create([
                            'message' => 'Tidak ada kerusakan pada peti kemas dengan No. ' . $petikemas->no_petikemas . '. Mohon segera pindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link
                        ]);
                    }
                }
            }
        }


        return response()->json([
            'success' => true,
            'message' => 'Data Pengecekan Berhasil Ditambah!',
        ]);
    }

    public function indexkerusakan(Request $request)
    {
        $id_pengecekan = $request->input('id_pengecekan');
        $pengecekan = pengecekan::with('kerusakan')->findOrFail($id_pengecekan);
        $kerusakan = $pengecekan->kerusakan;
        return response()->json([
            'kerusakan' => $kerusakan,
            'pengecekan' => $pengecekan,
        ]);
    }

    public function indexpengecekanhistory(Request $request)
    {
        $id_pengecekanhistory = $request->input('id_pengecekanhistory');
        $kerusakan = kerusakan::where('id_pengecekanhistory', $id_pengecekanhistory);
        return response()->json([
            'kerusakan' => $kerusakan,
        ]);
    }

    public function editpengecekan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url_foto' => 'array',
            'id_penghubung' => 'required',
            'survey_in' => 'required',
            'jumlah_kerusakan' => 'required|numeric|min:0|max:10',
            'lokasi_kerusakan' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'komponen' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'metode' => ['array', new UniqueArrayValueFoto('metode_value'), new RequiredArrayValuesFoto('metode_value')],
            'foto_pengecekan' => ['array', new UniqueArrayValueFoto('foto_pengecekan_name'), new RequiredArrayValuesFoto('foto_pengecekan_name')],
            'foto_pengecekan.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_pengecekan_name' => ['array', new RequiredArrayValues()],
            'metode_value' => ['array', new RequiredArrayValues()]
        ]);

        if ($request->input('jumlah_kerusakan') > 0) {
            $validator->sometimes('foto_pengecekan_name', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });



            $validator->sometimes('lokasi_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });


            $validator->sometimes('komponen', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });



            $validator->sometimes('metode', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });


            $validator->sometimes('foto_pengecekan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan > 0;
            });
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Fetching related models
        $pengecekan = pengecekan::with('kerusakan')->findOrFail($request->id_pengecekan);
        $perbaikan = perbaikan::findOrFail($request->id_pengecekan);

        $kerusakan = $pengecekan->kerusakan->where('status', 'damage');
        $penghubung = Penghubung::findOrFail($request->id_penghubung);
        $petikemas = Petikemas::findOrFail($penghubung->petikemas_id);
        $user = user::where('username', $request->survey_in)->fist();
        // Updating pengecekan
        $pengecekan->update([
            'jumlah_kerusakan' => $request->jumlah_kerusakan,
            'tanggal_pengecekan' => now(),
            'survey_in' => $request->survey_in,
            'foto_profil' => $user->foto
        ]);
        // Updating petikemas status
        $petikemas->update(['status_kondisi' => $request->jumlah_kerusakan > 0 ? 'damage' : 'available', 'status_order' => $request->jumlah_kerusakan > 0 ? 'false' : 'true']);
        $pengecekanhistory = pengecekanhistory::create([
            'id_pengecekan' => $pengecekan->id,
            'jumlah_kerusakan' => $request->jumlah_kerusakan,
            'tanggal_pengecekan' => $pengecekan->tanggal_pengecekan,
            'survey_in' => $pengecekan->survey_in,
            'petikemas_id' => $petikemas->id,
            'status_kondisi' => $petikemas->status_kondisi,
            'foto_profil' => $user->foto
        ]);
        if ($request->jumlah_kerusakan == count($kerusakan)) {
            // Updating kerusakan and handling file uploads
            $i = 0;
            foreach ($kerusakan as $index => $item) {

                // Cek apakah ada file gambar baru yang diunggah
                if ($request->hasFile("foto_pengecekan.$i")) {
                    $newImagePath = $request->file("foto_pengecekan.$i")->store('uploads', 'public');
                    $newImageName = $request->file('foto_pengecekan')[$i]->getClientOriginalName();
                    // Perbarui dengan gambar baru
                    $item->update(['foto_pengecekan' => $newImagePath]);
                } else {
                    // Jika tidak ada file gambar baru, gunakan url_foto yang ada
                    $newImagePath = $item->foto_pengecekan;
                    $newImageName = $item->foto_pengecekan_name;
                }

                // Perbarui data lainnya
                $item->update([
                    'lokasi_kerusakan' => $request->lokasi_kerusakan[$i],
                    'komponen' => $request->komponen[$i],
                    'status' => 'damage',
                    'metode' => $request->metode[$i],
                    'foto_pengecekan_name' => $newImageName,
                    'foto_pengecekan' => $newImagePath, // Gunakan nilai yang sudah ditentukan
                ]);
                kerusakanhistory::create([
                    'lokasi_kerusakan' => $item->lokasi_kerusakan,
                    'komponen' => $item->komponen,
                    'status' => $item->status,
                    'metode' => $item->metode,
                    'harga' => $item->harga,
                    'foto_pengecekan' => $item->foto_pengecekan,
                    'foto_perbaikan' => $item->foto_perbaikan,
                    'tanggal_perubahan' => now(),
                    'id_kerusakan' => $item->id,
                    'id_pengecekanhistory' => $pengecekanhistory->id,
                    'petikemas_id' => $petikemas->id,
                ]);

                $i++;
            }
        }
        // Handling new kerusakan
        $datadamage = $pengecekan->kerusakan->where('status', 'damage')->count();
        if ($request->jumlah_kerusakan > count($kerusakan)) {
            foreach ($pengecekan->kerusakan as $item) {
                kerusakanhistory::create([
                    'lokasi_kerusakan' => $item->lokasi_kerusakan,
                    'komponen' => $item->komponen,
                    'status' => 'damage',
                    'metode' => $item->metode,
                    'harga' => $item->harga,
                    'foto_pengecekan' => $item->foto_pengekan,
                    'foto_perbaikan' => $item->foto_perbaikan,
                    'tanggal_perubahan' => now(),
                    'id_kerusakan' => $item->id,
                    'id_pengecekanhistory' => $pengecekanhistory->id,
                    'petikemas_id' => $petikemas->id,
                ]);
            }
            for ($i = 0; $i < $request->jumlah_kerusakan - count($kerusakan); $i++) {
                $path = $request->file('foto_pengecekan')[$i + count($kerusakan)]->store('uploads', 'public');
                $name = $request->file('foto_pengecekan')[$i + count($kerusakan)]->getClientOriginalName();
                $newKerusakan = Kerusakan::create([
                    'lokasi_kerusakan' => $request->lokasi_kerusakan[$i + count($kerusakan)],
                    'komponen' => $request->komponen[$i + count($kerusakan)],
                    'status' => 'damage',
                    'metode' => $request->metode[$i + count($kerusakan)],
                    'pengecekan_id' => $pengecekan->id,
                    'perbaikan_id' => $pengecekan->id,
                    'foto_pengecekan' => $path,
                    'foto_pengecekan_name' => $name,
                ]);
                kerusakanhistory::create([
                    'lokasi_kerusakan' => $newKerusakan->lokasi_kerusakan,
                    'komponen' => $newKerusakan->komponen,
                    'status' => 'damage',
                    'metode' => $newKerusakan->metode,
                    'harga' => $newKerusakan->harga,
                    'foto_pengecekan' => $newKerusakan->foto_pengekan,
                    'foto_perbaikan' => $newKerusakan->foto_perbaikan,
                    'tanggal_perubahan' => now(),
                    'id_kerusakan' => $newKerusakan->id,
                    'id_pengecekanhistory' => $pengecekanhistory->id,
                    'petikemas_id' => $petikemas->id,
                ]);
                $datadamage++;
            }
        } elseif ($request->jumlah_kerusakan < count($kerusakan)) {
            $extraKerusakan = $kerusakan->splice($request->jumlah_kerusakan);
            foreach ($extraKerusakan as $extra) {
                $extra->delete();
                $datadamage--;
            }
            foreach ($kerusakan as $item) {
                kerusakanhistory::create([
                    'lokasi_kerusakan' => $item->lokasi_kerusakan,
                    'komponen' => $item->komponen,
                    'status' => 'damage',
                    'metode' => $item->metode,
                    'harga' => $item->harga,
                    'foto_pengecekan' => $item->foto_pengekan,
                    'foto_perbaikan' => $item->foto_perbaikan,
                    'tanggal_perubahan' => now(),
                    'id_kerusakan' => $item->id,
                    'id_pengecekanhistory' => $pengecekanhistory->id,
                    'petikemas_id' => $petikemas->id,
                ]);
            }
        }
        $pengecekan->update(['jumlah_kerusakan' => $datadamage]);
        $perbaikan->update(['jumlah_perbaikan' => $pengecekan->jumlah_kerusakan]);

        $user = User::all();
        $transaksiId = $penghubung->transaksi_id;
        if (auth()->user()->hasRole('direktur')) {
            foreach ($user as $item) {
                if ($item->hasRole('repair') || $item->hasRole('surveyin') || $item->hasRole('mops')) {
                    $link = $item->hasRole(['direktur', 'mops'])
                        ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                        : ($item->hasRole('surveyin')
                            ? '/surveyin/pengecekan/' . $transaksiId
                            : '/repair/perbaikan/' . $transaksiId);
                    notifikasi::create([
                        'message' => 'Data pengecekan pada peti kemas dengan No. ' . $petikemas->no_petikemas . ' telah diperbarui. Mohon segera diperiksa.',
                        'tanggal_kirim' => now(),
                        'sender' => auth()->user()->username,
                        'foto_profil' => auth()->user()->foto,
                        'user_id' => $item->id,
                        'link' => $link
                    ]);
                }
            }
        } else if (auth()->user()->hasRole('mops')) {
            foreach ($user as $item) {
                if ($item->hasRole('repair') || $item->hasRole('surveyin') || $item->hasRole('direktur')) {
                    $link = $item->hasRole(['direktur', 'mops'])
                        ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                        : ($item->hasRole('surveyin')
                            ? '/surveyin/pengecekan/' . $transaksiId
                            : '/repair/perbaikan/' . $transaksiId);
                    notifikasi::create([
                        'message' => 'Data pengecekan pada peti kemas dengan No. ' . $petikemas->no_petikemas . ' telah diperbarui. Mohon segera diperiksa.',
                        'tanggal_kirim' => now(),
                        'sender' => auth()->user()->username,
                        'foto_profil' => auth()->user()->foto,
                        'user_id' => $item->id,
                        'link' => $link
                    ]);
                }
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Data Pengecekan Berhasil Diubah!',
        ]);
    }

    public function deletekerusakan(Request $request)
    {
        $id = $request->input("id_kerusakan");
        $id_petikemas = $request->input("id_petikemas");
        $kerusakans = Kerusakan::findOrFail($id);
        Pengecekan::where('id', $kerusakans->pengecekan_id)->decrement('jumlah_kerusakan');
        $pengecekan =  Pengecekan::where('id', $kerusakans->pengecekan_id)->first();
        $petikemas = petikemas::where('id', $id_petikemas)->first();
        $perbaikan = perbaikan::where('id', $pengecekan->id)->first();
        $perbaikan->update(['jumlah_perbaikan' => $pengecekan->jumlah_kerusakan]);
        $petikemas->update(['status_kondisi' => $pengecekan->jumlah_kerusakan > 0 ? 'damage' : 'available']);


        // Delete the Kerusakan record
        $kerusakans->delete();

        $pengecekanhistory = pengecekanhistory::create([
            'id_pengecekan' => $pengecekan->id,
            'jumlah_kerusakan' => $pengecekan->jumlah_kerusakan,
            'tanggal_pengecekan' => now(),
            'survey_in' => $pengecekan->survey_in,
            'petikemas_id' => $petikemas->id,
            'status_kondisi' => $petikemas->status_kondisi,
            'foto_profil' => $pengecekan->foto_profil,
        ]);
        // foreach ($kerusakans as $item) {
        foreach ($pengecekan->kerusakan as $item) {
            kerusakanhistory::create([
                'lokasi_kerusakan' => $item->lokasi_kerusakan,
                'komponen' => $item->komponen,
                'status' => $item->status,
                'metode' => $item->metode,
                'harga' => $item->harga,
                'foto_pengecekan' => $item->foto_pengecekan,
                'foto_perbaikan' => $item->foto_perbaikan,
                'tanggal_perubahan' => now(),
                'id_kerusakan' => $item->id,
                'id_pengecekanhistory' => $pengecekanhistory->id,
                'petikemas_id' => $petikemas->id,
            ]);
        }





        return response()->json([
            'success' => true,
            'petikemas' => $petikemas,
            'message' => 'Data Kerusakan Berhasil Dihapus!',
        ]);
    }

    public function editperbaikan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url_foto' => 'array',
            'id_penghubung' => 'required',
            'repair' => 'required',
            'jumlah_perbaikan' => 'required|numeric|min:0|max:10',
            'lokasi_kerusakan' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'komponen' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'metode' => ['array', new UniqueArrayValueFoto('metode_value'), new RequiredArrayValuesFoto('metode_value')],
            'status' => ['array', new RequiredArrayValuesFoto('status_value')],
            'foto_perbaikan' => ['array', new UniqueArrayValueFoto('foto_perbaikan_name'), new RequiredArrayValuesFoto('foto_perbaikan_name')],
            'foto_perbaikan.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_perbaikan_name' => ['array', new RequiredArrayValues()],
            'metode_value' => ['array', new RequiredArrayValues()],
            'status_value' => ['array', new RequiredArrayValues()],
            'foto_pengecekan.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_pengecekan_name' => ['array', new RequiredArrayValues()],
            'foto_pengecekan' => ['array', new UniqueArrayValueFoto('foto_pengecekan_name'), new RequiredArrayValuesFoto('foto_pengecekan_name')],

        ]);

        if ($request->input('jumlah_perbaikan') > 0) {



            $validator->sometimes('lokasi_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });

            $validator->sometimes('komponen', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });

            $validator->sometimes('metode', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });
        }

        $statusArray = $request->input('status');
        $jumlahPerbaikan = $request->input('jumlah_perbaikan');
        $hasFixStatus = is_array($statusArray) && in_array('fix', $statusArray);
        if ($jumlahPerbaikan > 0 && $hasFixStatus) {
            $validator->sometimes('foto_perbaikan_name', 'required|array', function ($input) use ($statusArray) {
                // Find the index of 'fix' in the status array
                $fixIndex = array_search('fix', $statusArray);
                // Ensure that the specific index in foto_perbaikan_name is set and not null
                $fotoPerbaikanName = $input->foto_perbaikan_name;
                $isValid = is_array($fotoPerbaikanName) && isset($fotoPerbaikanName[$fixIndex]) && !is_null($fotoPerbaikanName[$fixIndex]);
                return $isValid;
            });
        }
        if ($jumlahPerbaikan > 0 && $request->input('status')) {
            $validator->sometimes('status', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0 && $input->status;
            });
        }
        if ($jumlahPerbaikan > 0 && $request->input('foto_pengecekan_name')) {
            $validator->sometimes('foto_pengecekan_name', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0 && $input->foto_pengecekan_name;
            });
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Fetching related models
        $perbaikan = perbaikan::findOrFail($request->id_perbaikan);
        $pengecekan = pengecekan::with('kerusakan')->findOrFail($request->id_perbaikan);
        $kerusakan = $pengecekan->kerusakan->where('status', 'damage');
        $penghubung = Penghubung::findOrFail($request->id_penghubung);
        $transaksiId = $penghubung->transaksi_id;
        $petikemas = Petikemas::findOrFail($penghubung->petikemas_id);
        $datadamage = $pengecekan->kerusakan->where('status', 'damage')->count();
        $kerusakanall = $pengecekan->kerusakan->count();
        $user = user::where('username', $request->username)->first();
        // Updating perbaikan
        $perbaikan->update([
            'repair' => $request->repair,
            'jumlah_perbaikan' => $request->jumlah_perbaikan,
            'tanggal_perbaikan' => now(),
            'foto_profil' => $user->foto
        ]);

        // Updating perbaikan history
        $perbaikanhistory = perbaikanhistory::create([
            'id_perbaikan' => $perbaikan->id,
            'foto_profil' => $user->foto,
            'tanggal_perbaikan' => now(),
            'repair' => $perbaikan->repair,
            'estimator' => $perbaikan->estimator,
            'petikemas_id' => $petikemas->id,
            'status_kondisi' => $petikemas->status_kondisi
        ]);
        if ($request->status) {
            if (count($request->status) == $datadamage) {
                if ($request->has('status')) {
                    $i = 0;
                    foreach ($kerusakan as $index => $item) {
                        // Check if there is a new image uploaded
                        if ($request->hasFile("foto_perbaikan.$i")) {
                            // Store new image
                            $newImagePath = $request->file("foto_perbaikan.$i")->store('uploads', 'public');
                            $newImageName = $request->file('foto_perbaikan')[$i]->getClientOriginalName();
                        } else {
                            // Use existing URL if no new image
                            $newImageName = $item->foto_perbaikan_name;
                            $newImagePath = $item->foto_perbaikan;
                        }

                        // Capture old status before updating
                        $oldStatus = $item->status;
                        $newStatus = $request->status[$i];

                        // Update other data
                        $item->update([
                            'lokasi_kerusakan' => $request->lokasi_kerusakan[$i],
                            'komponen' => $request->komponen[$i],
                            'status' => $newStatus,
                            'metode' => $request->metode[$i],
                            'foto_perbaikan_name' => $newImageName,
                            'foto_perbaikan' => $newImagePath,
                        ]);

                        $i++;
                    }


                    foreach ($pengecekan->kerusakan as $item) {
                        kerusakanhistory::create([
                            'lokasi_kerusakan' => $item->lokasi_kerusakan,
                            'komponen' => $item->komponen,
                            'status' => $item->status,
                            'metode' => $item->metode,
                            'harga' => $item->harga,
                            'foto_pengecekan' => $item->foto_pengecekan,
                            'foto_perbaikan' => $item->foto_perbaikan,
                            'tanggal_perubahan' => now(),
                            'id_kerusakan' => $item->id,
                            'id_perbaikanhistory' => $perbaikanhistory->id,
                            'petikemas_id' => $petikemas->id,
                        ]);
                    }
                }

                if ($request->hasFile('foto_pengecekan')) {
                    foreach ($request->foto_pengecekan as $index => $item) {
                        $path = $request->file('foto_pengecekan')[$index]->store('uploads', 'public');
                        $name = $request->file('foto_pengecekan')[$index]->getClientOriginalName();
                        $newKerusakan = Kerusakan::create([
                            'lokasi_kerusakan' => $request->lokasi_kerusakan[$index + count($request->status)],
                            'komponen' => $request->komponen[$index + count($request->status)],
                            'status' => 'damage',
                            'metode' => $request->metode[$index + count($request->status)],
                            'pengecekan_id' => $pengecekan->id,
                            'perbaikan_id' => $pengecekan->id,
                            'foto_pengecekan' => $path,
                            'foto_pengecekan_name' => $name,
                        ]);
                        KerusakanHistory::create([
                            'lokasi_kerusakan' => $newKerusakan->lokasi_kerusakan,
                            'komponen' => $newKerusakan->komponen,
                            'status' => $newKerusakan->status,
                            'metode' => $newKerusakan->metode,
                            'harga' => $newKerusakan->harga,
                            'foto_pengecekan' => $newKerusakan->foto_pengecekan,
                            'foto_perbaikan' => $newKerusakan->foto_perbaikan,
                            'tanggal_perubahan' => now(),
                            'id_kerusakan' => $newKerusakan->id,
                            'id_perbaikanhistory' => $perbaikanhistory->id,
                            'petikemas_id' => $petikemas->id,
                        ]);
                        $kerusakanall++;
                    }
                }
            } elseif (count($request->status) < $datadamage) {

                $extraKerusakan = $kerusakan->splice(count($request->status) - $datadamage);
                foreach ($extraKerusakan as $extra) {
                    $extra->delete();
                    $datadamage--;
                }

                if ($request->has('status')) {
                    $i = 0;
                    foreach ($kerusakan as $index => $item) {

                        if ($request->hasFile("foto_perbaikan.$i")) {
                            // Store new image
                            $newImagePath = $request->file("foto_perbaikan.$i")->store('uploads', 'public');
                            $newImageName = $request->file('foto_perbaikan')[$i]->getClientOriginalName();
                        } else {
                            // Use existing URL if no new image
                            $newImageName = $item->foto_perbaikan_name;
                            $newImagePath = $item->foto_perbaikan;
                        }

                        $item->update([
                            'lokasi_kerusakan' => $request->lokasi_kerusakan[$i],
                            'komponen' => $request->komponen[$i],
                            'status' => $request->status[$i],
                            'metode' => $request->metode[$i],
                            'foto_perbaikan_name' => $newImageName,
                            'foto_perbaikan' => $newImagePath,
                        ]);

                        $kerusakanall--;
                        $i++;
                    }

                    foreach ($pengecekan->kerusakan as $item) {
                        kerusakanhistory::create([
                            'lokasi_kerusakan' => $item->lokasi_kerusakan,
                            'komponen' => $item->komponen,
                            'status' => $item->status,
                            'metode' => $item->metode,
                            'harga' => $item->harga,
                            'foto_pengecekan' => $item->foto_pengecekan,
                            'foto_perbaikan' => $item->foto_perbaikan,
                            'tanggal_perubahan' => now(),
                            'id_kerusakan' => $item->id,
                            'id_perbaikanhistory' => $perbaikanhistory->id,
                            'petikemas_id' => $petikemas->id,
                        ]);
                    }
                }
                if ($request->hasFile('foto_pengecekan')) {
                    foreach ($request->foto_pengecekan as $index => $item) {
                        $path = $request->file('foto_pengecekan')[$index]->store('uploads', 'public');
                        $name = $request->file('foto_pengecekan')[$index]->getClientOriginalName();
                        $newKerusakan = Kerusakan::create([
                            'lokasi_kerusakan' => $request->lokasi_kerusakan[($index + count($request->status))],
                            'komponen' => $request->komponen[(($index + count($request->status)))],
                            'status' => 'damage',
                            'metode' => $request->metode[(($index + count($request->status)))],
                            'pengecekan_id' => $pengecekan->id,
                            'perbaikan_id' => $pengecekan->id,
                            'foto_pengecekan' => $path,
                            'foto_pengecekan_name' => $name,
                        ]);
                        KerusakanHistory::create([
                            'lokasi_kerusakan' => $newKerusakan->lokasi_kerusakan,
                            'komponen' => $newKerusakan->komponen,
                            'status' => $newKerusakan->status,
                            'metode' => $newKerusakan->metode,
                            'harga' => $newKerusakan->harga,
                            'foto_pengecekan' => $newKerusakan->foto_pengecekan,
                            'foto_perbaikan' => $newKerusakan->foto_perbaikan,
                            'tanggal_perubahan' => now(),
                            'id_kerusakan' => $newKerusakan->id,
                            'id_perbaikanhistory' => $perbaikanhistory->id,
                            'petikemas_id' => $petikemas->id,
                        ]);
                        $kerusakanall++;
                    }
                }
            }
        } else {
            foreach ($kerusakan as $item) {
                $item->delete();
                $kerusakanall--;
            }
            if ($request->foto_pengecekan) {
                foreach ($request->foto_pengecekan as $index => $item) {
                    $path = $request->file('foto_pengecekan')[$index]->store('uploads', 'public');
                    $name = $request->file('foto_pengecekan')[$index]->getClientOriginalName();
                    $newKerusakan = Kerusakan::create([
                        'lokasi_kerusakan' => $request->lokasi_kerusakan[($index)],
                        'komponen' => $request->komponen[(($index))],
                        'status' => 'damage',
                        'metode' => $request->metode[(($index))],
                        'pengecekan_id' => $pengecekan->id,
                        'perbaikan_id' => $pengecekan->id,
                        'foto_pengecekan' => $path,
                        'foto_pengecekan_name' => $name,
                    ]);
                    KerusakanHistory::create([
                        'lokasi_kerusakan' => $newKerusakan->lokasi_kerusakan,
                        'komponen' => $newKerusakan->komponen,
                        'status' => $newKerusakan->status,
                        'metode' => $newKerusakan->metode,
                        'harga' => $newKerusakan->harga,
                        'foto_pengecekan' => $newKerusakan->foto_pengecekan,
                        'foto_perbaikan' => $newKerusakan->foto_perbaikan,
                        'tanggal_perubahan' => now(),
                        'id_kerusakan' => $newKerusakan->id,
                        'id_perbaikanhistory' => $perbaikanhistory->id,
                        'petikemas_id' => $petikemas->id,
                    ]);
                    $datadamage++;
                    $kerusakanall++;
                }
            }
        }
        $perbaikanhistory->update(['jumlah_perbaikan' => $kerusakanall]);

        if ($request->jumlah_perbaikan == 0) {
            $petikemas->update(['status_kondisi' => 'available', 'status_order' => 'true']);
            foreach ($pengecekan->kerusakan as $item) {
                $item->delete();
            }
            $perbaikan->repair = null;
            $perbaikan->tanggal_perbaikan = null;
            $perbaikanhistory->update(['status_kondisi' => 'available']);

            $user = User::all();
            if (auth()->user()->hasRole('direktur')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally') || $item->hasRole('mops')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';

                        notifikasi::create([
                            'message' => 'Peti kemas dengan No. ' . $petikemas->no_petikemas . ' telah diperbaiki. Mohon segera dipindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('repair')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally') || $item->hasRole('mops') || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';

                        notifikasi::create([
                            'message' => 'Peti kemas dengan No. ' . $petikemas->no_petikemas . ' telah diperbaiki. Mohon segera dipindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link
                        ]);
                    }
                }
            } else if (auth()->user()->hasRole('mops')) {
                foreach ($user as $item) {
                    if ($item->hasRole('tally') || $item->hasRole('direktur')) {
                        $link = $item->hasRole(['direktur', 'mops'])
                            ? '/' . $item->roles->first()->name . '/transaksi/' . $transaksiId
                            : '/tally/peti-kemas/';
                        notifikasi::create([
                            'message' => 'Peti kemas dengan No. ' . $petikemas->no_petikemas . ' telah diperbaiki. Mohon segera dipindahkan ke lokasi yang baru.',
                            'tanggal_kirim' => now(),
                            'sender' => auth()->user()->username,
                            'foto_profil' => auth()->user()->foto,
                            'user_id' => $item->id,
                            'link' => $link
                        ]);
                    }
                }
            }
        }

        $perbaikan->update(['jumlah_perbaikan' => $request->jumlah_perbaikan]);
        $pengecekan->update(['jumlah_kerusakan' => $perbaikan->jumlah_perbaikan]);

        return response()->json([
            'success' => true,
            'message' => 'Data Perbaikan Berhasil Diubah!',
        ]);
    }

    public function editpenempatan(Request $request, $id)
    {
        $rules = [
            'operator_alat_berat' => 'required',
            'tally' => 'required',
            'blok' => 'required',
            'row' => 'required',
            'tier' => 'required',
            'lokasi' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($request->lokasi !== "pending" && $request->lokasi !== "out") {
            $validator->sometimes('lokasi', 'required|unique:petikemas,lokasi,' . $id, function ($input) {
                return $input->lokasi !== "pending" && $input->lokasi !== "out";
            });
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $penempatan = penempatan::find($request->id_penempatan);
        $petikemas = petikemas::find($id);
        $user = user::where('username', $request->tally)->first();
        $penempatan->update([
            'tanggal_penempatan' => now(),
            'operator_alat_berat' => $request->operator_alat_berat,
            'tally' => $request->tally,
            'foto_profil' => $user->foto
        ]);
        if ($request->lokasi == 'out' && $petikemas->status_ketersediaan == 'in') {
            $petikemas->update([
                'lokasi' => $request->lokasi,
                'status_ketersediaan' => 'out',
                'tanggal_keluar' => now(),
                'status_order' => 'true',

            ]);
        }
        $petikemas->update([
            'lokasi' => $request->lokasi,
        ]);
        penempatanhistory::create([
            'tanggal_penempatan' => now(),
            'operator_alat_berat' => $request->operator_alat_berat,
            'tally' => $request->tally,
            'lokasi' => $request->lokasi,
            'foto_profil' => $user->foto,
            'status_ketersediaan' => $petikemas->status_ketersediaan,
            'petikemas_id' => $petikemas->id,
            'id_penempatan' => $penempatan->id,
        ]);
        $user = User::all();
        if (auth()->user()->hasRole('direktur')) {
            foreach ($user as $item) {
                if ($item->hasRole('mops')) {
                    $link = $item->hasRole(['direktur', 'mops'])
                        ? '/' . $item->roles->first()->name . '/transaksi/' . $penempatan->transaksi_id
                        : '/kasir/pembayaran/' . $penempatan->transaksi_id;
                    notifikasi::create([
                        'message' => 'Lokasi peti kemas dengan No. ' . $petikemas->no_petikemas . ' telah diperbarui.',
                        'tanggal_kirim' => now(),
                        'sender' => auth()->user()->username,
                        'foto_profil' => auth()->user()->foto,
                        'user_id' => $item->id,
                        'link' => $link
                    ]);
                }
            }
        } else if (auth()->user()->hasRole('mops')) {
            foreach ($user as $item) {
                if ($item->hasRole('direktur')) {
                    $link = $item->hasRole(['direktur', 'mops'])
                        ? '/' . $item->roles->first()->name . '/transaksi/' . $penempatan->transaksi_id
                        : '/kasir/pembayaran/' . $penempatan->transaksi_id;
                    notifikasi::create([
                        'message' => 'Lokasi peti kemas dengan No. ' . $petikemas->no_petikemas . ' telah diperbarui.',
                        'tanggal_kirim' => now(),
                        'sender' => auth()->user()->username,
                        'foto_profil' => auth()->user()->foto,
                        'user_id' => $item->id,
                        'link' => $link
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Penempatan Berhasil Diubah!',
        ]);
    }
}
