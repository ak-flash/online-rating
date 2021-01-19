<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;

class StudentMarks extends Component
{
    public $lesson;
    public $rating;

    public function render()
    {
        $lessons = Student::find($this->lesson['student_id'])
            ->study_class($this->lesson['discipline_id'])
            ->getResults();

        return view('livewire.student.student-marks',
            [ 'lessons' => $lessons]);
    }




    public function lessonCleared($attendance, $mark1, $mark2)
    {
        $cleared = false;

        if($attendance || $mark1>=3 || $mark2>=3){
            $cleared = true;
        }

        return $cleared;
    }
}
