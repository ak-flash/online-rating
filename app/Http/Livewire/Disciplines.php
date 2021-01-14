<?php

namespace App\Http\Livewire;

use App\Models\Discipline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Disciplines extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $findByFaculty = 0;
    public $confirmingDeletion =0;
    public $openModal = false;
    public $discipline_id = 0;
    public $name, $short_name, $faculty_id, $semester, $last_class_id;

    protected $rules = [
        'name' => 'required|string|min:6|max:255',
        'short_name' => 'required|string|max:15',
        'faculty_id' => 'required|integer',
        'semester' => 'required|digits_between:1,12|numeric',
        'last_class_id' => 'required|integer',
    ];

    public function render()
    {
        $disciplines = Discipline::search($this->search)
            ->whereDepartmentId(Auth::user()->department_id)
            ->when($this->findByFaculty != 0, function ($q) {
                return $q->whereFacultyId($this->findByFaculty);
            })
            ->orderBy('semester')
            ->with('faculty:id,name,color')
            ->paginate($this->perPage);

        return view('livewire.disciplines', [ 'disciplines' => $disciplines ]);
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

    public function update(Discipline $discipline)
    {

        if($discipline->id) {
            $this->discipline_id = $discipline->id;
            $this->name = $discipline->name;
            $this->short_name = $discipline->short_name;
            $this->faculty_id = $discipline->faculty_id;
            $this->semester = $discipline->semester;
            $this->last_class_id = $discipline->last_class_id;
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

        $discipline = Discipline::updateOrCreate(['id' => $this->discipline_id], [
            'name' => $this->name,
            'short_name' => $this->short_name,
            'faculty_id' => $this->faculty_id,
            'semester' => $this->semester,
            'last_class_id' => $this->last_class_id,
        ]);


        $message = $this->discipline_id ? 'Данные обновлены' : 'Пользователь добавлен';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function deleteConfirmation(Discipline $discipline)
    {

        $this->discipline_id = $discipline->id;
        $this->name = $discipline->name;

        $this->confirmingDeletion = true;

    }

    public function delete()
    {
        Discipline::destroy($this->discipline_id);

        $this->emit('show-toast', 'Дисциплина удалена!', 'success');

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
