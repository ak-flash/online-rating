<?php

namespace App\Http\Livewire;

use App\Models\Journal;
use App\Models\Student;
use App\Models\StudyClass;
use App\Models\Topic;
use Carbon\Carbon;
use Helper;
use Livewire\Component;

class StudyClasses extends Component
{
    public $journal;
    public $students;
    public $confirmingDeletion = 0;
    public $openModal = false;
    public $editMode = false;
    public $editStudyClassId = 0;
    public $onlyCurrentLesson = true;
    public $studyClassId = 0;
    public $date, $topicId, $timeStart, $timeEnd, $room;
    public $studyClassTypeId = 1;

    protected $rules = [
        'studyClassId' => 'required|numeric',
        'date' => 'required|date_format:d/m/Y',
        'timeStart' => 'date_format:H:i',
        'timeEnd' => 'date_format:H:i|after:timeStart',
        'room' => 'nullable|string',
        'studyClassTypeId' => 'nullable|numeric',
    ];

    protected $messages = [
        'topicId.unique' => 'Данная тема уже добавлена в другое занятие!',
    ];

    public function mount(Journal $journal)
    {
        $this->journal = $journal;

        $this->timeStart = Carbon::parse($journal->time_start)->format('H:i');
        $this->timeEnd = Carbon::parse($journal->time_end)->format('H:i');

        $this->students = Student::whereFacultyId($journal->faculty_id)
            ->whereCourseNumber($journal->course_number)
            ->whereGroupNumber($journal->group_number)
            ->orderBy('last_name')
            ->get();
    }

    public function render()
    {
        $study_classes = StudyClass::whereJournalId($this->journal->id)
            ->when($this->onlyCurrentLesson, function ($q) {
                return $q->limit(1);
            })
            ->orderBy('date', 'desc')
            ->with('students')
            ->get();

        // $alreadyPassedTopics = $study_classes->pluck('topic_id')->toArray();

        $topics = Topic::whereDisciplineId($this->journal->discipline_id)
            ->orderBy('t_number')
            ->get();


       /* foreach ($study_classes->last() as $student) {
            dd($student);
        }*/

        return view('livewire.study-classes', [
            'study_classes' => $study_classes,
            'students' => $this->students,
            'topics' => $topics,
        ]);
    }

    public function getRating($rating_array)
    {
        $rating_array = array_diff($rating_array, [0, 1]);

        if(count($rating_array)!=0) {
            $rating = array_sum($rating_array) / count($rating_array);
            return round($rating, 1);
        }

        return 0;
    }

    public function update(StudyClass $study_class)
    {

        if ($study_class->id) {

            $this->studyClassId = $study_class->id;
            $this->date = Helper::formatDate($study_class->date, 'd/m/Y');
            $this->topicId = $study_class->topic_id;
            $this->timeStart = Helper::formatDate($study_class->time_start, 'H:i');
            $this->timeEnd = Helper::formatDate($study_class->time_end, 'H:i');
            $this->studyClassTypeId = $study_class->type_id;
            $this->room = $study_class->room;

            /*if($study_class->study_classes->isNotEmpty()){
                $this->hasLessons = true;

                $message = 'Данный журнал содержит занятия';
                $this->emit('show-toast', $message, 'danger');
            }*/
        } else {
            $this->resetInputFields();
            $this->resetValidation();
        }

        $this->openModal = true;
    }

    private function resetInputFields()
    {
        $this->studyClassId = 0;
        $this->date = '';
        $this->studyClassTypeId = 1;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function closeModal()
    {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function store()
    {

        $this->validate([
            'topicId' => 'required|numeric|unique:study_classes,topic_id,'
                .$this->journal->id,
            ]);

        if ($this->studyClassId) {
            $study_class = StudyClass::findOrFail($this->studyClassId);
            $study_class->date = Helper::formatDateForBase($this->date);
            $study_class->topic_id = $this->topicId;
            $study_class->time_start = $this->timeStart;
            $study_class->time_end = $this->timeEnd;
            $study_class->room = $this->room;
            $study_class->type_id = $this->studyClassTypeId;

            $study_class->save();

        } else {
            $study_class = StudyClass::create([
                'topic_id' => $this->topicId,
                'date' => Helper::formatDateForBase($this->date, 'Y-m-d'),
                'time_start' => $this->timeStart,
                'time_end' => $this->timeEnd,
                'journal_id' => $this->journal->id,
                'type_id' => $this->studyClassTypeId,
                'room' => $this->room,
            ]);

            if ($this->journal->id) {
                $study_class->students()->sync($this->students->pluck('id')->toArray());
            }
        }

        $message = $this->studyClassId ? 'Данные обновлены' : 'Занятие добавлено';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function editMode($study_class_id)
    {
        $this->editMode = true;
        $this->editStudyClassId = $study_class_id;
    }
}
