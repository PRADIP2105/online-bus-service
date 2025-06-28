<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::where('operator_id', Auth::id())->with('reviews')->get();
        return view('buses.index', compact('buses'));
    }

    public function create()
    {
        return view('buses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
        ]);

        Bus::create([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'operator_id' => Auth::id(),
        ]);

        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    public function edit(Bus $bus)
    {
        $this->authorize('update', $bus);
        return view('buses.edit', compact('bus'));
    }

    public function update(Request $request, Bus $bus)
    {
        $this->authorize('update', $bus);
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
        ]);

        $bus->update([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    public function destroy(Bus $bus)
    {
        $this->authorize('delete', $bus);
        $bus->delete();
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }
}