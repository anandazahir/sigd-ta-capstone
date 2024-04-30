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
    public function store(Request $request)
    {
        $request->validate([
            'jenis_petikemas' => 'required',
            '' => 'nullable',
        ]);

        petikemas::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
}
