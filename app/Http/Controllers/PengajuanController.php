<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengajuan;
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
                'mulai_cuti' => 'required|date|after_or_equal:today',
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
                'gaji_diajukan' => 'required|numeric',
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
        $data = array_merge($request->all(), ['user' => $user]);
        if ($request->jenis_pengajuan === 'pengajuan cuti') {
            $pdfContent = PDF::loadView('pdf.surat_izin', $data)->output();
            $fileName = 'surat_izin_' . $user->username . '.pdf';
        } elseif ($request->jenis_pengajuan === 'kenaikan gaji') {
            $pdfContent = PDF::loadView('pdf.surat_kenaikangaji', $data)->output();
            $fileName = 'surat_kenaikangaji_' . $user->username . '.pdf';
        }

        // Store the PDF in storage
        Storage::put('public/uploads/' . $fileName, $pdfContent);

        // Fill the filename and url_file in the pengajuan record
        $pengajuan->file_name = $fileName;
        $pengajuan->url_file = Storage::url('public/uploads/' . $fileName);

        // Save the pengajuan record
        $pengajuan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Pengajuan Dbuat!',
        ]);
    }


    public function edit(Request $request)
    {
        // Find the pengajuan record
        $pengajuan = Pengajuan::find($request->id);

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

        // Update the status
        $pengajuan->status = $request->status;

        // Check if a new file is uploaded
        if ($request->hasFile('myfile')) {
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
        }

        // Save the changes to the database
        $pengajuan->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Pengajuan Diubah!',
        ]);
    }
}
