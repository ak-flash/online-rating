<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;

class StudentLessons extends Component
{
    public $lesson;
    public $rating;

    public function render()
    {
        $lessons = Student::find($this->lesson['student_id'])
            ->lesson($this->lesson['journal_id'])
            ->orderByDesc('date')
            ->get();

        return view('livewire.student.student-lessons',
            [ 'lessons' => $lessons]);
    }




    public function isReclassed($attendance, $mark1, $mark2)
    {
        $cleared = false;

        if($attendance || $mark1>=3 || $mark2>=3){
            $cleared = true;
        }

        return $cleared;
    }
}
