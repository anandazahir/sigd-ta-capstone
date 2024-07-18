<?php

namespace App\Http\Controllers;

use Rats\Zkteco\Lib\ZKTeco;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Absensi;

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
        if ($jammasuk) {
            $Absensi = Absensi::create([
                'waktu_masuk' => $jammasuk['timestamp'],
                'status_masuk' => ($jammasuk['timestamp'] > strtotime('08:30')) ? 'terlambat' : 'hadir',
                'user_id' => $user->id,
            ]);
        }
        $jamPulang = $attendanceCollection->filter(function ($item) use ( $fourThirtyPM, $user) {
            return $item['id'] == ($user->id + 1) && Carbon::parse($item['timestamp'])->greaterThanOrEqualTo($fourThirtyPM) && $item['type'] == 1;
        })->first();
        if ($jamPulang && $jammasuk) {
           $Absensi->update([
                'waktu_pulang' => $jamPulang['timestamp'],
                'status_pulang' => ($jamPulang['timestamp'] > strtotime('17:30')) ? 'terlambat' : 'hadir',
                'user_id' => $user->id,
            ]);
        }
        dd($Absensi);
    }
}
