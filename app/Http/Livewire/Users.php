<?php

namespace App\Http\Livewire;


use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $showPerPage = 10;
    public $findByRole = 3;
    public $findByPosition = 0;
    public $confirmingUserDeletion =0;

    public function render()
    {
        $users = User::search($this->search)
            ->when($this->findByPosition != 0, function ($q) {
                return $q->wherePosition($this->findByPosition);
            })->with('currentTeam')
           ->paginate($this->showPerPage);

        //dd($users);
        return view('livewire.users', [ 'users' => $users ])->layout('layouts.app', ['title' => 'Пользователи онлайн журнала ВолгГМУ']);
    }
}
