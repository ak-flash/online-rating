<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EditUserName extends Component
{
    public $userName;
    public $userId;

    public function mount(User $user)
    {
        $this->userName = $user->name;
        $this->userId = $user->id;
    }


    public function render()
    {
        return view('livewire.edit-user-name');
    }

    public function save()
    {
        $user = User::findOrFail($this->userId);

        if ($this->userName) {

            $user->name = $this->userName;
            $user->save();

        }
    }


}
