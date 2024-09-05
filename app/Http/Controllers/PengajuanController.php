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
       

        $validator = Validator::make($request->all(), [
            'alamat_cuti' => 'required|string',
            'mulai_cuti' => 'required|date|after:today',
            'selesai_cuti' => 'required|date|after:mulai_cuti',
            'jenis_cuti' => 'required|string',
            'staus'
        ]);
        if ($request->jenis_cuti == 'cuti tahunan') {
            $validator = Validator::make($request->all(), [
                'alasan_cuti' => 'required|string',
            ]);
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the current date and time
        $tanggal_dibuat = Carbon::now();

        // Create the new pengajuan record
        $pengajuan = new Pengajuan();
        $pengajuan->jenis_cuti = $request->jenis_cuti;
        $pengajuan->tanggal_dibuat = $tanggal_dibuat;
        $pengajuan->user_id = $userId;
        $pengajuan->status = 'pending';
        $pengajuan->mulai_cuti = $request->mulai_cuti;
        $pengajuan->selesai_cuti = $request->selesai_cuti;
        $pengajuan->alasan_cuti = $request->alasan_cuti;
        $pengajuan->save();
        $request->status = $pengajuan->status;
        // Generate PDF based on jenis_pengajuan
        $pdfContent = '';
        $fileName = '';
        $direktur = user::where('jabatan', 'Direktur')->first();
        $data = array_merge( ['direktur' => $direktur], ['pengajuan'=>$pengajuan]);
       
        $pdfContent = PDF::loadView('pdf.surat_izin', $data)->output();
        $fileName = 'surat_izin_' . $user->username . '.pdf';
        

        // Store the PDF in storage
        Storage::put('public/uploads/' . $fileName, $pdfContent);

        // Fill the filename and url_file in the pengajuan record
        $pengajuan->file_name = $fileName;
        $pengajuan->url_file = Storage::url('public/uploads/' . $fileName);

        // Save the pengajuan record
        $pengajuan->save();
        $user->jumlah_cuti--;
        $user->save();
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
        $user = User::findOrFail($pengajuan->user_id);
        $direktur = auth()->user();
        if (!$pengajuan) {
            return response()->json([
                'errors' => ['Pengajuan not found.'],
            ], 404);
        }

        // Validate the input fields
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,acc,tolak,pending',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $pengajuan->status = $request->status;
        $pengajuan->save();

        if ($request->status == 'acc') {
            // Save the image to storage
            $imagePath = 'public/ttd_rizal.png'; // Ensure this path is correct
            $pengajuan->sign_acc = $imagePath;

            // Generate PDF
           
            /*$data = array_merge( ['pengajuan' => $pengajuan], ['direktur'=>$direktur]);
            $pdfContent = PDF::loadView('pdf.surat_izin', $data)->output();
            $fileName = $pengajuan->status . '_surat_izin_' . $user->username . '.pdf';

            // Store the PDF in storage
            Storage::put('public/uploads/' . $fileName, $pdfContent);

            // Fill the filename and url_file in the cuti record
            $pengajuan->file_name = $fileName;
            $pengajuan->url_file = Storage::url('public/uploads/' . $fileName);*/
            $mulai_cuti = Carbon::parse($pengajuan->mulai_cuti);
            $selesai_cuti = Carbon::parse($pengajuan->selesai_cuti);
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
        }else{
            if ($user->jumlah_cuti < 3) {
                $user->jumlah_cuti++;
            }
        }

        // Save the changes to the database
        $pengajuan->save();
        $user->save();

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
