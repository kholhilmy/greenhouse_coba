<?php

namespace App\Http\Controllers;

use App\Models\Greenhouse;
use App\Models\JenisTanaman;
use Illuminate\Http\Request;

class GreenhouseController extends Controller
{
    public function index()
    {
        // Fetch all greenhouses with related sensors and users
        $greenhouses = Greenhouse::all();

        
        

        // Return a view with the fetched data
        return view('greenhouse-manage', compact('greenhouses'));
    }

    public function create() {
        $jenisTanamans = JenisTanaman::all();
        return view('greenhouse-manage.create_g', compact('jenisTanamans'));
    }

    // Store a newly created greenhouse in the database
    public function store(Request $request) {
        
        $attributes = $request->validate([
            'nama_greenhouse' => 'required|string|max:255',
            'id' => 'required|string|max:255',  // Validates that 'id' exists in 'users' table
            'waktu_tanam' => 'required|date',
            'nama_jenis' => 'required|exists:jenis_tanamans,id_jenis',  // Foreign key validation
        ]);
    
        Greenhouse::create([
            'nama_greenhouse' => $attributes['nama_greenhouse'],
            'id' => $attributes['id'],
            'waktu_tanam' => $attributes['waktu_tanam'],
            'id_jenis' => $attributes['nama_jenis'],
        ]);
    
        return redirect()->route('greenhouse-manage')->with('success', 'Greenhouse created successfully.');
    }

    public function show1($id_greenhouse)
    {
        // Fetch a specific greenhouse with related sensors and user
        $greenhouse = Greenhouse::findOrFail($id_greenhouse);
        

        // Return a view with the fetched data
        return view('greenhouse-manage.view', compact('greenhouse'));
    }

    // Show the form for editing the specified greenhouse
    public function edit($id_greenhouse) {
        $greenhouses = Greenhouse::findOrFail($id_greenhouse);
        $jenisTanamans = JenisTanaman::all();
        return view('greenhouse-manage.edit', compact('greenhouses','jenisTanamans'));
    }

    // Update the specified greenhouse in the database
    public function update(Request $request, $id_greenhouse) {
        $attributes = $request->validate([
            'nama_greenhouse' => 'required|string|max:255',
            'id' => 'required|string|max:255',  // Validates that 'id' exists in 'users' table
            'waktu_tanam' => 'required|date',
            'id_jenis' => 'required|exists:jenis_tanamans,id_jenis',
        ]);

        $greenhouses = Greenhouse::findOrFail($id_greenhouse);
        $greenhouses->update($attributes);

        return redirect()->route('greenhouse-manage')->with('success', 'Greenhouse updated successfully.');
    }

    // Remove the specified greenhouse from the database
    public function destroy($id_greenhouse) {
        $greenhouses = Greenhouse::findOrFail($id_greenhouse);
        $greenhouses->delete();

        return redirect()->route('greenhouse-manage')->with('success', 'Greenhouse deleted successfully.');
    }
    // public function create() {
    //     return view('greenhouse-manage.create_g');
    // }

    // public function store(Request $request) {
    //     $attributes = $request->validate([
    //         'nama_greenhouse' => 'required|string|max:255',
    //         'jenis_tanaman' => 'required|string|max:255',
    //         'id' => 'required|string|max:255',
    //         'waktu_tanam' => 'required|date',
    //     ]);

    //     $greenhouse = Greenhouse::create($attributes);

    //     return redirect()->route('greenhouse-manage')->with('success', 'Greenhouse created successfully.');
    // }

    // public function edit($id_greenhouse) {
    //     $greenhouse = Greenhouse::findOrFail($id_greenhouse);
    //     // $greenhouses = Greenhouse::all();
    //     return view('greenhouse-manage.edit', compact('greenhouse'));
    // }

    // public function update(Request $request, $id_greenhouse) {
    //     $attributes = $request->validate([
    //         'nama_greenhouse' => 'required|string|max:255',
    //         'jenis_tanaman' => 'required|string|max:255',
    //         'waktu_tanam' => 'required|date',
    //     ]);

    //     $greenhouse = Greenhouse::findOrFail($id_greenhouse);
    //     $greenhouse->update($attributes);

    //     return redirect()->route('greenhouse-manage')->with('success', 'Greenhouse updated successfully.');
    // }

    // // Remove the specified greenhouse from the database
    // public function destroy($id_greenhouse) {
    //     $greenhouse = Greenhouse::findOrFail($id_greenhouse);
    //     $greenhouse->delete();

    //     return redirect()->route('greenhouse-manage')->with('success', 'Greenhouse deleted successfully.');
    // }


    public function show($id)
    {
        // Fetch a specific greenhouse with related sensors and user
        $greenhouse = Greenhouse::with(['sensors', 'user'])->findOrFail($id);

        // Return a view with the fetched data
        return view('greenhouses-manage', compact('greenhouse'));
    }
}

