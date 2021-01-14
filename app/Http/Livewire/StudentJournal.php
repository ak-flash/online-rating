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
        $this->year = $this->year ?? config('app.study_year', 2020);

        $this->semester = $this->semester ?? Journal::getSemester(now(), $this->year);

        $lessons = Journal::whereFacultyId($this->student->faculty_id)
            ->whereCourseNumber($this->student->course_number)
            ->whereGroupNumber($this->student->group_number)
            ->where('year', $this->year)
            ->whereIn('semester', Journal::SEMESTERS[$this->semester])
            ->with(['user:id,name,position,profile_photo_path', 'department:id,name', 'discipline:id,name'])
            ->with(['study_classes' => function($query) {
                $query->latest('date')->leftJoin('student_study_class', 'study_classes.id', '=', 'student_study_class.study_class_id')->select('lesson_id', 'date', 'type_id', 'mark1', 'mark2', 'student_study_class.updated_at');
            }])
            ->orderBy('department_id')
            ->paginate($this->perPage);



        //dd($lessons);
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
