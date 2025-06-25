<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\Booking;
use App\Notifications\BookingConfirmation;
use Illuminate\Support\Facades\Auth;

class CreateBooking extends Component
{
    public $scheduleId;
    public $schedule;
    public $seatNumber;
    public $availableSeats = [];

    public function mount($scheduleId)
    {
        $this->scheduleId = $scheduleId;
        $this->schedule = Schedule::findOrFail($scheduleId);
        $this->loadAvailableSeats();
    }

    public function loadAvailableSeats()
    {
        $bookedSeats = Booking::where('schedule_id', $this->scheduleId)->pluck('seat_number')->toArray();
        $this->availableSeats = array_diff(range(1, $this->schedule->bus->capacity), $bookedSeats);
    }

    public function book()
    {
        $this->validate([
            'seatNumber' => 'required|integer|in:' . implode(',', $this->availableSeats),
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $this->scheduleId,
            'seat_number' => $this->seatNumber,
            'total_price' => $this->schedule->price,
            'status' => 'confirmed',
        ]);

        $this->schedule->decrement('available_seats');
        Auth::user()->notify(new BookingConfirmation($booking));

        $this->loadAvailableSeats();
        session()->flash('success', 'Booking confirmed! Check your email.');
    }

    public function render()
    {
        return view('livewire.create-booking');
    }
}