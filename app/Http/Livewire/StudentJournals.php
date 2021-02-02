<?php

namespace App\Http\Livewire;

use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class StudentJournals extends Component
{
    use WithPagination;

    public $student;
    public $lesson;
    public $showLessons = false;
    public string $search = '';
    public int $perPage = 5;
    public $year, $semester;

    public function mount(){
        $this->student = auth()->guard('student')->user();
    }

    public function render()
    {
        $this->year = $this->year ?? Journal::getStudyYear(now());

        $this->semester = $this->semester ?? Journal::getSemesterType(now());

        $journals = Journal::getStudentJournal($this->student->id, $this->year, $this->semester)
            ->paginate($this->perPage);


        return view('livewire.student.student-journal',
            ['journals' => $journals])
            ->layout('layouts.student', ['title' => 'Личный кабинет студента ВолгГМУ', 'student' => $this->student]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showLessonsPage($journalId)
    {
        $this->lesson['student_id'] = $this->student->id;
        $this->lesson['journal_id'] = $journalId;
        $this->showLessons = true;
    }


}
