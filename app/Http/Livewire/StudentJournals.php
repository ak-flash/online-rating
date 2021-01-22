<?php

namespace App\Http\Livewire;

use App\Models\Journal;
use Livewire\Component;
use Livewire\WithPagination;


class StudentJournals extends Component
{
    use WithPagination;

    public $student;
    public $search = '';
    public $perPage = 5;
    public $year, $semester;

    public function mount(){

    }

    public function render()
    {
        $this->year = $this->year ?? Journal::getStudyYear(now());

        $this->semester = $this->semester ?? Journal::getSemesterType(now());

        $journals = Journal::getStudentJournal($this->student->id, $this->year, $this->semester)
//            ->get();
            ->paginate($this->perPage);
//dd($journal);


        return view('livewire.student.student-journal',
            [ 'journals' => $journals]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showLessonsPage($disciplineId)
    {
        $this->emit('setLessonStudentIds', $disciplineId);
    }


}
