<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\petikemas;

class transaksicontroller extends Controller
{
    public function index()
    {
        $transaksi = transaksi::all();

        return view('pages.transaksi', compact('transaksi'));
    }

    public function show($id)
    {
        // Temukan item berdasarkan ID
        $transaksi = transaksi::findOrFail($id);

        // Kembalikan tampilan dengan data item
        return view('pages.transaksi-more', compact('transaksi'));
    }
}
