<?php

namespace App\Http\Livewire;

use App\Models\Journal;
use App\Models\Student;
use App\Models\Lesson;
use App\Models\Topic;
use Carbon\Carbon;
use Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Lessons extends Component
{
    public $journal;
    public $students;
    public $confirmingDeletion = 0;
    public $openModal = false;
    public $editMode = false;
    public $editStudyClassId = 0;
    public $showOneLesson = false;
    public $studyClassId = 0;
    public $date, $topicId, $timeStart, $timeEnd, $room;
    public $studyClassTypeId = 1;
    public $lessonId;
    public $page = 1;

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


    }

    public function render()
    {
        $lessonsDates = Lesson::where('journal_id', $this->journal->id)
            ->orderByDesc('date')
            ->with('topic')
            ->get(['id', 'date','topic_id','type_id']);



        if($this->showOneLesson){
            $lessonsIds = [ $lessonsDates->pluck('id')->first() ];
            $this->page = count($lessonsDates);
            //$lessonsDates = $lessonsDates->whereIn('id', $lessonsIds);
        } else {
            $lessonsIds = $lessonsDates->pluck('id')->toArray();
            $this->page = 1;
        }

        $lessons = DB::table('lesson_student')
            ->join('lessons', function ($q) use ($lessonsIds)
            {
                $q->on('lesson_student.lesson_id', '=', 'lessons.id')
                    ->whereIn('lessons.id', $lessonsIds);
            })
            ->join('students', 'students.id', '=', 'lesson_student.student_id')
            ->select('students.id AS st_id', 'students.name', 'students.last_name','lesson_student.id AS piv_id', 'lessons.id', 'lessons.topic_id', 'lessons.date', 'lesson_student.mark1', 'lesson_student.mark2', 'lesson_student.updated_by', 'lesson_student.updated_at')
            ->orderBy('students.last_name')
            ->orderByDesc('lessons.date')
            ->whereNull('lesson_student.deleted_at')
            ->get();


        $allTopics = Topic::whereDisciplineId($this->journal->discipline_id)
            ->orderBy('t_number')
            ->get();

       /* foreach ($study_classes->last() as $student) {
            dd($student);
        }*/

        if($lessons->isEmpty()) {
            $this->students = Student::whereFacultyId($this->journal->faculty_id)
                ->whereCourseNumber($this->journal->course_number)
                ->whereGroupNumber($this->journal->group_number)
                ->orderBy('last_name')
                ->get();
        }

        return view('livewire.lessons', [
            'lessons' => $lessons,
            'lessonsDates' => $lessonsDates,
            'students' => $this->students,
            'topics' => $allTopics,
            'lastLesson' => $lessonsDates[(count($lessonsDates) - $this->page)],
            'oneViewIndex' => (count($lessonsDates) - $this->page),
        ]);
    }



    public function update(Lesson $study_class)
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
        $this->date = now()->format('d/m/Y');
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
            'topicId' => 'required|numeric|unique:lessons,topic_id,' . $this->studyClassId . ',id,journal_id,' . $this->journal->id,
            ]);

        if ($this->studyClassId) {
            $study_class = Lesson::findOrFail($this->studyClassId);
            $study_class->date = Helper::formatDateForBase($this->date);
            $study_class->topic_id = $this->topicId;
            $study_class->time_start = $this->timeStart;
            $study_class->time_end = $this->timeEnd;
            $study_class->room = $this->room;
            $study_class->type_id = $this->studyClassTypeId;

            $study_class->save();

        } else {
            $study_class = Lesson::create([
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

    public function editModeEnable($study_class_id)
    {
        $this->editMode = $this->editMode == true ? false : true;

        $this->editStudyClassId = $study_class_id;
    }

    public function repairStudent($studentId, $journalId)
    {
        $this->emit('show-toast', 'Исправлено', 'success');
    }
}
