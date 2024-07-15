<?php

namespace App\Http\Controllers;

use Rats\Zkteco\Lib\ZKTeco;

//  1 s't parameter is string $ip Device IP Address
//  2 nd  parameter is integer $port Default: 4370
use App\Models\User;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function getData()
    {

        $today = Carbon::now()->day;
        $zk = new ZKTeco('192.168.1.201');
        $zk->connect();
        $user = user::all();
        $zk->disableDevice();
        $attendance = $zk->getAttendance();
        $attendanceCollection = collect($attendance);

        // Filter the collection
        $filteredAttendance = $attendanceCollection->filter(function ($item) use ($today) {
            return $item['id'] == '2' && Carbon::parse($item['timestamp'])->day == $today && $item['type'] == 0;
        });
        $zk->enableDevice();
        dd($filteredAttendance);
    }
}
