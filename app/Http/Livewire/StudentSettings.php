<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentSettings extends Component
{
    use WithFileUploads;


    public $student;
    public $email;
    public $password;
    public $photo;
    public $phone;

    protected $rules = [
        'photo' => 'nullable|image|max:1024', // 1MB Max
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'nullable|string|max:20',
        'phone' => 'nullable|string|max:20',
    ];

    protected $messages = [
        'photo.image' => 'Допустима загрузка только файлов jpg, png и т.д.',
        'email.unique' => 'Такой Email уже зарегистрирован на другого пользователя',
        'phone.unique' => 'Такой номер телефона уже зарегистрирован на другого пользователя',
    ];


    public function mount()
    {
        $this->student = auth()->guard('student')->user();
        $this->email = $this->student->email;
        $this->phone = $this->student->phone;
    }

    public function render()
    {
        return view('livewire.student.student-settings')
            ->layout('layouts.student', ['title' => 'Настройки профиля студента ВолгГМУ', 'student' => $this->student]);
    }

    public function save()
    {
        $this->validate([
            'photo' => 'nullable|image|max:1024', // 1MB Max
            'email' => 'required|string|email|max:100|unique:users|unique:students,email,'.optional($this->student)->id,
            'password' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20|unique:students,phone,'.optional($this->student)->id,
        ]);

        $this->student->email = $this->email;
        $this->student->phone = $this->phone;

        if($this->password){
            $this->student->password = Hash::make($this->password);
        }

        if(isset($this->photo)) {
            $studentPhoto = $this->photo->store('public/profile-photos/students');

            $studentPhotoName = explode('/', $studentPhoto);

            $studentPhotoThumbnail = Image::make($this->photo)->fit(200)->save('storage/profile-photos/students/thumbnails/'.$studentPhotoName[3]);

            $this->student->profile_photo_path = $studentPhotoName[3];

        }

        $this->student->save();

        $this->emit('saved');

    }

    public function deleteProfilePhoto()
    {
        Storage::delete('public/'.$this->student->profile_photo_path);
        $this->student->profile_photo_path = null;
        $this->student->save();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
