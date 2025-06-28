<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bus;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CreateReview extends Component
{
    public $busId;
    public $bus;
    public $rating = 5;
    public $comment = '';

    public function mount($bus)
    {
        $this->busId = $bus;
        $this->bus = Bus::findOrFail($bus);
    }

    public function save()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'bus_id' => $this->busId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        session()->flash('success', 'Review submitted successfully!');
        return redirect()->route('reviews.index', ['bus' => $this->busId]);
    }

    public function render()
    {
        $reviews = Review::where('bus_id', $this->busId)->with('user')->latest()->get();
        return view('livewire.create-review', [
            'reviews' => $reviews,
        ])->layout('layouts.app');
    }
}