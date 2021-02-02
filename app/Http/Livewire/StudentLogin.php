<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentLogin extends Component
{
    public $document_id;
    public $student;
    public $student_id;

    public $showConfirmation = false;

    protected $rules = [
        'document_id' => 'required|integer',
    ];

    protected $messages = [
        'required' => 'Необходимо заполнить',
        'integer' => 'Только цифры',
    ];

    public function render()
    {
        return view('livewire.student.student-login')
            ->layout('layouts.guest');
    }


    public function find_profile() {

        $this->validate();

        $this->student = Student::findStudent($this->document_id);

        $this->showConfirmation = true;

        return view('livewire.student.student-login');
    }

    public function confirm() {

        Auth::guard('student')->loginUsingId($this->student->id);

        /*if (Auth::guard('student')->attempt(['document_id' => $this->document_id])) {
            dd(Auth::user());
        }*/


        return $this->redirect(route('student.dashboard'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
