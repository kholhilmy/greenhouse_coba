<?php

namespace App\Http\Controllers;

use App\Models\Greenhouse;
use App\Models\JenisTanaman;
use App\Models\PeriodeTanam;
use Illuminate\Http\Request;

class GreenhouseController extends Controller
{
    public function index()
    {
        // Fetch all greenhouses with related sensors and users
        $greenhouses = Greenhouse::with('periodeTanam')->get();
        
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
            'tong' => 'required|string|max:255', 
        ]);
    
        Greenhouse::create([
            'nama_greenhouse' => $attributes['nama_greenhouse'],
            'id' => $attributes['id'],
            'waktu_tanam' => $attributes['waktu_tanam'],
            'id_jenis' => $attributes['nama_jenis'],
            'tong' => $attributes['tong'],
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
            'tong' => 'required|string|max:255',  
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

    public function createPeriodeTanam($id_greenhouse)
    {
        // Temukan greenhouse berdasarkan id
        $greenhouse = Greenhouse::findOrFail($id_greenhouse);

        // Kembalikan data ke view untuk digunakan dalam modal
        return view('greenhouse-manage.create_periode_modal', compact('greenhouse'));
    }

    public function storePeriodeTanam(Request $request, $id_greenhouse)
    {
        // Validasi input
        
        $request->validate([
            'tanggal_tanam' => 'required|date',
            'tanggal_panen' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        // Temukan greenhouse berdasarkan id
        

        // Simpan periode tanam
        PeriodeTanam::create([
            'id_greenhouse' => $id_greenhouse,
            'tanggal_tanam' => $request->tanggal_tanam,
            'tanggal_panen' => $request->tanggal_panen,
            'keterangan' => $request->keterangan,
        ]);
        

        // Redirect ke halaman utama setelah berhasil
        return redirect()->route('greenhouse-manage')->with('success', 'Periode Tanam created successfully.');
    }

    // Update or create the planting period (Periode Tanam) for a greenhouse
    public function updatePeriodeTanam(Request $request, $id_greenhouse)
    {
        // Validate the input data
        $request->validate([
            'tanggal_tanam' => 'required|date',
            'tanggal_panen' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        // Find the greenhouse
        $greenhouse = Greenhouse::findOrFail($id_greenhouse);

        // Create or update the PeriodeTanam for this greenhouse
        $periodeTanam = PeriodeTanam::updateOrCreate(
            ['id_greenhouse' => $id_greenhouse], // Match by greenhouse ID
            [
                'tanggal_tanam' => $request->tanggal_tanam,
                'tanggal_panen' => $request->tanggal_panen,
                'keterangan' => $request->keterangan,
            ]
        );

        // Redirect back with a success message
        return redirect()->route('greenhouse-manage')->with('success', 'Periode Tanam updated successfully.');
    }

    // Show the periode tanam of a specific greenhouse
    public function showPeriodeTanam($id_greenhouse)
    {
        // Fetch greenhouse with related periode tanam
        $greenhouse = Greenhouse::with('periodeTanam')->findOrFail($id_greenhouse);

        return view('greenhouse-manage.view_periode', compact('greenhouse'));
    }

    // Delete the periode tanam
    public function destroyPeriodeTanam($id)
    {
        // Find the periode tanam and delete it
        $periodeTanam = PeriodeTanam::findOrFail($id);
        $periodeTanam->delete();

        return back()->with('success', 'Periode Tanam deleted successfully.');
    }

    public function show($id)
    {
        // Fetch a specific greenhouse with related sensors and user
        $greenhouse = Greenhouse::with(['sensors', 'user'])->findOrFail($id);

        // Return a view with the fetched data
        return view('greenhouses-manage', compact('greenhouse'));
    }
}
