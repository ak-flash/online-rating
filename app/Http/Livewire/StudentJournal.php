<?php

namespace App\Http\Livewire;

use App\Models\Journal;
use App\Models\StudyClass;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class StudentJournal extends Component
{
    use WithPagination;

    public $student;
    public $search = '';
    public $perPage = 5;
    public $year, $semester;


    public function render()
    {
        $this->year = $this->year ?? Journal::getStudyYear(now());

        $this->semester = $this->semester ?? Journal::getSemesterType(now());

        $lessons = Journal::whereFacultyId($this->student->faculty_id)
            ->whereCourseNumber($this->student->course_number)
            ->whereGroupNumber($this->student->group_number)
            ->where('year', $this->year)
            ->whereIn('semester', Journal::SEMESTERS[$this->semester])
            ->with(['user:id,name,position,profile_photo_path', 'department:id,name', 'discipline:id,name'])
            ->with('study_classes', function ($q) {
                return $q->select(['id','journal_id','date','created_by','type_id'])->limit(1);
            })
            ->orderBy('department_id')
            ->paginate($this->perPage);



        //dd($lessons[0]);
        return view('livewire.student.student-journal', [
            'lessons' => $lessons,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showMarks($discipline)
    {
        $this->emit('showMarks', $discipline);
    }


}
