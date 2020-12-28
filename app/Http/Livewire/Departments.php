<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;

    public $search = '';
    public $showPerPage = 5;
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
            ->paginate($this->showPerPage);

        //dd($users);
        return view('livewire.departments', [ 'departments' => $departments ]);
    }

    public function closeModal() {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function edit($id) {

        $user = Department::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;

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
