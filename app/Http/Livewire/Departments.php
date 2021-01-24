<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
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
    public $department_id;
    public $moderators;

    protected $rules = [
        'name' => 'required|string|min:6',
    ];

    public function mount(){

    }

    public function render()
    {
        $departments = Department::search($this->search)
            ->with('user')->orderBy('name')
            ->paginate($this->perPage);

        $this->moderators = User::where('role_id', 2)->orWhere('role_id', 1)->get(['id', 'name']);
        //dd($users);
        return view('livewire.departments', [ 'departments' => $departments ]);
    }

    public function closeModal() {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function update(Department $department) {

        if($department->id) {
            $this->department_id = $department->id;
            $this->user_id = $department->user_id;
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

        $department = Department::updateOrCreate(['id' => $this->department_id], [
            'name' => $this->name,
            'user_id' => $this->user_id,
        ]);


        User::findOrFail($this->user_id)->update([
            'department_id' => $department->id,
        ]);
        /*session()->flash('message',
            $this->user_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');*/

        $this->emit('show-toast', 'Данные обновлены!', 'success');

        $this->closeModal();

    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields(){

        $this->name = '';
        $this->department_id = 0;
        $this->user_id = 0;
    }
}
