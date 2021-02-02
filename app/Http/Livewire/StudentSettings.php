<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentSettings extends Component
{
    use WithFileUploads;

    public $student;
    public $email;
    public $password;
    public $photo;

    protected $rules = [
        'photo' => 'nullable|image|max:1024', // 1MB Max
        'email' => 'required|string|email|max:255',
    ];

    protected $messages = [
        'photo.image' => 'Допустима загрузка только файлов jpg, png и т.д.',
    ];

    public function mount()
    {
        $this->student = session('student');
        $this->email = $this->student->email;
    }

    public function render()
    {
        return view('livewire.student.student-settings');
    }

    public function save()
    {
        $this->validate();

        $this->student->email = $this->email;

        if($this->password){
            $this->student->password = Hash::make($this->password);
        }

        if (isset($this->photo)) {
            $studentPhoto = $this->photo->store('public/profile-photos/students');

            $this->student->profile_photo_path = str_replace("public/", "", $studentPhoto);

            session('student')->profile_photo_path  = $this->student->profile_photo_path;
        }

        $this->student->save();

        $this->emit('saved');

        return redirect()->route('student.settings');
    }

    public function deleteProfilePhoto()
    {
        $this->student->profile_photo_path = null;
        session('student')->profile_photo_path  = null;
        $this->student->save();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
