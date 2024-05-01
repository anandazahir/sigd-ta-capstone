<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\petikemas;

class transaksicontroller extends Controller
{
    public function index()
    {
        $transaksi = transaksi::all();
        return view('pages.transaksi', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = transaksi::findOrFail($id);
        return view('pages.transaksi-more', compact('transaksi'));
    }
    public function storeEntryData(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'jenis_kegiatan' => 'required|in:impor,ekspor',
            'perusahaan' => 'required',
            'no_do' => 'required|min:8|unique:transaksis',
            'tanggal_DO_rilis' => 'required|date|before:tanggal_DO_exp',
            'tanggal_DO_exp' => 'required|date',
            'kapal' => 'required|max:255',
            'emkl' => 'required',
            'jumlah_petikemas' => 'required|numeric',
        ]);
        $current_date = now();
        $nomor_urut = str_pad(Transaksi::count() + 1, 6, '0', STR_PAD_LEFT); // Count existing records to determine the next ID
        $jenis_kegiatan = $validatedData['jenis_kegiatan'] == 'impor' ? 'DO.IN' : 'DO.OUT';
        $bulan_tahun = date('mY', strtotime($current_date));
        $no_transaksi = $nomor_urut . '-' . $jenis_kegiatan . '-' . $bulan_tahun;
        $transaksi = new Transaksi();
        $transaksi->jenis_kegiatan = $validatedData['jenis_kegiatan'];
        $transaksi->jenis_kegiatan = $validatedData['jenis_kegiatan'];
        $transaksi->perusahaan = $validatedData['perusahaan'];
        $transaksi->no_do = $validatedData['no_do'];
        $transaksi->tanggal_DO_rilis = $validatedData['tanggal_DO_rilis'];
        $transaksi->tanggal_DO_exp = $validatedData['tanggal_DO_exp'];
        $transaksi->kapal = $validatedData['kapal'];
        $transaksi->emkl = $validatedData['emkl'];
        $transaksi->jumlah_petikemas = $validatedData['jumlah_petikemas'];
        $transaksi->inventory = "Rizal Firdaus";
        $transaksi->no_transaksi = $no_transaksi;
        $transaksi->tgl_transaksi = null;
        $transaksi->kasir = null;
        $transaksi->status_pembayaran = null;
        $transaksi->tgl_pembayaran = null;
        $transaksi->save();
        return redirect()->route('transaksi.entrydatastore')->with('success', 'Transaksi created successfully.');
    }
}
