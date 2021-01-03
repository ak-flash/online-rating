<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $confirmingUserDeletion =0;
    public $openModal = false;
    public $name, $user_id;

    protected $rules = [
        'name' => 'required|string|min:6',
    ];
    public function render()
    {
        $departments = Department::search($this->search)
            ->with('user')
            ->paginate($this->perPage);

        //dd($users);
        return view('livewire.departments', [ 'departments' => $departments ]);
    }

    public function closeModal() {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function update(Department $department) {


        $this->user_id = $department->user_id;
        $this->name = $department->name;

        $this->openModal = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields(){

        $this->name = '';

    }
}
