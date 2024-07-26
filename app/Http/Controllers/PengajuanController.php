<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengajuan;
use App\Models\Notifikasi;
use App\Models\User;
use App\Models\Absensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->id();
        $user = auth()->user();
        // Validate common fields
        $validator = Validator::make($request->all(), [
            'jenis_pengajuan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Determine validation rules based on jenis_pengajuan
        if ($request->jenis_pengajuan === 'pengajuan cuti') {
            $validator = Validator::make($request->all(), [
                'alamat_cuti' => 'required|string',
                'mulai_cuti' => 'required|date|after:today',
                'selesai_cuti' => 'required|date|after:mulai_cuti',
                'jenis_cuti' => 'required|string',

            ]);
            if ($request->jenis_cuti == 'lainnya') {
                $validator = Validator::make($request->all(), [
                    'alasan_cuti' => 'required|string',
                ]);
            }
        } elseif ($request->jenis_pengajuan === 'kenaikan gaji') {
            $validator = Validator::make($request->all(), [
                'gaji_sekarang' => 'required|numeric',
                'gaji_diajukan' => 'required|numeric|gt:gaji_sekarang',
                'alasan_kenaikan_gaji' => 'required|string',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the current date and time
        $tanggal_dibuat = Carbon::now();

        // Create the new pengajuan record
        $pengajuan = new Pengajuan();
        $pengajuan->jenis_pengajuan = $request->jenis_pengajuan;
        $pengajuan->tanggal_dibuat = $tanggal_dibuat;
        $pengajuan->user_id = $userId;
        $pengajuan->status = 'pending';
        // Generate PDF based on jenis_pengajuan
        $pdfContent = '';
        $fileName = '';
        $direktur = user::where('jabatan', 'Direktur')->first();
        $data = array_merge($request->all(), ['user' => $user]);
        if ($request->jenis_pengajuan === 'pengajuan cuti') {
            $pdfContent = PDF::loadView('pdf.surat_izin', $data)->output();
            $fileName = 'surat_izin_' . $user->username . '.pdf';
            $pengajuan->mulai_cuti = $request->mulai_cuti;
            $pengajuan->selesai_cuti = $request->selesai_cuti;
        } elseif ($request->jenis_pengajuan === 'kenaikan gaji') {
            $pdfContent = PDF::loadView('pdf.surat_kenaikan_gaji', $data)->output();
            $fileName = 'surat_kenaikangaji_' . $user->username . '.pdf';
        }

        // Store the PDF in storage
        Storage::put('public/uploads/' . $fileName, $pdfContent);

        // Fill the filename and url_file in the pengajuan record
        $pengajuan->file_name = $fileName;
        $pengajuan->url_file = Storage::url('public/uploads/' . $fileName);

        // Save the pengajuan record
        $pengajuan->save();
        notifikasi::create([
            'message' => auth()->user()->username . ' telah membuat pengajuan ' . $request->jenis_pengajuan,
            'tanggal_kirim' => now(),
            'sender' => auth()->user()->username,
            'foto_profil' => auth()->user()->foto,
            'user_id' => 2,
            'link' => '/direktur/pegawai/' . $userId
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data Pengajuan Dbuat!',
        ]);
    }


    public function edit(Request $request)
    {
        // Find the pengajuan record
        $pengajuan = Pengajuan::find($request->id);
        $userId = auth()->id();
        if (!$pengajuan) {
            return response()->json([
                'errors' => ['Pengajuan not found.'],
            ], 404);
        }

        // Validate the input fields
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,acc,tolak,pending',
            'myfile' => 'nullable|file|mimes:pdf|max:2048',
            'myfile_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->status == 'acc') {
            if (!$request->hasFile('myfile')) {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'myfile_name' => ['file harus diubah']
                    ]
                ], 422);
            }
        }

        // Check if a new file is uploaded
        if ($request->hasFile('myfile')) {
            $pengajuan->status = $request->status;
            // Delete the old file from storage
            if (Storage::exists('public/uploads/' . $pengajuan->file_name)) {
                Storage::delete('public/uploads/' . $pengajuan->file_name);
            }

            // Store the new file
            $file = $request->file('myfile');
            $fileName =  $request->status . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/uploads', $fileName);

            // Update the file information in the pengajuan record
            $pengajuan->file_name = $fileName;
            $pengajuan->url_file = Storage::url($filePath);
            $mulai_cuti = Carbon::parse($pengajuan->mulai_cuti);
            $selesai_cuti = Carbon::parse($pengajuan->selesai_cuti);
            if ($request->status == 'acc' && $pengajuan->jenis_pengajuan == 'pengajuan cuti') {
                for ($date = $mulai_cuti->copy(); $date->lte($selesai_cuti); $date->addDay()) {
                    $waktu_masuk = $date->copy()->setTime(8, 30, 0); // Set waktu_masuk to 08:30:00
                    $waktu_pulang = $date->copy()->setTime(17, 0, 0); // Set waktu_pulang to 17:00:00

                    Absensi::create([
                        'waktu_masuk' => $waktu_masuk->toDateTimeString(),
                        'status_masuk' => 'izin',
                        'user_id' => $pengajuan->user_id,
                        'status_pulang' => 'izin',
                        'waktu_pulang' => $waktu_pulang->toDateTimeString(),
                    ]);
                }
            }
        }
        // Save the changes to the database
        $pengajuan->save();
        $user = User::findOrFail($pengajuan->user_id);

        $cleaned = str_replace(['[', ']', '"'], '', $user->getRoleNames());
        if ($request->status == 'acc' || $request->status == 'tolak') {
            notifikasi::create([
                'message' => auth()->user()->username . ' telah mengubah status pengajuan anda menjadi ' . $request->status,
                'tanggal_kirim' => now(),
                'sender' => auth()->user()->username,
                'foto_profil' => auth()->user()->foto,
                'user_id' => $pengajuan->user_id,
                'link' => '/' . $cleaned . '/pegawai'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Pengajuan Diubah!',
        ]);
    }
}
