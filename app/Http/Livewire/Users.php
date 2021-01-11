<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{

    use WithPagination;

        public $search = '';
        public $perPage = 5;
        public $findByRole = 0;
        public $findByPosition = 0;
        public $confirmingUserDeletion =0;
        public $openModal = false;
        public $user_id = 0;
        public $name, $email, $role, $position;

        protected $rules = [
            'name' => 'required|string|min:6',
            'email' => 'required|email',
            'role' => 'required|integer',
        ];

        public function render() {
            $users = User::search($this->search)
                ->when($this->findByPosition != 0, function ($q) {
                    return $q->wherePosition($this->findByPosition);
                })
                ->when($this->findByRole != 0, function ($q) {
                    return $q->whereRole($this->findByRole);
                })
                ->orderBy('id')
                ->with('department')
                ->paginate($this->perPage);

            //dd($users);
            return view('livewire.users', [ 'users' => $users ]);
        }

        public function closeModal() {
            $this->openModal = false;
            $this->resetInputFields();
            $this->resetValidation();
        }

        public function update(User $user) {

            if($user->id) {
                $this->user_id = $user->id;
                $this->name = $user->name;
                $this->email = $user->email;
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

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'position' => $this->position,
            'password' => '$2y$10$qI899bmWznnHEYiaR1WLjO7zrZs22EBC9WHFSpifrsK12o0jGrBNe',
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
        $this->user_id = 0;
        $this->name = '';
        $this->email = '';
        $this->position = 0;
        $this->role = 0;

    }
}
