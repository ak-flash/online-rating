<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;

class StudentMarks extends Component
{
    public $studyclass;


    public function render()
    {
        $edited_by = [];
        // Collect all classes
        //$marks = StudyClass::with('student')->get();
        $classes = Student::find($this->studyclass['student_id'])
            ->study_class($this->studyclass['team_id'])->getResults();

        foreach ($classes as $class) {
            $edited_by_users[] = $class->pivot->user_id;
        }

        if(!empty($edited_by_users)){
            $edited_by = User::select(['id', 'name'])->find(array_unique($edited_by_users));
            $edited_by = $edited_by->pluck('name', 'id');
        }



        //dd($edited_by);
        return view('livewire.student-marks', [ 'classes' => $classes, 'edited_by' => $edited_by ]);
    }

    public function getShortName($name): string
    {
        $name = explode(' ', $name);

        $last_name = $name[0];
        $first_name = mb_substr($name[1], 0,1);
        $middle_name = mb_substr($name[2], 0,1);

        return $last_name.' '.$first_name.'. '.$middle_name.'.';
    }
}
