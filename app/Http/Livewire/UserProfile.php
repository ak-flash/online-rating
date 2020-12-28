<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $position_id, $name, $email;
    public $photo;

    public function render()
    {

        $this->user = auth()->user();

        $this->name = $this->user->name;
        $this->position_id = $this->user->position_id;
        $this->email = $this->user->email;

        return view('livewire.user-profile');
    }

    public function uploadPhoto()
    {

        $this->validate([
            'photo' => 'image|max:1024',
        ]);

        $this->photo->store('photos');
    }
}
