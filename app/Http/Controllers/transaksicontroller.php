<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\pengecekan;
use App\Models\penghubung;
use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\petikemas;
use Illuminate\Support\Facades\Validator;
use App\Rules\UniqueArrayValues;
use App\Rules\RequriedArrayValues;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

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
        //$transaksi = transaksi::find($id);
        $transaksi = transaksi::with('penghubungs.petikemas')->findOrFail($id);
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
            'jumlah_petikemas' => 'required|numeric|min:1|max:10',
            'no_petikemas' => ['required', 'array', new UniqueArrayValues],
            'jenis_ukuran' => 'required',
            'pelayaran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generate a unique transaction number
        $current_date = now();
        $jenis_kegiatan = $request->jenis_kegiatan == 'impor' ? 'DO.IN' : 'DO.OUT';
        $latest_transaction = Transaksi::latest()->where('jenis_kegiatan', $request->jenis_kegiatan)->first();
        $no_urut = $latest_transaction ? intval(substr($latest_transaction->no_transaksi, 0, 6)) + 1 : 1;
        $nomor_urut = str_pad($no_urut, 6, '0', STR_PAD_LEFT);
        $bulan_tahun = date('mY', strtotime($current_date));
        $no_transaksi = $nomor_urut . '-' . $jenis_kegiatan . '-' . $bulan_tahun;

        // Create and save the transaction
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
        $transaksi->save();
        $transaksi_id = $transaksi->id;
        foreach ($request->no_petikemas as $no_petikemas) {
            $penghubung = new penghubung();
            $penghubung->transaksi_id = $transaksi_id;
            $penghubung->petikemas_id = $no_petikemas;
            $penghubung->save();
            $relasiId = $penghubung->id;
            $pembayaran = new pembayaran();
            $pembayaran->penghubung_id = $relasiId;
            $pembayaran->transaksi_id = $transaksi_id;
            $pembayaran->status_pembayaran = "belum lunas";
            $pembayaran->status_cetak_spk = "belum cetak";
            $pembayaran->save();
            $pengecekan = new pengecekan();
            $pengecekan->penghubung_id = $relasiId;
            $pengecekan->transaksi_id = $transaksi_id;
            $pengecekan->save();
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
            'message' => 'Data Transaksi Berhasil Diubah!',
        ]);
    }
    public function delete(Request $request)
    {

        $transaksi = transaksi::findOrFail($request->id);
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
    public function laporanbulanantransaksi(Request $request)
    {

        $selectedValue = $request->input('jenis_kegiatan');
        $selectedMonth = $request->input('bulan_transaksi');

        $query = Transaksi::query();

        if ($selectedValue) {
            $query->where('jenis_kegiatan', $selectedValue);
        }

        if ($selectedMonth) {
            $query->whereMonth('tanggal_transaksi', date('m', strtotime($selectedMonth)));
        }
        $filteredData = $query->with('penghubungs.petikemas')->get();

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }
        $pdf = PDF::loadView('pdf.laporanbulanantransaksi', [
            'filteredData' => $filteredData,
            'selectedValue' => $selectedValue,
            'selectedMonth' => $selectedMonth,
        ]);
        return $pdf->download('laporan_bulanan_transaksi.pdf');
    }
    public function editentrydata(Request $request, $id)
    {
        $transaksi = transaksi::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'no_petikemas' => ['required', 'array', 'min:1', new UniqueArrayValues, new RequriedArrayValues],
            'jenis_ukuran' => 'required',
            'pelayaran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $penghubung = penghubung::where('transaksi_id', $id)->get(); // Assuming you want to retrieve all penghubung with the given transaksi_id

        foreach ($penghubung as $index => $item) {
            if (isset($request->no_petikemas[$index])) {
                $new_petikemas_id = $request->no_petikemas[$index];

                if ($item->petikemas_id != $new_petikemas_id) {

                    $pembayarans = Pembayaran::where('penghubung_id', $item->id)->get();
                    $pengecekans = Pengecekan::where('penghubung_id', $item->id)->get();
                    foreach ($pembayarans as $pembayaran) {

                        $pembayaran->tanggal_pembayaran = null;
                        $pembayaran->status_pembayaran = "belum lunas";
                        $pembayaran->kasir = null;
                        $pembayaran->metode = null;
                        $pembayaran->status_cetak_spk = "belum cetak";
                        $pembayaran->save();
                    }
                    foreach ($pengecekans as $pengecekan) {
                        $pengecekan->jumlah_kerusakan = null;
                        $pengecekan->kondisi_peti_kemas = null;
                        $pengecekan->tanggal_pengecekan = null;
                        $pengecekan->survey_in = null;
                        $pengecekan->save();
                    }

                    $item->update(['petikemas_id' => $new_petikemas_id]);
                }
            }
        }

        if (count($request->no_petikemas) > count($penghubung)) {
            for ($i = 0; $i < (count($request->no_petikemas) - count($penghubung)); $i++) {

                $new_penghubung = new Penghubung();
                $new_penghubung->petikemas_id = $request->no_petikemas[$i + count($penghubung)];
                $new_penghubung->transaksi_id = $id;
                $new_penghubung->save();
                $new_pembayaran = new Pembayaran();
                $new_pembayaran->penghubung_id = $new_penghubung->id;
                $new_pembayaran->transaksi_id = $id;
                $new_pembayaran->status_cetak_spk = "belum cetak";
                $new_pembayaran->status_pembayaran = "belum lunas";
                $new_pembayaran->save();
                $new_pengecekan = new pengecekan();
                $new_pengecekan->penghubung_id = $new_penghubung->id;
                $new_pengecekan->transaksi_id = $id;
                $new_pengecekan->save();
            }
        }
        // $transaksi->jumlah_petikemas=count($penghubung);
        // $transaksi->save();
        $updated_penghubung_count = penghubung::where('transaksi_id', $id)->count();

        $transaksi->update(['jumlah_petikemas' => $updated_penghubung_count]);

        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Diubah!',

        ]);
    }

    public function deleteentrydata(Request $request)
    {
        $penghubung = penghubung::where('id', $request->id)->first();
        // $penghubung = penghubung::findOrFail($request->id);
        // Get the associated transaksi_id before deletion
        $transaksi_id = $penghubung->transaksi_id;

        // Delete the Penghubung record
        $penghubung->delete();

        // Update the jumlah_petikemas field in the related transaksi record
        $updated_penghubung_count = penghubung::where('transaksi_id', $transaksi_id)->count();

        // Retrieve the transaksi record
        $transaksi = transaksi::where('id', $transaksi_id)->first();

        if ($transaksi) {
            $transaksi->update(['jumlah_petikemas' => $updated_penghubung_count]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Dihapus!',

        ]);
    }

    public function cetakspk(Request $request, $id)
    {
        $status_cetak_spk = $request->input('status');
        $id_penghubung = $request->input('id_penghubung');
        $penghubungs = penghubung::findOrFail($id_penghubung);
        $penghubungs->pembayaran->update(['status_cetak_spk' => $status_cetak_spk]);
        $transaksi = transaksi::with('penghubungs.petikemas')
            ->whereHas('penghubungs', function ($query) use ($id_penghubung) {
                $query->where('id', $id_penghubung);
            })
            ->findOrFail($id);
        $transaksi = transaksi::with(['penghubungs' => function ($query) use ($id_penghubung) {
            $query->where('id', $id_penghubung);
        }, 'penghubungs.petikemas'])
            ->findOrFail($id);

        // Assuming you only need one penghubung, take the first result
        $relatedPenghubung = $transaksi->penghubungs->first();
        $pdf = PDF::loadView('pdf.spk', [
            'transaksi' => $transaksi,
            'penghubung' => $relatedPenghubung,
        ]);

        return $pdf->download('spk_' . $transaksi->no_transaksi . '.pdf');
    }
    public function editpembayaran(Request $request, $id_transaksi)
    {
        $id_penghubung = $request->input('id_penghubung');
        $metode = $request->input('metode');
        $i = 0;
        foreach ($id_penghubung as $id) {

            $pembayaran = pembayaran::where('penghubung_id', $id)->first();
            $pembayaran->metode =  $metode[$i];
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->status_pembayaran = "sudah lunas";
            $pembayaran->save();

            $i++;
        }
        $transaksi = transaksi::with(['penghubungs' => function ($query) use ($id_penghubung) {
            $query->where('id', $id_penghubung);
        }, 'penghubungs.petikemas'])
            ->findOrFail($id_transaksi);
        if ($transaksi->tanggal_transaksi == null) {
            $transaksi->tanggal_transaksi = now();
            $transaksi->save();
        }

        $relatedPenghubung = $transaksi->penghubungs->first();
        $pdf = PDF::loadView('pdf.kwitansi', [
            'transaksi' => $transaksi,
            'penghubung' => $relatedPenghubung,
        ]);
        return $pdf->download('kwitansi' . $transaksi->no_transaksi . '.pdf');
    }

    public function storepengecekan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penghubung' => 'required',
            'jumlah_kerusakan2' => 'required|numeric|min:0|max:10',
            'jenis_ukuran_pengecekan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $pengecekan = pengecekan::where('penghubung_id', $request->id_penghubung)->first();
        $pengecekan->jumlah_kerusakan = $request->jumlah_kerusakan2;
        $pengecekan->kondisi_peti_kemas = $request->jumlah_kerusakan2 > 0 ? 'damage' : 'available';
        $pengecekan->tanggal_pengecekan = now();
        $pengecekan->survey_in = "rizal";
        $pengecekan->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Ditambah!',
        ]);
    }
}
