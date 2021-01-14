<?php

namespace App\Http\Livewire;

use App\Models\Discipline;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Journals extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $confirmingDeletion =0;
    public $openModal = false;
    public $showPersonalGroups = true;
    public $year, $semester;
    public $lesson_id = 0;
    public $discipline_id, $faculty_id, $group_number,
        $time_start, $time_end, $day_type_id, $room;

    public function render()
    {
        $personal_groups = $this->showPersonalGroups;

        $this->year = now()->format('Y');

        $this->semester = $this->semester ?? Journal::getSemesterType(now());

        $lessons = Journal::when($personal_groups, function ($q) {
            return $q->whereUserId(Auth::id());
        }, function ($q) {
            return $q->whereDepartmentId(Auth::user()->department_id);
        })
        ->where('year', $this->year)
        ->whereIn('semester', Journal::SEMESTERS[$this->semester])
        ->with('faculty', 'discipline')
            ->paginate($this->perPage);

        return view('livewire.journals', [
            'lessons' => $lessons,
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function update(Journal $lesson)
    {

        if($lesson->id) {
            $this->lesson_id = $lesson->id;
            $this->discipline_id = $lesson->discipline_id;
            $this->group_number = $lesson->group_number;
            $this->time_start = $lesson->time_start;
            $this->time_end = $lesson->time_end;
        } else {
            $this->resetInputFields();
            $this->resetValidation();
        }

        $this->openModal = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @var array
     */

    public function store()
    {
        $this->validate();

        $discipline = Discipline::findOrFail($this->discipline_id);

        $lesson = Journal::updateOrCreate(['id' => $this->lesson_id], [
            'discipline_id' => $this->discipline_id,
            'group_number' => $this->group_number,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'day_type_id' => $this->day_type_id,
            'user_id' => Auth::user()->id,
            'department_id' => Auth::user()->department_id,
            'faculty_id' => $discipline->faculty_id,
            'semester' => $discipline->semester,
            'department_id' => Auth::user()->department_id,
            'department_id' => Auth::user()->department_id,
            'department_id' => Auth::user()->department_id,
        ]);


        $message = $this->lesson_id ? 'Данные обновлены' : 'Пользователь добавлен';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function deleteConfirmation(Journal $lesson)
    {

        $this->lesson_id = $lesson->id;
        $this->group_number = $lesson->group_number;

        $this->confirmingDeletion = true;

    }

    public function delete()
    {
        Journal::destroy($this->lesson_id);

        $this->emit('show-toast', 'Журнал удалён!', 'success');

        $this->confirmingDeletion = false;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields()
    {
        $this->discipline_id = 0;
        $this->name = '';
        $this->short_name = '';
        $this->faculty_id = 0;
        $this->last_class_id = 0;
        $this->semester = '';

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
