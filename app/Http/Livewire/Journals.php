<?php

namespace App\Http\Livewire;

use App\Models\Discipline;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Journal;
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
    public $journal_id = 0;
    public $disciplines, $discipline_id, $faculty_id, $group_number,
        $time_start, $time_end, $day_type_id, $room;

    protected $rules = [
        'discipline_id' => 'required|numeric',
        'group_number' => 'required|numeric',
        'time_start' => 'date_format:H:i',
        'time_end' => 'date_format:H:i|after:time_start',
        'day_type_id' => 'required|integer',
        'room' => 'nullable|string',
    ];

    public function render()
    {
        $personal_groups = $this->showPersonalGroups;

        $this->year = $this->year ?? Journal::getStudyYear(now());

        $this->semester = $this->semester ?? Journal::getSemesterType(now());

        $journals = Journal::when($personal_groups, function ($q) {
            return $q->whereUserId(Auth::id());
        }, function ($q) {
            return $q->whereDepartmentId(Auth::user()->department_id);
        })
        ->where('year', $this->year)
        ->whereIn('semester', Journal::SEMESTERS[$this->semester])
        ->with('faculty', 'discipline')
            ->paginate($this->perPage);

        $this->disciplines = Discipline::whereDepartmentId(Auth::user()->department_id)
            ->get();

        return view('livewire.journals', [
            'journals' => $journals,
            'disciplines' => $this->disciplines,
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

    public function update(Journal $journal)
    {
        $time_start = Carbon::parse($journal->time_start);
        $time_end = Carbon::parse($journal->time_end);

        if($journal->id) {
            $this->journal_id = $journal->id;
            $this->discipline_id = $journal->discipline_id;
            $this->group_number = $journal->group_number;
            $this->time_start = $time_start->format('H:i');
            $this->time_end = $time_end->format('H:i');
            $this->day_type_id = $journal->day_type_id;
            $this->room = $journal->room;
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

        $journal = Journal::updateOrCreate(['id' => $this->journal_id], [
            'discipline_id' => $this->discipline_id,
            'group_number' => $this->group_number,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'day_type_id' => $this->day_type_id,
            'room' => $this->room,
            'user_id' => Auth::user()->id,
            'department_id' => Auth::user()->department_id,
            'faculty_id' => $discipline->faculty_id,
            'semester' => $discipline->semester,
            'course_number' => Faculty::getCourseNumber($discipline->semester),
            'year' => now()->format('Y'),
        ]);


        $message = $this->journal_id ? 'Данные обновлены' : 'Журнал создан';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function deleteConfirmation(Journal $journal)
    {

        $this->journal_id = $journal->id;
        $this->group_number = $journal->group_number;

        $this->confirmingDeletion = true;

    }

    public function delete()
    {
        Journal::destroy($this->journal_id);

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
        $this->journal_id = 0;
        $this->discipline_id = '';
        $this->group_number = '';
        $this->faculty_id = '';
        $this->time_start = '';
        $this->time_end = '';
        $this->day_type_id = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
