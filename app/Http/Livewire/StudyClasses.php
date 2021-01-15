<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\StudyClass;
use Journal;
use Livewire\Component;

class StudyClasses extends Component
{
    public $journal;

    public function mount($id)
    {
        $this->journal = Journal::findOrFail($id);
    }

    public function render()
    {

        $study_classes = StudyClass::whereJournalId($this->journal->id)
            ->orderBy('date')
            ->with('students')
            ->get();

        //dd($study_classes->flatMap->students->groupBy('id'));
//        foreach ($study_classes->flatMap->students as $student) {
//            dd($student);
//        }
        return view('livewire.study-classes', ['study_classes' => $study_classes]);
    }
}
