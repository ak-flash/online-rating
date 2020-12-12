<?php

namespace App\Http\Livewire;

use App\Models\StudyClass;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StudentJournal extends Component
{
    use WithPagination;

    //public $disciplines;
    public $student;
    public $search = '';
    public $showPerPage = 5;

    public function render()
    {
        //, DB::raw('COUNT(team_id) as count')
        $disciplines = StudyClass::with('team')->with('user')
            ->where('faculty_id', $this->student->faculty_id)
            ->where('course_number', $this->student->course_number)
            ->where('group_number', $this->student->group_number)
            ->selectRaw('*, max(`date`) as `date_class`')
            ->groupBy('team_id')
            ->paginate($this->showPerPage);

        return view('livewire.student-journal', [
            'disciplines' => $disciplines,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showMarks($kafedra)
    {
        $this->emit('showMarks', $kafedra);
    }
}
