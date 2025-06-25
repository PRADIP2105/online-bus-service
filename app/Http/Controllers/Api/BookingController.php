<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Booking;
use App\Notifications\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'seat_number' => 'required|integer',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);
        $bookedSeats = Booking::where('schedule_id', $request->schedule_id)->pluck('seat_number')->toArray();

        if (in_array($request->seat_number, $bookedSeats)) {
            return response()->json(['error' => 'Seat already booked'], 422);
        }

        if ($request->seat_number < 1 || $request->seat_number > $schedule->bus->capacity) {
            return response()->json(['error' => 'Invalid seat number'], 422);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'seat_number' => $request->seat_number,
            'total_price' => $schedule->price,
            'status' => 'confirmed',
        ]);

        $schedule->decrement('available_seats');
        Auth::user()->notify(new BookingConfirmation($booking));

        return response()->json(['message' => 'Booking created', 'booking' => $booking], 201);
    }
}