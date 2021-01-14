<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{

    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $findByRole = 0;
    public $findByPosition = 0;
    public $confirmingDeletion =0;
    public $openModal = false;
    public $user_id = 0;
    public $name, $email, $phone, $role, $position;

    protected $rules = [
        'name' => 'required|string|min:6|max:255',
        'email' => 'required|string|email|max:255',
        'role' => 'required|integer',
        'phone' => 'nullable|digits_between:3,15|numeric',
    ];

    public function render()
    {
        $users = User::search($this->search)
            ->when(Auth::user()->isNotAdmin(), function ($q) {
                return $q->whereDepartmentId(Auth::user()->department_id)
                    ->whereNotIn('id', [Auth::user()->id]);
            })
            ->when($this->findByPosition != 0, function ($q) {
                return $q->wherePosition($this->findByPosition);
            })
            ->when($this->findByRole != 0, function ($q) {
                return $q->whereRole($this->findByRole);
            })
            ->orderBy('name')
            ->with('department')
            ->paginate($this->perPage);

        //dd($users);
        return view('livewire.users', [ 'users' => $users ]);
    }

    public function closeModal()
    {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function update(User $user)
    {

        if($user->id) {
            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->role = $user->getRoleId($user->role);
            $this->position = $user->getPositionId($user->position);
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

        // Forbid for moderator to make admin
        if(Auth::user()->isNotAdmin()&&$this->role==1) {
            $this->role = 3;
        }

        $user = User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'position' => $this->position,
        ]);

        if ($this->user_id !== $user->id) {
            $user->forceFill([
                'password' => Hash::make('11111111'),
            ])->save();
        }

        /*session()->flash('message',
            $this->user_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');*/

        $message = $this->user_id ? 'Данные обновлены' : 'Пользователь добавлен';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function delete(User $user)
    {

        $this->user_id = $user->id;
        $this->name = $user->name;

        $this->confirmingDeletion = true;

    }

    public function deleteUser()
    {
        User::destroy($this->user_id);

        $this->emit('show-toast', 'Пользователь удалён!', 'success');

        $this->confirmingDeletion = false;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields()
    {
        $this->user_id = 0;
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->position = 0;
        $this->role = 0;

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
