<?php

namespace App\Http\Livewire;

use App\Helper\Helper;
use App\Models\Discipline;
use App\Models\Faculty;
use App\Models\Journal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Journals extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 20;
    public bool $confirmingDeletion = false;
    public bool $openModal = false;
    public bool $showPersonalGroups = true;
    public bool $hasLessons = false;
    public $year, $semester;
    public int $journalId = 0;
    public $disciplines, $disciplineId, $userId, $facultyId, $groupNumber,
        $timeStart, $timeEnd, $dayTypeId, $weekTypeId, $room, $journalYear;

    protected $rules = [
        'disciplineId' => 'required|numeric',
        'groupNumber' => 'required|numeric',
        'timeStart' => 'date_format:H:i',
        'timeEnd' => 'date_format:H:i|after:timeStart',
        'dayTypeId' => 'required|integer',
        'room' => 'nullable|string',
    ];

    public function render()
    {
        $personalGroups = $this->showPersonalGroups;

        $this->year = $this->year ?? Journal::getStudyYear(now());

        $this->semester = $this->semester ?? Journal::getSemesterType(now());

        $journals = Journal::search($this->search)
            ->when($personalGroups, function ($q) {
            return $q->whereUserId(Auth::id());
        }, function ($q) {
            return $q->whereDepartmentId(Auth::user()->department_id);
        })
        ->where('year', $this->year)
        ->whereIn('semester', Journal::SEMESTERS[$this->semester])
        ->with('faculty', 'discipline', 'lessons')
        ->paginate($this->perPage);

        $this->disciplines = Discipline::whereDepartmentId(Auth::user()->department_id)
            ->with('faculty')
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
            $this->journalId = $journal->id;
            $this->userId = $journal->user_id;
            $this->facultyId = $journal->faculty_id;
            $this->journalYear = $journal->year;
            $this->disciplineId = $journal->discipline_id;
            $this->groupNumber = $journal->group_number;
            $this->timeStart = $time_start->format('H:i');
            $this->timeEnd = $time_end->format('H:i');
            $this->dayTypeId = $journal->day_type_id;
            $this->weekTypeId = $journal->week_type_id;
            $this->room = $journal->room;

            if($journal->lessons->isNotEmpty()){
                $this->hasLessons = true;

                $message = 'Данный журнал содержит занятия';
                $this->emit('show-toast', 'Внимание!', $message, 'danger');
            } else {
                $this->hasLessons = false;
            }
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

        $discipline = Discipline::findOrFail($this->disciplineId);

        if($this->journalId) {

            $journal = Journal::findOrFail($this->journalId);

            $journal->day_type_id = $this->dayTypeId;
            $journal->week_type_id = $this->weekTypeId;
            $journal->time_start = $this->timeStart;
            $journal->time_end = $this->timeEnd;
            $journal->room = $this->room;

            if (Auth::user()->isModerator()){
                $journal->user_id = $this->userId;
            }

            // Change data only if it`s new journal without lessons
            if($journal->lessons->isEmpty()) {
                $journal->discipline_id = $this->disciplineId;
                $journal->group_number = $this->groupNumber;
                $journal->faculty_id = $discipline->faculty_id;
                $journal->semester = $discipline->semester;
                $journal->course_number = Helper::getCourseNumber($discipline->semester);
            }

            $journal->save();

        } else {
            $journal = Journal::create([
                'discipline_id' => $this->disciplineId,
                'group_number' => $this->groupNumber,
                'time_start' => $this->timeStart,
                'time_end' => $this->timeEnd,
                'day_type_id' => $this->dayTypeId,
                'week_type_id' => $this->weekTypeId,
                'room' => $this->room,
                'user_id' => Auth::id(),
                'department_id' => Auth::user()->department_id,
                'faculty_id' => $discipline->faculty_id,
                'semester' => $discipline->semester,
                'course_number' => Helper::getCourseNumber($discipline->semester),
                'year' => now()->format('Y'),
            ]);
        }





        $message = $this->journalId ? 'Данные обновлены' : 'Журнал создан';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function deleteConfirmation(Journal $journal)
    {
        if ($journal->lessons->isEmpty()) {
            $this->journalId = $journal->id;
            $this->groupNumber = $journal->group_number;

            $this->confirmingDeletion = true;
        } else {
            $this->emit('show-toast', 'Нельзя удалить! В журнале есть занятия!', 'danger');
        }
    }

    public function delete()
    {
        Journal::destroy($this->journalId);

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
        $this->journalId = 0;
        $this->disciplineId = '';
        $this->groupNumber = '';
        $this->facultyId = '';
        $this->timeStart = '';
        $this->timeEnd = '';
        $this->dayTypeId = '';
        $this->weekTypeId = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
