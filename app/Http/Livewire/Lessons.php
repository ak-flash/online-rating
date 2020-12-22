<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Lessons extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public function render()
    {

    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
