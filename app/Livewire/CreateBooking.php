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

    public function mount($schedule)
    {
        $this->scheduleId = $schedule;
        $this->schedule = Schedule::findOrFail($schedule);
    }

    public function book()
    {
        $this->validate([
            'seatNumber' => [
                'required',
                'integer',
                'min:1',
                'max:' . $this->schedule->bus->capacity,
                function ($attribute, $value, $fail) {
                    if (Booking::where('schedule_id', $this->scheduleId)->where('seat_number', $value)->exists()) {
                        $fail('This seat is already booked.');
                    }
                },
            ],
        ]);

        if ($this->schedule->available_seats < 1) {
            session()->flash('error', 'No seats available.');
            return;
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $this->scheduleId,
            'seat_number' => $this->seatNumber,
            'total_price' => $this->schedule->price,
            'status' => 'confirmed',
        ]);

        $this->schedule->decrement('available_seats');
        Auth::user()->notify(new BookingConfirmation($booking));

        session()->flash('success', 'Booking confirmed!');
        return redirect()->route('bookings.index');
    }

    public function render()
    {
        return view('livewire.create-booking')->layout('layouts.app');
    }
}