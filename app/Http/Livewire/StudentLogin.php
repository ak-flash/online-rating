<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentLogin extends Component
{
    public $document_id;
    public $student;
    public $email;
    public $password;
    public $changeAuthMethod = false;
    public $student_id;
    public $showConfirmation = false;

    protected $rules = [
        'document_id' => 'required|integer',
        'email' => 'required|email',
        'password' => 'required',];

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

        if($this->changeAuthMethod) {
            $this->validate([
                'email' => 'required|email',
                'password' => 'required',
                ]);

            if (Auth::guard('student')->attempt(['email' => $this->email, 'password' => $this->password, 'active' => 1], 1)) {
                $this->redirect(route('student.dashboard'));
            } else {
                $this->addError('password', __("The provided password was incorrect.").' Или вы заблокированы');
            }

        } else {

            $this->validate(['document_id' => 'required|integer']);

            $this->student = Student::findStudent($this->document_id);

            if(is_null($this->student->password)){
                $this->showConfirmation = true;
                return view('livewire.student.student-login');
            }
            else {
                $this->addError('document_id', 'Быстрый вход не возможен! Установлен пароль');
            }

        }


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
