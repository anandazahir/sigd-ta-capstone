<?php

namespace App\Http\Controllers;

use Rats\Zkteco\Lib\ZKTeco;

use App\Models\User;
use App\Models\Absensihistory;
use Carbon\Carbon;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AbsensiController extends Controller
{
    public function getData()
    {

        $today = Carbon::now()->day;
        $now = Carbon::now();
        $fourThirtyPM = Carbon::today()->setTime(16, 30);
        $zk = new ZKTeco('192.168.0.201');
        $zk->connect();
        $zk->disableDevice();

        $attendance = $zk->getAttendance();
        $zk->enableDevice();
        $zk->disconnect();
        $user = auth()->user();

        $attendanceCollection = collect($attendance);

        // Filter the collection
        $jammasuk = $attendanceCollection->filter(function ($item) use ($today, $user) {
            return $item['id'] == ($user->id + 1) && Carbon::parse($item['timestamp'])->day == $today && $item['type'] == 0;
        })->first();
        $Absensi = null;
        $AbsensiCheck = Absensi::where('user_id', $user->id)->whereDay('waktu_masuk', carbon::now()->day)->first();
        if ($jammasuk && $AbsensiCheck == null) {
            $Absensi = Absensi::create([
                'waktu_masuk' => $jammasuk['timestamp'],
                'status_masuk' => ($jammasuk['timestamp'] < strtotime('08:30')) ? 'hadir' : 'terlambat',
                'user_id' => $user->id,
            ]);
        }
        $jamPulang = $attendanceCollection->filter(function ($item) use ($fourThirtyPM, $user) {
            return $item['id'] == ($user->id + 1) && Carbon::parse($item['timestamp'])->greaterThanOrEqualTo($fourThirtyPM) && $item['type'] == 1;
        })->first();
        if ($jamPulang && $jammasuk && $AbsensiCheck->waktu_pulang == null) {
            $AbsensiCheck->update([
                'waktu_pulang' => $jamPulang['timestamp'],
                'status_pulang' => ($jamPulang['timestamp'] > strtotime('17:30')) ? 'terlambat' : 'hadir',
                'user_id' => $user->id,
            ]);
        }
        $role = auth()->user()->getRoleNames();
        $cleaned = str_replace(['[', ']', '"'], '', $role);
        return redirect('/' . $cleaned . '/pegawai');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'waktu_masuk' => 'required|date_format:H:i',
            'keterangan_masuk' => 'required|string',
            'waktu_pulang' => 'required|date_format:H:i',
            'keterangan_pulang' => 'required|string',
        ]);

        // Custom validation logic for time constraints
        if ($request->keterangan_masuk == 'hadir') {
            if ($request->waktu_masuk < '06:00' || $request->waktu_masuk > '08:30') {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'waktu_masuk' => ['waktu masuk yang hadir harus diantara jam 06:00 - 08:30.']
                    ]
                ], 422);
            }
        } else if ($request->keterangan_masuk == 'terlambat' && $request->waktu_masuk < '08:30') {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'waktu_masuk' => ['waktu masuk yang terlambat harus setelah jam 08:30.']
                ]
            ], 422);
        }

        if ($request->keterangan_pulang == 'hadir') {
            $waktuPulang = $request->waktu_pulang;
            if ($request->waktu_pulang < '16:30' || $request->waktu_pulang > '17:30') {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'waktu_pulang' => ['waktu pulang yang hadir harus diantara jam 16:30 - 17:30.']
                    ]
                ], 422);
            }
        } else if ($request->keterangan_pulang == 'terlambat' &&  $request->waktu_pulang < '17:30') {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'waktu_pulang' => ['waktu pulang yang terlambat harus setelah jam 17:30.']
                ]
            ], 422);
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $absensi = Absensi::findOrFail($id);

        // Extract the existing date part
        $dateMasuk = Carbon::parse($absensi->waktu_masuk)->format('Y-m-d');
        $datePulang = Carbon::parse($absensi->waktu_pulang)->format('Y-m-d');

        // Combine the existing date with the new time
        $absensi->waktu_masuk = $dateMasuk . ' ' . $request->waktu_masuk . ':00';
        $absensi->status_masuk = $request->keterangan_masuk;
        $absensi->waktu_pulang = $datePulang . ' ' . $request->waktu_pulang . ':00';
        $absensi->status_pulang = $request->keterangan_pulang;

        $absensi->save();
        Absensihistory::create(
            [
                'waktu_absensi'=>now(),
                'waktu_perubahan' => now(),
                'user' => Auth()->user()->username,
                'absensi_id' => $absensi->id,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Data Absensi Berhasil Diubah!'
        ]);
    }
    public function getDataLog($id)
    {
        $logabsensi = Absensihistory::where('absensi_id', $id)->get();
        if ($logabsensi->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }
        return response()->json($logabsensi);
    }
}
