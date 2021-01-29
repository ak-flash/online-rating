<?php

namespace App\Http\Livewire;

use App\Models\LessonStudent;
use Livewire\Component;

class EditAttendance extends Component
{
    public $attendance;
    public $lessonStudentId;

    public function mount($lesson_student_id, $attendance)
    {
        $this->lessonStudentId = $lesson_student_id;
        $this->attendance = $attendance;
    }

    public function render()
    {
        return view('livewire.edit-attendance');
    }

    public function save()
    {
        $lesson = LessonStudent::findOrFail($this->lessonStudentId);

        if ($lesson) {

            $lesson->attendance = $this->attendance ?? false;

            $lesson->save();
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName=='attendance'){
            $this->save();
        }
    }
}
