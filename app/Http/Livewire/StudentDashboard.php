<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentDashboard extends Component
{
    protected $listeners = ['setLessonStudentIds'];

    public $showJournal = 1;
    public $showSettings = 0;
    public $showLessons = 0;
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
        if($menu_item=='journals'){
            $this->showJournal = true;
            $this->showSettings = false;
            $this->showLessons = false;
        }

        if($menu_item=='settings'){
            $this->showJournal = false;
            $this->showSettings = true;
            $this->showLessons = false;
        }

        if($menu_item=='lessons'){
            $this->showJournal = false;
            $this->showSettings = false;
            $this->showLessons = true;
        }
    }

    public function setLessonStudentIds($journalId)
    {
        $this->lesson['student_id'] = $this->student->id;
        $this->lesson['journal_id'] = $journalId;
        $this->nav('lessons');
    }
}
