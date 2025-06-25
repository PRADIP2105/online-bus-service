<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with('bus');

        if ($request->source) {
            $query->where('source', 'like', '%' . $request->source . '%');
        }

        if ($request->destination) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        if ($request->date) {
            $query->whereDate('departure_time', $request->date);
        }

        return response()->json($query->get());
    }
}