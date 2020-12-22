<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
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
            return $q->whereTeamId(Auth::user()->allTeams()[0]->id);
        })->with('faculty')
            ->groupBy('faculty_id', 'course_number', 'group_number')
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
