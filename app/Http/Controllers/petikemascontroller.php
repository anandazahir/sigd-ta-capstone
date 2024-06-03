<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\petikemas;
use App\Models\kerusakan;
use App\Models\penempatan;
use App\Models\pengecekan;
use App\Models\perbaikan;
use App\Models\transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class petikemascontroller extends Controller
{
    public function index()
    {
        $petikemas = petikemas::all();
        return view('pages.petikemas', compact('petikemas'));
    }

    public function show($id)
    {
        $petikemas = Petikemas::with('pengecekanhistories', 'perbaikanhistories')->findOrFail($id);
        return view('pages.petikemas-more', compact('petikemas'));
    }

    public function kerusakanhistory(Request $request)
    {
        $id_pengecekan = $request->input('id_pengecekan');
        $pengecekan = pengecekan::with('kerusakan')->findOrFail($id_pengecekan);
        $kerusakan = $pengecekan->kerusakan;
        return response()->json([
            'kerusakan' => $kerusakan,
            'pengecekan' => $pengecekan,
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
        $data = $query->get();
        $perPage = 3;
        $filteredData = $query->paginate($perPage);

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
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
}
