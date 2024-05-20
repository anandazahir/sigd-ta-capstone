<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Pembayaran;
use App\Models\Penempatan;
use App\Models\Pengecekan;
use App\Models\Penghubung;
use App\Models\Perbaikan;
use App\Models\petikemas;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;
use App\Rules\UniqueArrayValues;
use App\Rules\RequriedArrayValues;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('pages.transaksi');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('penghubungs.petikemas')->findOrFail($id);
        return view('pages.transaksi-more', compact('transaksi'));
    }

    private function createRelatedRecords($penghubungId, $transaksiId)
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

        Penempatan::create([
            'penghubung_id' => $penghubungId,
            'transaksi_id' => $transaksiId,
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
            'no_petikemas' => ['required', 'array', new UniqueArrayValues],
            'jenis_ukuran' => 'required',
            'pelayaran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $current_date = now();
        $jenis_kegiatan = $request->jenis_kegiatan == 'impor' ? 'DO.IN' : 'DO.OUT';
        $latest_transaction = Transaksi::latest()->where('jenis_kegiatan', $request->jenis_kegiatan)->first();
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
            'inventory' => 'rizal',
            'no_transaksi' => $no_transaksi,
        ]);

        foreach ($request->no_petikemas as $no_petikemas) {
            $penghubung = Penghubung::create([
                'transaksi_id' => $transaksi->id,
                'petikemas_id' => $no_petikemas,
            ]);
            $this->createRelatedRecords($penghubung->id, $transaksi->id);
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
            $rules['no_do'] = 'required|min:8|unique:transaksis,no_do,' . $id;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Diubah!',
        ]);
    }

    public function delete(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->id);
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
            'no_petikemas' => ['required', 'array', 'min:1', new UniqueArrayValues, new RequriedArrayValues],
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
                $newPetikemasId = $noPetikemas[$index];
                if ($item->petikemas_id != $newPetikemasId) {
                    $this->resetRelatedEntries($item->id);
                    $item->update(['petikemas_id' => $newPetikemasId]);
                }
            }
        }

        if (count($noPetikemas) > count($existingPenghubung)) {
            for ($i = 0; $i < (count($noPetikemas) - count($existingPenghubung)); $i++) {
                $new_penghubung = Penghubung::create([
                    'transaksi_id' => $id,
                    'petikemas_id' => $noPetikemas[$i + count($existingPenghubung)],
                ]);

                $this->createRelatedRecords($new_penghubung->id, $id);
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
            'status_pembayaran' => "belum lunas",
            'kasir' => null,
            'metode' => null,
            'status_cetak_spk' => "belum cetak",
        ]);

        Pengecekan::where('penghubung_id', $penghubungId)->update([
            'jumlah_kerusakan' => null,

            'tanggal_pengecekan' => null,
            'survey_in' => null,
        ]);

        $perbaikans = Perbaikan::where('penghubung_id', $penghubungId)->first();

        $perbaikans->update([
            'tanggal_perbaikan' => null,
            'repair' => null,
        ]);
        $kerusakans = Kerusakan::where('perbaikan_id', $perbaikans->id)->get();
        // Loop through each Kerusakan record
        foreach ($kerusakans as $kerusakan) {
            // Check if the file exists and delete it
            if (Storage::disk('public')->exists($kerusakan->foto_pengecekan)) {
                Storage::disk('public')->delete($kerusakan->foto_pengecekan);
            }

            // Delete the Kerusakan record
            $kerusakan->delete();
        }
        Penempatan::where('penghubung_id', $penghubungId)->update([

            'tanggal_penempatan' => null,
            'operator_alat_berat' => null,
            'tally' => null,
        ]);
    }

    public function deleteentrydata(Request $request)
    {
        $penghubungId = $request->id;

        // Use DB transaction for better performance and data consistency
        DB::transaction(function () use ($penghubungId) {
            // Get the associated transaksi_id before deletion
            $penghubung = Penghubung::findOrFail($penghubungId);
            $transaksiId = $penghubung->transaksi_id;

            // Delete the Penghubung record
            $penghubung->delete();

            // Update the jumlah_petikemas field in the related transaksi record
            Transaksi::where('id', $transaksiId)->decrement('jumlah_petikemas');
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

        $transaksi = Transaksi::with(['penghubungs' => function ($query) use ($idPenghubung) {
            $query->where('id', $idPenghubung);
        }, 'penghubungs.pembayaran'])->findOrFail($id);

        $relatedPenghubung = $transaksi->penghubungs->first();

        $relatedPenghubung->pembayaran->update(['status_cetak_spk' => $statusCetakSpk]);

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
            $pembayaran = Pembayaran::where('penghubung_id', $id)->first();
            $pembayaran->metode =  $metode[$i];
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->status_pembayaran = "sudah lunas";
            $pembayaran->save();
            $i++;
        }

        $transaksi = Transaksi::with(['penghubungs' => function ($query) use ($id_penghubung) {
            $query->whereIn('id', $id_penghubung);
        }, 'penghubungs.petikemas'])->findOrFail($id_transaksi);

        if ($transaksi->tanggal_transaksi == null) {
            $transaksi->tanggal_transaksi = now();
            $transaksi->save();
        }

        $relatedPenghubung = $transaksi->penghubungs;

        $pdf = PDF::loadView('pdf.kwitansi', [
            'transaksi' => $transaksi,
            'penghubung' => $relatedPenghubung,
        ]);

        return $pdf->download('kwitansi_' . $transaksi->no_transaksi . '.pdf');
    }

    public function storepengecekan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penghubung' => 'required',
            'jumlah_kerusakan2' => 'required|numeric|min:0|max:10',
            'jenis_ukuran_pengecekan' => 'required',
            'lokasi_kerusakan' => 'array',
            'lokasi_kerusakan.*' => 'string|max:255|unique',
            'komponen' => 'array',
            'komponen.*' => 'string|max:255|unique',
            'metode' => ['array', new UniqueArrayValues, new RequriedArrayValues],
            'metode.*' => 'integer|in:1,2,3',
            'foto_pengecekan' => ['array', new UniqueArrayValues, new RequriedArrayValues],
            'foto_pengecekan.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->input('jumlah_kerusakan2') > 0) {
            $validator->sometimes('lokasi_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });
        
            $validator->sometimes('lokasi_kerusakan.*', 'required', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });

            $validator->sometimes('komponen', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });
        
            $validator->sometimes('komponen.*', 'required', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });

            $validator->sometimes('metode', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });
        
            $validator->sometimes('metode.*', 'required', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });

            $validator->sometimes('foto_pengecekan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });
        
            $validator->sometimes('foto_pengecekan.*', 'required', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $penghubung = Penghubung::findOrFail($request->id_penghubung);

        $petikemas = Petikemas::findOrFail($penghubung->petikemas_id);
        $pengecekan = Pengecekan::where('penghubung_id', $request->id_penghubung)->first();
        $perbaikan = Perbaikan::where('penghubung_id', $request->id_penghubung)->first();
        $pengecekan->update([
            'jumlah_kerusakan' => $request->jumlah_kerusakan2,
            'tanggal_pengecekan' => now(),
            'survey_in' => "rizal",
        ]);
        $petikemas->update(['status_kondisi' => $request->jumlah_kerusakan2 > 0 ? 'damage' : 'available']);

        if ($request->jumlah_kerusakan2 > 0) {
            
            foreach ($request->lokasi_kerusakan as $index => $lokasi) {
                $path = $request->file('foto_pengecekan')[$index]->store('uploads', 'public');
    
                Kerusakan::create([
                    'lokasi_kerusakan' => $lokasi,
                    'komponen' => $request->komponen[$index],
                    'status' => "damage",
                    'metode' => $request->metode[$index],
                    'foto_pengecekan' => $path,
                    'pengecekan_id' => $pengecekan->id,
                    'perbaikan_id' => $perbaikan->id,
                ]);
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
        ]);
    }
    public function editpengecekan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_pengecekan',
            'jumlah_kerusakan2' => 'required|numeric|min:0|max:10',
            'survey_in' => 'required',
            'jenis_ukuran_pengecekan' => 'required',
            'lokasi_kerusakan' => 'required|array',
            'lokasi_kerusakan.*' => 'required|string|max:255',
            'komponen' => 'required|array',
            'komponen.*' => 'required|string|max:255',
            'metode' => 'required|array',
            'metode.*' => 'required|integer|in:1,2,3',
            'foto_pengecekan' => 'required|array',
            'foto_pengecekan.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pengecekan = pengecekan::with('kerusakan')->findOrFail($request->id_pengecekan);
        $kerusakan = $pengecekan->kerusakan;
        $penghubung = Penghubung::findOrFail($request->id_penghubung);
        $petikemas = Petikemas::findOrFail($penghubung->petikemas_id);

        $pengecekan->update([
            'jumlah_kerusakan' => $request->jumlah_kerusakan2,
            'tanggal_pengecekan' => now(),
            'survey_in' => $request->survey_in,
        ]);

        $petikemas->update(['status_kondisi' => $request->jumlah_kerusakan2 > 0 ? 'damage' : 'available']);

        foreach ($kerusakan as $index => $item) {

            if (Storage::disk('public')->exists($kerusakan->foto_pengecekan)) {
                Storage::disk('public')->delete($kerusakan->foto_pengecekan);
                $path = $request->file('foto_pengecekan')[$index]->store('uploads', 'public');
            }
            $item->update([
                'lokasi_kerusakan' => $request->lokasi_kerusakan[$index],
                'komponen' => $request->komponen[$index],
                'status' => "damage",
                'metode' => $request->metode[$index],
                'foto_pengecekan' => $path,
            ]);
        }
        if ($request->jumlah_kerusakan2 > count($kerusakan)) {
            for ($i = 0; $i < ($request->jumlah_kerusakan2 - count($kerusakan)); $i++) {
                $newpath = $request->file('foto_pengecekan')[$i + count($kerusakan)]->store('uploads', 'public');
                Kerusakan::create([
                    'lokasi_kerusakan' => $request->lokasi_kerusakan[$i + count($kerusakan)],
                    'komponen' => $request->komponen[$i + count($kerusakan)],
                    'status' => "damage",
                    'metode' => $request->metode[$i + count($kerusakan)],
                    'foto_pengecekan' => $newpath,
                    'pengecekan_id' => $pengecekan->id,
                    'perbaikan_id' => $pengecekan->id,
                ]);
            }
        } else if ($request->jumlah_kerusakan2 < count($kerusakan)) {
            $lastKerusakan = Kerusakan::orderBy('id', 'desc')->take($request->jumlah_kerusakan2)->get();
            foreach ($lastKerusakan as $kerusakan) {
                if (Storage::disk('public')->exists($kerusakan->foto_pengecekan)) {
                    Storage::disk('public')->delete($kerusakan->foto_pengecekan);
                }
                $kerusakan->delete();
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Diubah!',
        ]);
    }
}
