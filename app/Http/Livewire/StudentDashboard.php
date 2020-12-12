<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentDashboard extends Component
{
    protected $listeners = ['showMarks'];

    public $showJournal = 1;
    public $showSettings = 0;
    public $showMarks = 0;
    public $student;
    public $study_class;

    public function mount()
    {
        $this->student = Student::findAuthStudent();
    }

    public function render()
    {
        return view('livewire.student-dashboard')->layout('layouts.guest', ['title' => 'Личный кабинет студента ВолгГМУ']);
    }

    public function nav($menu_item){
        if($menu_item=='journal'){
            $this->showJournal = true;
            $this->showSettings = false;
            $this->showMarks = false;
        }

        if($menu_item=='settings'){
            $this->showJournal = false;
            $this->showSettings = true;
            $this->showMarks = false;
        }

        if($menu_item=='marks'){
            $this->showJournal = false;
            $this->showSettings = false;
            $this->showMarks = true;
        }
    }

    public function showMarks($kafedra)
    {
        $this->study_class['student_id'] = $this->student->id;
        $this->study_class['team_id'] = $kafedra;
        $this->nav('marks');
    }
}
