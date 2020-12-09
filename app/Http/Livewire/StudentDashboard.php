<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentDashboard extends Component
{
    public $showJournal = 1;
    public $showSettings = 0;
    public $student;

    public function mount()
    {
        $this->student = Student::findAuthStudent();
    }

    public function render()
    {


        //dd($this->student);
        return view('livewire.student-dashboard')->layout('layouts.guest', ['title' => 'Личный кабинет студента ВолгГМУ']);
    }

    public function nav($menu_item){
        if($menu_item=='journal'){
            $this->showJournal = true;
            $this->showSettings = false;
        }

        if($menu_item=='settings'){
            $this->showJournal = false;
            $this->showSettings = true;
        }
    }
}
