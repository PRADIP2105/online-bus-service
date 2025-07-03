<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::whereHas('bus', function ($query) {
            $query->where('operator_id', Auth::id());
        })->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $buses = Bus::where('operator_id', Auth::id())->get();
        return view('schedules.create', compact('buses'));
    }

    public function store(Request $request)
    {
        \Log::info('Schedule store request data:', $request->all());

        $validated = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'start_location' => 'required|string|max:255',
            'end_location' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            $schedule = Schedule::create($validated);
            \Log::info('Schedule created:', $schedule->toArray());
        } catch (\Exception $e) {
            \Log::error('Schedule creation failed: ' . $e->getMessage());
            return redirect()->route('schedules.create')->with('error', 'Failed to create schedule: ' . $e->getMessage());
        }

        return redirect()->route('schedules.manage')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        if ($schedule->bus->operator_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $buses = Bus::where('operator_id', Auth::id())->get();
        return view('schedules.edit', compact('schedule', 'buses'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule->bus->operator_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'start_location' => 'required|string|max:255',
            'end_location' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.manage')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->bus->operator_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $schedule->delete();
        return redirect()->route('schedules.manage')->with('success', 'Schedule deleted successfully.');
    }
}