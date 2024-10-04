<?php

namespace App\Http\Controllers;

use App\Models\JenisTanaman;
use App\Models\Greenhouse;
use Illuminate\Http\Request;
use App\Models\User;

class JenisTanamanController extends Controller
{
    public function index()
    {
        // Fetch all jenis tanamans with related greenhouses
        // $jenisTanamans = JenisTanaman::with('greenhouse')->get();
        $jenisTanamans = JenisTanaman::all();

        // Return a view with the fetched data
        return view('jenis-tanaman', compact('jenisTanamans'));
    }

    public function create()
    {
        // Fetch all greenhouses to populate a select dropdown
        $greenhouses = Greenhouse::all();

        return view('greenhouse-manage.addplant', compact('greenhouses'));
    }

    // Store a newly created jenis tanaman in the database
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'tmax_ph' => 'required|numeric',
            'tmin_ph' => 'required|numeric',
            't_suhu' => 'required|numeric',

            't_cahaya' => 'required|numeric',

            'tmax_ketinggian' => 'required|numeric',
            'tmin_ketinggian' => 'required|numeric',
            't_kelembapan' => 'required|numeric',

            'tmax_tds' => 'required|numeric',
            'tmin_tds' => 'required|numeric',
        ]);

        JenisTanaman::create($attributes);

        return redirect()->route('jenis-tanaman')->with('success', 'Jenis Tanaman created successfully.');
    }

    public function show($id_jenis)
    {
        // Fetch a specific jenis tanaman with related greenhouse
        $jenisTanaman = JenisTanaman::with('greenhouse')->findOrFail($id_jenis);

        // Return a view with the fetched data
        return view('jenis_tanaman.show', compact('jenisTanaman'));
    }

    // Show the form for editing the specified jenis tanaman
    public function edit($id_jenis)
    {
        $jenisTanaman = JenisTanaman::findOrFail($id_jenis);
        $greenhouses = Greenhouse::all();

        return view('greenhouse-manage.editplant', compact('jenisTanaman', 'greenhouses'));
    }

    // Update the specified jenis tanaman in the database
    public function update(Request $request, $id_jenis)
    {
        $attributes = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'tmax_ph' => 'required|numeric',
            'tmin_ph' => 'required|numeric',
            't_suhu' => 'required|numeric',

            't_cahaya' => 'required|numeric',

            'tmax_ketinggian' => 'required|numeric',
            'tmin_ketinggian' => 'required|numeric',
            't_kelembapan' => 'required|numeric',

            'tmax_tds' => 'required|numeric',
            'tmin_tds' => 'required|numeric',
        ]);

        $jenisTanaman = JenisTanaman::findOrFail($id_jenis);
        $jenisTanaman->update($attributes);

        return redirect()->route('jenis-tanaman')->with('success', 'Jenis Tanaman updated successfully.');
    }

    // Remove the specified jenis tanaman from the database
    public function destroy($id_jenis)
    {
        $jenisTanaman = JenisTanaman::findOrFail($id_jenis);
        $jenisTanaman->delete();

        return redirect()->route('jenis-tanaman')->with('success', 'Jenis Tanaman deleted successfully.');
    }

    public function getDataThres()
    {
        \Log::info('getDataThres method called'); // Log when the method is called

        // Fetch data from the database
        $jenisTanaman = JenisTanaman::all();

        if ($jenisTanaman->isEmpty()) {
            \Log::info('No data found'); // Log if no data is found
        }

        return response()->json($jenisTanaman); // Return the data as JSON
    }

    

    // public function getDataThres()
    // {
    //     \Log::info('getData method called'); // Check if the method is reached
    //     \Log::info('Fetched data:', $jenisTanaman->toArray());

    //     try {
    //         $jenisTanaman = JenisTanaman::all(); // Fetch data from the database
    //         return response()->json($jenisTanaman);
    //     } catch (\Exception $e) {
    //         \Log::error('Error fetching data: ' . $e->getMessage()); // Log any exceptions
    //         return response()->json(['error' => 'Failed to retrieve data'], 500);
    //     }
    // }

    


}
