<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Schedule;

class SearchSchedules extends Component
{
    public $source = '';
    public $destination = '';
    public $departure_date = '';

    public function search()
    {
        $query = Schedule::query()->with('bus');

        if ($this->source) {
            $query->where('source', 'like', '%' . $this->source . '%');
        }
        if ($this->destination) {
            $query->where('destination', 'like', '%' . $this->destination . '%');
        }
        if ($this->departure_date) {
            $query->whereDate('departure_time', $this->departure_date);
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.search-schedules', [
            'schedules' => $this->search(),
        ])->layout('layouts.app');
    }
}