<?php

namespace App\Http\Livewire;

use App\Models\Student;
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
        return view('livewire.student-login')->layout('layouts.guest', ['title' => 'Войти в онлайн журнал']);
    }


    public function find_profile() {

        $this->validate();

        $this->student = Student::findStudent($this->document_id);

        $this->showConfirmation = true;

        return view('livewire.student-login');
    }

    public function confirm() {

        //$this->student->faculty_name = $this->student->faculty->name;

/*        $student = [
            'id' => $this->student->id,
            'document_id' =>$this->student->document_id,
            'last_name' => $this->student->last_name,
            'first_name' => $this->student->first_name,
            'middle_name' => $this->student->middle_name,
            'faculty_name' => $this->student->faculty->name,
            'faculty_id' => $this->student->faculty_id,
            'course_number' => $this->student->course_number,
            'group_number' => $this->student->group_number,
            'email' => $this->student->email,
        ];*/
        session(['student' => $this->student]);
        /*session(['document_id' => $this->student->document_id]);
        session(['last_name' => $this->student->last_name]);
        session(['first_name' => $this->student->first_name]);
        session(['middle_name' => $this->student->middle_name]);
        session(['faculty_id' => $this->student->faculty_id]);
        session(['course_number' => $this->student->course_number]);
        session(['group_number' => $this->student->group_number]);
        session(['email' => $this->student->email]);*/


        return $this->redirect(route('student.dashboard'));
    }
}
