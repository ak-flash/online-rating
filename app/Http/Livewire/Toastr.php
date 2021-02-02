<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toastr extends Component
{
    protected $listeners = ['show-toast' => 'setToast'];

    public array $alertTypeClasses = [
        'success' => ' bg-green-600 text-white',
        'warning' => ' bg-orange-500 text-white',
        'danger' => ' bg-red-500 text-white',
        'info' => ' bg-blue-500 text-white',
    ];

    public string $title = 'Выполнено';
    public string $message = 'Notification Message';
    public string $alertType = 'success';

    public function setToast ($title, $message, $alertType)
    {
        $this->title = $title!='' ? $title : 'Выполнено';
        $this->message = $message;
        $this->alertType = $alertType;


        $this->dispatchBrowserEvent('toast-message-show');
    }

    public function render()
    {
        return view('livewire.toastr');
    }
}
