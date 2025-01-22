<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AlertController extends Controller
{
    public function index()
    {
        // Fetch the last 5 alerts, ordered by creation time
        $alerts = DB::table('alerts')->orderBy('created_at', 'desc')->take(5)->get();

        // Return the view with alerts data
        return view('layouts.navbars.auth.nav', compact('alerts'));
    }
}