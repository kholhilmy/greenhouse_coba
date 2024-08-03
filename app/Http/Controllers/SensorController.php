<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Greenhouse;
use App\Models\User;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        // Fetch all sensors with related greenhouses
        // $sensors = Sensor::all();

        $greenhouses = Greenhouse::all();
        $sensors = Sensor::whereIn('id_greenhouse', $greenhouses->pluck('id_greenhouse'))->get();
        

        // Return a view with the fetched data
        return view('dashboard', compact('greenhouses', 'sensors'));
    }

    public function getData()
    {
        // $sensors = Sensor::all();
        $sensors = Sensor::latest('created_at')->take(10)->get();
        return response()->json($sensors);
    }

    public function show($id)
    {
        // Fetch a specific sensor with related greenhouse
        $sensor = Sensor::with('greenhouse')->findOrFail($id);

        // Return a view with the fetched data
        return view('sensors.show', compact('sensor'));
    }
}

