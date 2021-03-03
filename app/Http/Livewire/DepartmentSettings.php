<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DepartmentSettings extends Component
{
    public function render()
    {
        return view('livewire.department-settings');
    }


    public function store()
    {
        dd('33');
    }

    public function inviteUser()
    {
        dd('33');
    }
}
