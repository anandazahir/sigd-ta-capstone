<?php

namespace App\Http\Controllers;

use Rats\Zkteco\Lib\ZKTeco;

use App\Models\User;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function getData()
    {

        $today = Carbon::now()->day;
        $zk = new ZKTeco('192.168.0.201');
        $zk->connect();
        $zk->disableDevice();
        $attendance = $zk->getUser();
        /*$attendanceCollection = collect($attendance);

        // Filter the collection
        $filteredAttendance = $attendanceCollection->filter(function ($item) use ($today) {
            return $item['id'] == '2' && Carbon::parse($item['timestamp'])->day == $today && $item['type'] == 0;
        });*/
        $zk->enableDevice();
        dd($attendance);
    }
}
