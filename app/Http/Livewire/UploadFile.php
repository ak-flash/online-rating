<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;


class UploadFile extends Component
{
    use WithFileUploads;

    public $file;

    public function uploadPhoto()
    {   

        $this->validate([
            'file' => 'image|max:1024', 
        ]);
        
        $this->file->store('photos');
    }
}
