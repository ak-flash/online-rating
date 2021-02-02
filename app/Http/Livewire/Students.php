<?php

namespace App\Http\Livewire;

use App\Imports\StudentsImport;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Students extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $perPage = 10;
    public $findByFaculty = 0;
    public $findByCourse = 0;
    public $findByGroup = 0;
    public $confirmingDeletion =0;
    public $openModal = false;
    public $openImport = false;
    public $studentId = 0;
    public $fileImport;
    public $name, $lastName, $active, $facultyId, $courseNumber, $groupNumber;

    protected $rules = [
        'name' => 'required|string|min:2|max:50',
        'lastName' => 'required|string|min:2|max:50',
        'courseNumber' => 'required|digits_between:1,6|numeric',
        'groupNumber' => 'required|digits_between:1,60|numeric',
        'facultyId' => 'nullable|numeric',
    ];

    public function render()
    {
        $students = Student::search($this->search)
            ->when($this->findByFaculty != 0, function ($q) {
                return $q->whereFacultyId($this->findByFaculty);
            })
            ->when($this->findByCourse != 0, function ($q) {
                return $q->whereCourseNumber($this->findByCourse);
            })
            ->when($this->findByGroup != 0, function ($q) {
                return $q->whereGroupNumber($this->findByGroup);
            })
            ->with('faculty:id,color,speciality')
            ->orderBy('last_name')
            ->paginate($this->perPage);

        $faculties = Faculty::all(['id','speciality']);

        return view('livewire.students', [
            'students' => $students,
            'faculties' => $faculties, ]);
    }

    public function closeModal()
    {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }



    public function update(Student $student)
    {

        if($student->id) {
            $this->studentId = $student->id;
            $this->name = $student->name;
            $this->lastName = $student->last_name;
            $this->facultyId = $student->faculty_id;
            $this->courseNumber = $student->course_number;
            $this->groupNumber = $student->group_number;
        } else {
            $this->resetInputFields();
            $this->resetValidation();
        }

        $this->openModal = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate();


        $student = Student::updateOrCreate(['id' => $this->studentId], [
            'name' => $this->name,
            'last_name' => $this->lastName,
            'faculty_id' => $this->facultyId,
            'course_number' => $this->courseNumber,
            'group_number' => $this->groupNumber,
        ]);

        if ($this->studentId !== $student->id) {
            $student->forceFill([
                'password' => Hash::make('11111111'),
            ])->save();
        }


        $message = $this->studentId ? 'Данные обновлены' : 'Студент добавлен';

        $this->emit('show-toast', '',$message, 'success');

        $this->closeModal();
    }

    public function deleteConfirmation(Student $student)
    {

        $this->studentId = $student->id;
        $this->name = $student->name;
        $this->lastName = $student->last_name;

        $this->confirmingDeletion = true;

    }

    public function delete()
    {
        Student::destroy($this->studentId);

        $this->emit('show-toast', '','Студент удалён!', 'success');

        $this->confirmingDeletion = false;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields()
    {
        $this->studentId = 0;
        $this->lastName = '';
        $this->name = '';
        $this->facultyId = 0;
        $this->courseNumber = 0;
        $this->groupNumber = 0;
        $this->fileImport = '';
    }

    public function showImport()
    {
        $this->openImport = true;
        $this->resetInputFields();
        $this->resetValidation();
    }

    protected $messages = [
        'facultyId.min' => 'Выберите специальность!',
        'courseNumber.min' => 'Выберите номер курса!',
        'fileImport.required' => 'Выберите файл со студентами!',
    ];

    public function import()
    {
        $this->validate([
            'facultyId' => 'required|min:1|numeric',
            'courseNumber' => 'required|min:1|numeric',
            'fileImport' => 'required|mimes:xlsx,xls|max:1024',
            ]);

        Excel::import(new StudentsImport($this->facultyId), $this->fileImport);

        $this->emit('show-toast', '','Студенты импортированы!', 'success');

        $this->resetInputFields();

        $this->openImport = false;
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFindByFaculty()
    {
        $this->resetPage();
    }

    public function updatingFindByCourse()
    {
        $this->resetPage();
    }

    public function updatingFindByGroup()
    {
        $this->resetPage();
    }
}
