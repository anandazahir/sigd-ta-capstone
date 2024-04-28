<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\petikemas;

class petikemascontroller extends Controller
{
    public function index()
    {
        $petikemas = petikemas::all();

        return view('pages.petikemas', compact('petikemas'));
    }
}
