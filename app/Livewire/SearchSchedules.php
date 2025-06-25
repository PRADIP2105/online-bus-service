<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Support\Carbon;

class SearchSchedules extends Component
{
    public $source = '';
    public $destination = '';
    public $date = '';
    public $schedules;

    public function mount()
    {
        $this->date = Carbon::today()->format('Y-m-d');
        $this->search();
    }

    public function search()
    {
        $query = Schedule::query()
            ->where('departure_time', '>=', Carbon::parse($this->date)->startOfDay())
            ->where('departure_time', '<=', Carbon::parse($this->date)->endOfDay());

        if ($this->source) {
            $query->where('source', 'like', '%' . $this->source . '%');
        }

        if ($this->destination) {
            $query->where('destination', 'like', '%' . $this->destination . '%');
        }

        $this->schedules = $query->with('bus')->get();
    }

    public function render()
    {
        return view('livewire.search-schedules');
    }
}