<?php

namespace App\Http\Livewire;

use App\Models\StudentStudyClass;
use Livewire\Component;

class EditMark extends Component
{
    public $studentMark;
    public $lessonId;
    public $type;

    public function mount($lesson_id, $mark, $type)
    {
        $this->lessonId = $lesson_id;
        $this->type = $type;
        $this->studentMark = $mark;
    }

    public function render()
    {
        return view('livewire.edit-mark');
    }

    public function save()
    {
        $lesson = StudentStudyClass::findOrFail($this->lessonId);

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
