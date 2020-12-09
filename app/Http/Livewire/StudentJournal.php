<?php

namespace App\Http\Livewire;

use App\Models\StudyClass;
use Livewire\Component;

class StudentJournal extends Component
{
    public $faculty_id;

    public function render()
    {
        //$disciplines = StudyClass::where('active', 1)->first();

        return view('livewire.student-journal');
    }
}
