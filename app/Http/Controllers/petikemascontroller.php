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
        $petikemas = petikemas::findOrFail($id);
        return view('pages.petikemas-more', compact('petikemas'));
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
        $petikemas->transaksi_id = null;
        $petikemas->tanggal_keluar = null;
        $petikemas->tanggal_masuk = now();
        $petikemas->harga = $harga;
        $petikemas->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Dibuat!',
        ]);
    }

    public function delete($id)
    {
        $petikemas = petikemas::findOrFail($id);
        $petikemas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Dihapus!',
        ]);
    }

    public function filter(Request $request)
    {
        // Retrieve input values from the request
        $searchTerm = $request->input('search');

        // Start building the query
        $query = petikemas::query();

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('no_petikemas', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jenis_ukuran', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pelayaran', 'like', '%' . $searchTerm . '%');
            });
        }

        // Paginate the results with 10 items per page
        $perPage = 3;
        $filteredData = $query->paginate($perPage);

        // Generate delete route and form delete HTML
        $deleteRoute = route('petikemas.delete', ':id');
        $formDeleteHtml = '';
        foreach ($filteredData as $petikemas) {
            $route = str_replace(':id', $petikemas->id, $deleteRoute);
            $formDeleteHtml = view("components.modal-form-delete", ['route' => $route])->render();
        }

        // Check if filtered data is empty
        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        // Return JSON response with paginated data
        return response()->json([
            'Data' => $filteredData->items(), // Data for the current page
            'deleteComponent' => $formDeleteHtml,
            'meta' => [
                'current_page' => $filteredData->currentPage(),
                'last_page' => $filteredData->lastPage(),
                'per_page' => $filteredData->perPage(),
            ],
        ]);
    }
}
