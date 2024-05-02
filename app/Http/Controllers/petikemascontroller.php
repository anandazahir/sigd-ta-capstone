<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\petikemas;
use App\Models\kerusakan;
use App\Models\penempatan;
use App\Models\pengecekan;
use App\Models\perbaikan;
use App\Models\transaksi;

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
        // Validate the request data
        $validatedData = $request->validate([
            'no_petikemas' => 'required|unique:petikemas',
            'jenis_ukuran' => 'required',
            'pelayaran' => 'required',
        ]);
        $petikemas = new Petikemas();
        $petikemas->no_petikemas = $validatedData['no_petikemas'];
        $petikemas->jenis_ukuran = $validatedData['jenis_ukuran'];
        $petikemas->pelayaran = $validatedData['pelayaran'];
        $petikemas->transaksi_id = 1;
        $petikemas->tanggal_keluar = null;
        $petikemas->tanggal_masuk = null;
        $petikemas->status_kondisi = null;
        $petikemas->status_ketersediaan = null;
        $petikemas->lokasi = null;
        $petikemas->harga = null;
        $petikemas->save();
        return redirect()->route('petikemas.petikemasstore')->with('success', 'Peti Kemas created successfully.');
    }

}
