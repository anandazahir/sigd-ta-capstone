<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\petikemas;
use App\Models\kerusakan;
use App\Models\penempatan;
use App\Models\pengecekan;
use App\Models\perbaikan;
use App\Models\transaksi;

class petikemascontroller extends Controller
{
    public function index()
    {
        // $petikemas = petikemas::all();
        $petikemas = petikemas::find(1);
        $transaksis = $petikemas->transaksi;

        return view('pages.petikemas', compact('transaksis'));
    }

}
