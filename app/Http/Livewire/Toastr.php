<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toastr extends Component
{
    protected $listeners = ['show-toast' => 'setToast'];

    public $alertTypeClasses = [
        'success' => ' bg-green-600 text-white',
        'warning' => ' bg-orange-500 text-white',
        'danger' => ' bg-red-500 text-white',
    ];

    public $message = 'Notification Message';
    public $alertType = 'success';

    public function setToast ($message, $alertType)
    {
        $this->message = $message;
        $this->alertType = $alertType;


        $this->dispatchBrowserEvent('toast-message-show');
    }

    public function render()
    {
        return view('livewire.toastr');
    }
}
