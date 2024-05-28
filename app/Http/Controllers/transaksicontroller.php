<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Pembayaran;
use App\Models\Penempatan;
use App\Models\Pengecekan;
use App\Models\pengecekanhistory;
use App\Models\Penghubung;
use App\Models\Perbaikan;
use App\Models\petikemas;

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

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = transaksi::paginate(3);
        return view('pages.transaksi', compact('transaksi'));
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
                $newPetikemasId = $noPetikemas[$index];
                if ($item->petikemas_id != $newPetikemasId) {
                    $this->resetRelatedEntries($item->id);
                    $item->update(['petikemas_id' => $newPetikemasId]);
                }
            }
        }

        if (count($noPetikemas) > count($existingPenghubung)) {
            for ($i = 0; $i < count($noPetikemas) - count($existingPenghubung); $i++) {
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
            'status_pembayaran' => 'belum lunas',
            'kasir' => null,
            'metode' => null,
            'status_cetak_spk' => 'belum cetak',
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

        $transaksi = Transaksi::with([
            'penghubungs' => function ($query) use ($idPenghubung) {
                $query->where('id', $idPenghubung);
            },
            'penghubungs.pembayaran',
        ])->findOrFail($id);

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
            $pembayaran->metode = $metode[$i];
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->status_pembayaran = 'sudah lunas';
            $pembayaran->save();
            $i++;
        }

        $transaksi = Transaksi::with([
            'penghubungs' => function ($query) use ($id_penghubung) {
                $query->whereIn('id', $id_penghubung);
            },
            'penghubungs.petikemas',
        ])->findOrFail($id_transaksi);

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
            'lokasi_kerusakan' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'komponen' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'metodes' => ['array', new UniqueArrayValueFoto('metode_value'), new RequiredArrayValuesFoto('metode_value')],
            'foto_pengecekan' => ['array', new UniqueArrayValueFoto('foto_pengecekan_name'), new RequiredArrayValuesFoto('foto_pengecekan_name')],
            'foto_pengecekan.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_pengecekan_name' => ['array', new RequiredArrayValues()],
            'metode_value' => ['array', new RequiredArrayValues()]
        ]);

        if ($request->input('jumlah_kerusakan2') > 0) {
            $validator->sometimes('foto_pengecekan_name', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });



            $validator->sometimes('lokasi_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });


            $validator->sometimes('komponen', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });



            $validator->sometimes('metodes', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });


            $validator->sometimes('foto_pengecekan', 'required|array', function ($input) {
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
        $perbaikan->jumlah_perbaikan = $request->jumlah_kerusakan2;
        $pengecekan->update([
            'jumlah_kerusakan' => $request->jumlah_kerusakan2,
            'tanggal_pengecekan' => now(),
            'survey_in' => 'rizal',
        ]);

        $petikemas->update(['status_kondisi' => $request->jumlah_kerusakan2 > 0 ? 'damage' : 'available']);
        $perbaikan->update(['jumlah_perbaikan' => $pengecekan->jumlah_kerusakan]);
        if ($request->jumlah_kerusakan2 > 0) {
            foreach ($request->lokasi_kerusakan as $index => $lokasi) {
                $path = $request->file('foto_pengecekan')[$index]->store('uploads', 'public');
                $newFileName = $request->file('foto_pengecekan')[$index]->getClientOriginalName();
                Kerusakan::create([
                    'lokasi_kerusakan' => $lokasi,
                    'komponen' => $request->komponen[$index],
                    'status' => 'damage',
                    'metode' => $request->metodes[$index],
                    'foto_pengecekan' => $path,
                    'foto_pengecekan_name' => $newFileName,
                    'pengecekan_id' => $pengecekan->id,
                    'perbaikan_id' => $perbaikan->id,
                ]);
            }
        }
        pengecekanhistory::create([
            'jumlah_kerusakan' => $pengecekan->jumlah_kerusakan,
            'tanggal_pengecekan' => $pengecekan->tanggal_pengecekan,
            'survey_in' => $pengecekan->survey_in,
            'petikemas_id' => $petikemas->id,
            'status_kondisi' => $petikemas->status_kondisi
        ]);
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

    public function editpengecekan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url_foto' => 'array',
            'id_penghubung' => 'required',
            'jumlah_kerusakan3' => 'required|numeric|min:0|max:10',
            'lokasi_kerusakan' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'komponen' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'metode' => ['array', new UniqueArrayValueFoto('metode_value'), new RequiredArrayValuesFoto('metode_value')],
            'foto_pengecekan' => ['array', new UniqueArrayValueFoto('foto_pengecekan_name'), new RequiredArrayValuesFoto('foto_pengecekan_name')],
            'foto_pengecekan.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_pengecekan_name' => ['array', new RequiredArrayValues()],
            'metode_value' => ['array', new RequiredArrayValues()]
        ]);

        if ($request->input('jumlah_kerusakan2') > 0) {
            $validator->sometimes('foto_pengecekan_name', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });



            $validator->sometimes('lokasi_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });


            $validator->sometimes('komponen', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });



            $validator->sometimes('metodes', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });


            $validator->sometimes('foto_pengecekan', 'required|array', function ($input) {
                return $input->jumlah_kerusakan2 > 0;
            });
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Fetching related models
        $pengecekan = pengecekan::with('kerusakan')->findOrFail($request->id_pengecekan);
        $perbaikan = perbaikan::findOrFail($request->id_pengecekan);

        $kerusakan = $pengecekan->kerusakan;
        $penghubung = Penghubung::findOrFail($request->id_penghubung);
        $petikemas = Petikemas::findOrFail($penghubung->petikemas_id);

        // Updating pengecekan
        $pengecekan->update([
            'jumlah_kerusakan' => $request->jumlah_kerusakan3,
            'tanggal_pengecekan' => now(),
            'survey_in' => $request->survey_in2,
        ]);
        // Updating petikemas status
        $petikemas->update(['status_kondisi' => $request->jumlah_kerusakan3 > 0 ? 'damage' : 'available']);
        if ($request->jumlah_kerusakan3 == count($kerusakan)) {
            // Updating kerusakan and handling file uploads
            foreach ($kerusakan as $index => $item) {
                // Cek apakah ada file gambar baru yang diunggah
                if ($request->hasFile("foto_pengecekan.$index")) {
                    // Hapus gambar lama jika ada
                    if (Storage::disk('public')->exists($item->foto_pengecekan)) {
                        Storage::disk('public')->delete($item->foto_pengecekan);
                    }

                    // Simpan gambar baru
                    $newImagePath = $request->file("foto_pengecekan.$index")->store('uploads', 'public');
                    $newImageName = $request->file('foto_pengecekan')[$index]->getClientOriginalName();
                    // Perbarui dengan gambar baru
                    $item->update(['foto_pengecekan' => $newImagePath]);
                } else {
                    // Jika tidak ada file gambar baru, gunakan url_foto yang ada
                    $newImagePath = $request->url_foto[$index];
                    $newImageName = $item->foto_pengecekan_name;
                }

                // Perbarui data lainnya
                $item->update([
                    'lokasi_kerusakan' => $request->lokasi_kerusakan[$index],
                    'komponen' => $request->komponen[$index],
                    'status' => 'damage',
                    'metode' => $request->metode[$index],
                    'foto_pengecekan_name' => $newImageName,
                    'foto_pengecekan' => $newImagePath, // Gunakan nilai yang sudah ditentukan
                ]);
            }
        }

        // Handling new kerusakan
        if ($request->jumlah_kerusakan3 > count($kerusakan)) {
            for ($i = 0; $i < $request->jumlah_kerusakan3 - count($kerusakan); $i++) {
                $path = $request->file('foto_pengecekan')[$i + count($kerusakan)]->store('uploads', 'public');
                $name = $request->file('foto_pengecekan')[$i + count($kerusakan)]->getClientOriginalName();
                Kerusakan::create([
                    'lokasi_kerusakan' => $request->lokasi_kerusakan[$i + count($kerusakan)],
                    'komponen' => $request->komponen[$i + count($kerusakan)],
                    'status' => 'damage',
                    'metode' => $request->metode[$i + count($kerusakan)],
                    'pengecekan_id' => $pengecekan->id,
                    'perbaikan_id' => $pengecekan->id,
                    'foto_pengecekan' => $path,
                    'foto_pengecekan_name' => $name,
                ]);
            }
        } elseif ($request->jumlah_kerusakan3 < count($kerusakan)) {
            $extraKerusakan = $kerusakan->splice($request->jumlah_kerusakan3);
            foreach ($extraKerusakan as $extra) {
                if (Storage::disk('public')->exists($extra->foto_pengecekan)) {
                    Storage::disk('public')->delete($extra->foto_pengecekan);
                }
                $extra->delete();
            }
        }
        if ($request->jumlah_kerusakan3 == 0) {
            $perbaikan->update(['repair' => null, 'estimator' => null, 'tanggal_perbaikan' => null]);
        }
        $perbaikan->update(['jumlah_perbaikan' => $pengecekan->jumlah_kerusakan]);
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


        // Check if the file exists and delete it
        if (Storage::disk('public')->exists($kerusakans->foto_pengecekan)) {
            Storage::disk('public')->delete($kerusakans->foto_pengecekan);
        }

        // Delete the Kerusakan record
        $kerusakans->delete();


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
            'harga_kerusakan' => ['array', new UniqueArrayValues(), new RequiredArrayValues()],
            'harga_kerusakan.*' => 'numeric|min:1000',
            'status' => ['array', new RequiredArrayValuesFoto('status_value')],
            'foto_perbaikan' => ['array', new UniqueArrayValueFoto('foto_perbaikan_name'), new RequiredArrayValuesFoto('foto_perbaikan_name')],
            'foto_perbaikan.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_perbaikan_name' => ['array', new RequiredArrayValues()],
            'metode_value' => ['array', new RequiredArrayValues()],
            'status_value' => ['array', new RequiredArrayValues()]
        ]);

        if ($request->input('jumlah_perbaikan') > 0) {
            $validator->sometimes('foto_perbaikan_name', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });

            $validator->sometimes('lokasi_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });

            $validator->sometimes('komponen', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });

            $validator->sometimes('metode', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });

            $validator->sometimes('harga_kerusakan', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });

            $validator->sometimes('status', 'required|array', function ($input) {
                return $input->jumlah_perbaikan > 0;
            });
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Fetching related models
        $perbaikan = perbaikan::findOrFail($request->id_perbaikan);
        $pengecekan = pengecekan::with('kerusakan')->findOrFail($request->id_perbaikan);
        $kerusakan = $pengecekan->kerusakan;
        $penghubung = Penghubung::findOrFail($request->id_penghubung);
        $petikemas = Petikemas::findOrFail($penghubung->petikemas_id);

        // Updating perbaikan
        $perbaikan->update([
            'repair' => $request->repair,
            'estimator' => "rizal",
            'jumlah_perbaikan' => $request->jumlah_perbaikan
        ]);

        // Updating petikemas status

        if ($request->jumlah_perbaikan == count($kerusakan)) {
            // Updating kerusakan and handling file uploads
            foreach ($kerusakan as $index => $item) {
                // Cek apakah ada file gambar baru yang diunggah
                if ($request->hasFile("foto_perbaikan.$index")) {
                    // Hapus gambar lama jika ada
                    if (!empty($item->foto_perbaikan) && Storage::disk('public')->exists($item->foto_perbaikan)) {
                        // Delete the old photo if it exists
                        Storage::disk('public')->delete($item->foto_perbaikan);
                    }
                    // Simpan gambar baru
                    $newImagePath = $request->file("foto_perbaikan")[$index]->store('uploads', 'public');
                    $newImageName = $request->file('foto_perbaikan')[$index]->getClientOriginalName();
                    // Perbarui dengan gambar baru
                    $item->update(['foto_perbaikan' => $newImagePath]);
                } else {
                    // Jika tidak ada file gambar baru, gunakan url_foto yang ada
                    $newImagePath = $request->url_foto[$index];
                    $newImageName = $item->foto_perbaikan_name;
                }

                // Perbarui data lainnya
                $item->update([
                    'lokasi_kerusakan' => $request->lokasi_kerusakan[$index],
                    'komponen' => $request->komponen[$index],
                    'harga' => $request->harga_kerusakan[$index],
                    'status' => $request->status[$index],
                    'metode' => $request->metode[$index],
                    'foto_perbaikan_name' => $newImageName,
                    'foto_perbaikan' => $newImagePath, // Gunakan nilai yang sudah ditentukan
                ]);
            }
        }

        // Handling new kerusakan
        if ($request->jumlah_perbaikan > count($kerusakan)) {
            for ($i = 0; $i < $request->jumlah_perbaikan - count($kerusakan); $i++) {
                $path = $request->file('foto_perbaikan')[$i + count($kerusakan)]->store('uploads', 'public');
                $name = $request->file('foto_perbaikan')[$i + count($kerusakan)]->getClientOriginalName();
                Kerusakan::create([
                    'lokasi_kerusakan' => $request->lokasi_kerusakan[$i + count($kerusakan)],
                    'komponen' => $request->komponen[$i + count($kerusakan)],
                    'harga' => $request->harga_kerusakan[$i + count($kerusakan)],
                    'status' => $request->status[$i + count($kerusakan)],
                    'metode' => $request->metode[$i + count($kerusakan)],
                    'pengecekan_id' => $pengecekan->id,
                    'perbaikan_id' => $pengecekan->id,
                    'foto_pengecekan' => $path,
                    'foto_pengecekan_name' => $name,
                ]);
            }
        } elseif ($request->jumlah_perbaikan < count($kerusakan)) {
            $extraKerusakan = $kerusakan->splice($request->jumlah_perbaikan);
            foreach ($extraKerusakan as $extra) {
                if (Storage::disk('public')->exists($extra->foto_perbaikan)) {
                    Storage::disk('public')->delete($extra->foto_perbaikan);
                }
                $extra->delete();
            }
        }
        $datadamage = $kerusakan->where('status', 'damage')
            ->count();
        if ($datadamage <= 0) {
            $petikemas->update(['status_kondisi' =>  'available']);
            $perbaikan->update([
                'tanggal_perbaikan' => now()
            ]);
        }
        if ($request->jumlah_perbaikan == 0) {
            $perbaikan->update(['repair' => null, 'estimator' => null, 'tanggal_perbaikan' => null]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data Perbaikan Berhasil Diubah!',
        ]);
    }
}
