<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\petikemas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class transaksicontroller extends Controller
{
    public function index()
    {
        // $transaksi = transaksi::all();
        // return view('pages.transaksi', compact('transaksi'));
        return view('pages.transaksi');
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
        $no_urut = 0;
        $latest_transaction = transaksi::latest()->where('jenis_kegiatan', $request->jenis_kegiatan)->first();
        if ($latest_transaction) {
            $latest_no_transaksi = $latest_transaction->no_transaksi;
            $no_urut = intval(substr($latest_no_transaksi, 0, 6));
        }
        if ($request->jenis_kegiatan == 'impor') {
            $no_urut++;
            $nomor_urut_impor = str_pad($no_urut, 6, '0', STR_PAD_LEFT);
            $jenis_kegiatan = $request->jenis_kegiatan == 'impor' ? 'DO.IN' : 'DO.OUT';
            $bulan_tahun = date('mY', strtotime($current_date));
            $no_transaksi = $nomor_urut_impor . '-' . $jenis_kegiatan . '-' . $bulan_tahun;
        } elseif ($request->jenis_kegiatan == 'ekspor') {
            $no_urut++;
            $nomor_urut_ekspor = str_pad($no_urut, 6, '0', STR_PAD_LEFT);
            $jenis_kegiatan = $request->jenis_kegiatan == 'impor' ? 'DO.IN' : 'DO.OUT';
            $bulan_tahun = date('mY', strtotime($current_date));
            $no_transaksi = $nomor_urut_ekspor . '-' . $jenis_kegiatan . '-' . $bulan_tahun;
        }


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
    public function delete(Request $request)
    {

        $transaksi = transaksi::findOrFail($request->transaction_id);
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
            $query->where('jenis_kegiatan', $selectedValue);
        }

        if ($selectedMonth) {
            $query->whereMonth('tanggal_transaksi', date('m', strtotime($selectedMonth)));
        }

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('no_transaksi', 'like', '%' . $searchTerm . '%')
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
}
