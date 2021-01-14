<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentDashboard extends Component
{
    protected $listeners = ['showMarks'];

    public $showJournal = 1;
    public $showSettings = 0;
    public $showMarks = 0;
    public $student;
    public $lesson;

    public function mount()
    {
        $this->student = session('student');
    }

    public function render()
    {
        return view('livewire.student.student-dashboard')
            ->layout('layouts.student', ['title' => 'Личный кабинет студента ВолгГМУ']);
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

    public function showMarks($discipline_id)
    {
        $this->lesson['student_id'] = $this->student->id;
        $this->lesson['discipline_id'] = $discipline_id;
        $this->nav('marks');
    }
}
