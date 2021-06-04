<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VolunteerInitiative extends Component
{
    public $initiative_id;

    public function render()
    {
        return view('livewire.volunteer-initiative');
    }

    public function send(){
        dd();
    }
}
