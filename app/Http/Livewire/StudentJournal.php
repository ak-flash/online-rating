<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
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
            ->study_classes()
            ->with('user', 'department', 'discipline')
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
