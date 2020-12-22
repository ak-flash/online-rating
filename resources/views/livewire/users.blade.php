<div>

        <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

    <div class="m-2 hidden md:flex sm:flex-row flex-col float-right">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="showPerPage">
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                </select>
                <div
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
            <div class="relative">
                <select class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500" wire:model="findByPosition">
                    <option value="0">Все</option>
                    @foreach(\App\Models\User::POSITIONS as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
            <input placeholder="Поиск" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" wire:model.debounce.500ms="search" />
        </div>
    </div>

    <table class="min-w-full leading-normal">
        <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                №
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Ф.И.О
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Роль
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                Кафедра
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                email
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                Телефон
            </th>


            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                Управление
            </th>
            <th class="px-5 w-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                Дата изменений
            </th>
        </tr>
        </thead>
        <tbody>


            @foreach($users as $user)

                <tr>
                    <td class="p-3 border-b border-gray-200 {{ !$user->active ? 'bg-red-300' : 'bg-white' }} text-sm text-center">
                        {{ $user->id }}
                    </td>
                    <td class="p-3 border-b border-gray-200 bg-white text-sm text-left">
                        <p class="{{ !$user->active ? 'line-through' : '' }} pt-2 rounded-md whitespace-no-wrap">
                            {{ $user->name }}
                        </p>
                        <div class="text-sm text-gray-500">
                            {{ $user->getPosition() }}
                        </div>
                    </td>
                    <td class="p-3 border-b border-gray-200 bg-white text-sm text-left">
                        <p class=" py-2 rounded-md whitespace-no-wrap text-center {{ ($user->role=='admin') ? 'text-red-900 bg-red-100 px-2': '' }} {{ ($user->role=='moderator') ? 'text-green-900 bg-green-100': '' }}">
                            {{ $user->getRoleRus() }}
                        </p>
                    </td>
                    <td class="p-3 border-b border-gray-200 bg-white text-gray-900 text-xs text-center">
                            {{ $user->currentTeam->name }}
                    </td>
                    <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $user->email }}
                        </p>
                    </td>
                    <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ !$user->phone ? '-' : $user->phone }}
                        </p>
                    </td>


                    <td class="p-3 border-b border-gray-200 bg-white text-center">
                        <button class="bg-green-700 hover:bg-green-500 ml-5 m-2 p-2 px-4
                                     text-white text-sm font-semibold rounded">
                            <i class="fas fa-edit" style="font-size:12px;"></i>
                        </button>
                        <button class="bg-red-700 hover:bg-red-500 m-2 p-2 px-4
                                     text-white text-sm font-semibold rounded" wire:click="toggle($confirmingUserDeletion)">
                            <i class="fas fa-trash" style="font-size:12px;"></i>
                        </button>


                    </td>
                    <td class="p-1 w-5 border-b border-gray-200 text-gray-500 bg-white text-xs text-center">
                        {{ $user->updated_at->diffForHumans() }}
                    </td>
                </tr>

            @endforeach


        </tbody>
    </table>
    <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

        {{ $users->onEachSide(1)->links('livewire.pagination-links-view') }}

    </div>
            </div>
        </div>


    <x-jet-confirmation-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                Delete Account
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
