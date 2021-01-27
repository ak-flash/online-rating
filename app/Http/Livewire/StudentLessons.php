<?php

namespace App\Http\Livewire;

use App\Models\Journal;
use App\Models\Student;
use App\Models\User;
use Livewire\Component;

class StudentLessons extends Component
{
    public $lesson;
    public $rating;
    public $changeView = false;

    public function render()
    {
        $lessons = Student::find($this->lesson['student_id'])
            ->lesson($this->lesson['journal_id'])

            ->orderByDesc('date')
            ->get();

        $allTopicsCount = Journal::find($this->lesson['journal_id'])->discipline->topics->count();

        return view('livewire.student.student-lessons',
            [
                'lessons' => $lessons,
                'allTopicsCount' => $allTopicsCount,
            ]
        );
    }




    public function isReclassed($attendance, $mark1, $mark2)
    {
        $cleared = false;

        if(!$attendance && ($mark1>=3 || $mark2>=3)){
            $cleared = true;
        }

        return $cleared;
    }
}
