<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\petikemas;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'jenis_kegiatan' => 'required|in:impor,ekspor',
            'perusahaan' => 'required',
            'no_do' => 'required|min:8|unique:transaksis',
            'tanggal_DO_rilis' => 'required|date|before:tanggal_DO_exp',
            'tanggal_DO_exp' => 'required|date',
            'kapal' => 'required|max:255',
            'emkl' => 'required',
            'jumlah_petikemas' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $current_date = now();
        $nomor_urut = str_pad(Transaksi::count() + 1, 6, '0', STR_PAD_LEFT); // Count existing records to determine the next ID
        $jenis_kegiatan = $request->jenis_kegiatan == 'impor' ? 'DO.IN' : 'DO.OUT';
        $bulan_tahun = date('mY', strtotime($current_date));
        $no_transaksi = $nomor_urut . '-' . $jenis_kegiatan . '-' . $bulan_tahun;

        $transaksi = new Transaksi();
        $transaksi->jenis_kegiatan = $request->jenis_kegiatan;
        $transaksi->perusahaan = $request->perusahaan;
        $transaksi->no_do = $request->no_do;
        $transaksi->tanggal_DO_rilis = $request->tanggal_DO_rilis;
        $transaksi->tanggal_DO_exp = $request->tanggal_DO_exp;
        $transaksi->kapal = $request->kapal;
        $transaksi->emkl = $request->emkl;
        $transaksi->jumlah_petikemas = $request->jumlah_petikemas;
        $transaksi->inventory = "rizal";
        $transaksi->no_transaksi = $no_transaksi;
        $transaksi->tanggal_transaksi = null;
        $transaksi->kasir = null;
        $transaksi->status_pembayaran = null;
        $transaksi->tanggal_pembayaran = null;
        $transaksi->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Dibuat!',
        ]);
    }

    public function edit($id)
    {
        $transaksi = transaksi::findOrFail($id);
        return view('components.form-edit-entrydata', compact('transaksi'));
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
            'jumlah_petikemas' => 'required|numeric',
            'kasir' => 'required',
            'inventory' => 'required',
            'tanggal_transaksi' => 'required',
        ];
        if ($request->has('no_do')) {
            $rules['no_do'] = 'required|min:8|unique:transaksis,no_do,' . $request->input('no_do') . ',no_do';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $transaksi = transaksi::findOrFail($id);
        if ($request->jenis_kegiatan == 'impor') {
            $transaksi->no_transaksi = str_replace('DO.OUT', 'DO.IN', $transaksi->no_transaksi);
        } elseif ($request->jenis_kegiatan == 'ekspor') {
            $transaksi->no_transaksi = str_replace('DO.IN', 'DO.OUT', $transaksi->no_transaksi);
        }
        $transaksi->save();
        $transaksi->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Diupdate!',
        ]);
    }
}
