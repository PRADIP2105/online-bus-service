<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::where('operator_id', Auth::id())->get();
        return view('buses.index', compact('buses'));
    }

    public function create()
    {
        return view('buses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'type' => 'required|in:AC,Non-AC',
        ]);

        Bus::create(array_merge($validated, ['operator_id' => Auth::id()]));

        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    public function edit(Bus $bus)
    {
        if ($bus->operator_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('buses.edit', compact('bus'));
    }

    public function update(Request $request, Bus $bus)
    {
        if ($bus->operator_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'type' => 'required|in:AC,Non-AC',
        ]);

        $bus->update($validated);

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    public function destroy(Bus $bus)
    {
        if ($bus->operator_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $bus->delete();
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }
}