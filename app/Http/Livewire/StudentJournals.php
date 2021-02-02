<?php

namespace App\Http\Livewire;

use App\Models\Journal;
use Livewire\Component;
use Livewire\WithPagination;


class StudentJournals extends Component
{
    use WithPagination;

    public $student;
    public string $search = '';
    public int $perPage = 5;
    public $year, $semester;

    public function mount(){
        $this->student = session('student');
    }

    public function render()
    {
        $this->year = $this->year ?? Journal::getStudyYear(now());

        $this->semester = $this->semester ?? Journal::getSemesterType(now());

        $journals = Journal::getStudentJournal($this->student->id, $this->year, $this->semester)
            ->paginate($this->perPage);


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
