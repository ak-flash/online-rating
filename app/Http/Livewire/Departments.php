<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 5;
    public int $confirmingUserDeletion =0;
    public bool $openModal = false;
    public string $name;
    public string $userId;
    public int $departmentId;
    public string $volgmedId;
    public $moderators;

    protected $rules = [
        'name' => 'required|string|min:6',
        'userId' => 'required|numeric',
        'volgmedId' => 'required|numeric',
    ];

    public function mount(){

    }

    public function render()
    {
        $departments = Department::search($this->search)
            ->with('user')->orderBy('name')
            ->paginate($this->perPage);

        $this->moderators = User::where('role_id', 2)->orWhere('role_id', 1)->get(['id', 'name']);

        return view('livewire.departments', [ 'departments' => $departments ]);
    }

    public function closeModal() {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function update(Department $department) {

        if($department->id) {
            $this->departmentId = $department->id;
            $this->userId = $department->user_id ?? 0;
            $this->volgmedId = $department->volgmed_id ?? 0;
            $this->name = $department->name;
        } else {
            $this->resetInputFields();
            $this->resetValidation();
        }

        $this->openModal = true;
    }

    public function store()

    {
        $this->validate();

        $department = Department::updateOrCreate(['id' => $this->departmentId], [
            'name' => $this->name,
            'user_id' => $this->userId,
            'volgmed_id' => $this->volgmedId,
        ]);


        User::findOrFail($this->userId)->update([
            'department_id' => $department->id,
        ]);
        /*session()->flash('message',
            $this->user_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');*/

        $this->emit('show-toast', '','Данные обновлены!', 'success');

        $this->closeModal();

    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields(){

        $this->name = '';
        $this->departmentId = 0;
        $this->userId = '';
        $this->volgmedId = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

}
