<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin|Operator']);
    }

    public function index()
    {
        $schedules = Schedule::with('bus')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $buses = Bus::where('operator_id', Auth::id())->get();
        return view('schedules.create', compact('buses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'source' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
        ]);

        Schedule::create($request->all());
        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $buses = Bus::where('operator_id', Auth::id())->get();
        return view('schedules.edit', compact('schedule', 'buses'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'source' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
        ]);

        $schedule->update($request->all());
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}