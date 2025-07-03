<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class SearchBusController extends Controller
{
    public function index(Request $request)
    {
        $schedules = [];
        if ($request->filled(['start_location', 'end_location', 'departure_date'])) {
            $schedules = Schedule::where('start_location', $request->start_location)
                ->where('end_location', $request->end_location)
                ->whereDate('departure_time', $request->departure_date)
                ->with('bus')
                ->get();
        }
        return view('search.bus', compact('schedules'));
    }
}