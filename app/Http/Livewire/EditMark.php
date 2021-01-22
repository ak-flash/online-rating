<?php

namespace App\Http\Livewire;

use App\Models\LessonStudent;
use Livewire\Component;

class EditMark extends Component
{
    public $studentMark;
    public $lessonStudentId;
    public $type;

    public function mount($lesson_student_id, $mark, $type)
    {
        $this->lessonStudentId = $lesson_student_id;
        $this->type = $type;
        $this->studentMark = $mark;
    }

    public function render()
    {
        return view('livewire.edit-mark');
    }

    public function save()
    {
        $lesson = LessonStudent::findOrFail($this->lessonStudentId);

        $type = (string)$this->type;

        if ($this->studentMark) {

            $lesson->$type = $this->studentMark;

            $lesson->save();

        }
    }

    public function updated($propertyName)
    {
        if ($propertyName=='studentMark'){
            $this->save();
        }
    }
}
