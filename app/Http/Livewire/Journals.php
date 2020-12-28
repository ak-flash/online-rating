<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Journals extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $showPersonalGroups = true;

    public function render()
    {
        $personal_groups = $this->showPersonalGroups;

        $lessons = Lesson::when($personal_groups, function ($q, $personal_groups) {
            return $q->whereUserId(Auth::id());
        }, function ($q) {
            //return $q->whereDepartmentId(Auth::user()->department);
        })->with('faculty')
            ->paginate($this->perPage);

        return view('livewire.journals', [
            'lessons' => $lessons,
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
