<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
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

        $this->semester = $this->semester ?? Lesson::getSemester(now(), $this->year);

        $disciplines = Lesson::whereFacultyId($this->student->faculty_id)
            ->whereCourseNumber($this->student->course_number)
            ->whereGroupNumber($this->student->group_number)
            ->where('year', $this->year)
            ->whereIn('semester', Lesson::SEMESTERS[$this->semester])
            ->with(['user', 'department', 'discipline'])
            ->with(['study_classes' => function($query) {
                $query->latest('date')->leftJoin('student_study_class', 'study_classes.id', '=', 'student_study_class.study_class_id')->select('lesson_id', 'date', 'type_id', 'mark1', 'mark2', 'student_study_class.updated_at');
            }])
            ->orderBy('department_id')
            ->paginate($this->perPage);



        //dd($disciplines);
        return view('livewire.student.student-journal', [
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
