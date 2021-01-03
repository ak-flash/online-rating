<div>

    <x-app-spinner target="search" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">


            <div class="float-left">
                <x-add-button wire:click="$toggle('openModal')">
                    <i class="fas fa-plus" style="font-size:12px;"></i> Добавить
                </x-add-button>
            </div>

            <div class="m-2 md:flex sm:flex-row flex-col float-right ">
                <div class="flex flex-row mb-1 sm:mb-0">

                        <select class="rounded-l block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="findByRole">
                            <option value="0">Все роли</option>
                            @foreach(\App\Models\User::ROLES as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                        <select class="block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="findByPosition">
                            <option value="0">Все должности</option>
                            @foreach(\App\Models\User::POSITIONS as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                </div>

                <x-search />

                <div class="flex flex-row mb-1 sm:mb-0">
                    <select class="rounded-r block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="perPage">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>
                </div>
            </div>

            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="p-2 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Ф.И.О
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Кафедра
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        e-mail
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

                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="{{ !$user->active ? 'bg-red-300' : '' }} text-sm text-center">
                            {{ $user->id }}
                        </td>
                        <td class="p-3 text-sm text-left">
                            <img class="h-10 w-10 rounded-full object-cover mr-3 flex sm:float-left" src="{{ $user->profile_photo_url }}" />

                            <div class="{{ !$user->active ? 'line-through' : '' }} md:whitespace-nowrap flex-grow">
                                {{ $user->name }}
                            </div>
                            <div class="flex text-sm text-gray-500">
                                {{ $user->getPosition() }}
                                
                            </div>
                        </td>
                        <td class="p-3 text-gray-900 text-xs text-center">
                            <div class="w-full rounded-lg p-1 {{ ($user->role=='admin') ? 'text-red-900 bg-red-100': '' }} {{ ($user->role=='moderator') ? 'text-green-900 bg-green-100': '' }}">
                                {{ $user->getRoleRus() }}
                            </div>
                            {{ $user->department->name ?? 'не указана' }}
                        </td>
                        <td class="p-3 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $user->email }}
                            </p>
                        </td>
                        <td class="p-3 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ !$user->phone ? '-' : $user->phone }}
                            </p>
                        </td>
                        <td class="p-3 text-center">
                            <button class="bg-green-700 hover:bg-green-500 ml-5 m-2 p-2 px-4 text-white text-sm font-semibold rounded" wire:click="update({{ $user->id }})">
                                <i class="fas fa-edit" style="font-size:12px;"></i>
                            </button>
                            <button class="bg-red-700 hover:bg-red-500 m-2 p-2 px-4
                                     text-white text-sm font-semibold rounded" wire:click="toggle($confirmingUserDeletion)">
                                <i class="fas fa-trash" style="font-size:12px;"></i>
                            </button>


                        </td>
                        <td class="p-1 w-5 text-gray-500 text-xs text-center">
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


<x-form-modal wire:model="openModal" :maxWidth="2">

    <x-slot name="title">
        <p class="pt-2 text-lg font-semibold">Управление пользователем</p>
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-col items-center">

            <div class="flex items-center">
                <x-label class="mr-3 text-lg">Ф.И.О.</x-label>
                <x-input type="text" class="input w-full border mt-2 flex-1" wire:model.lazy="name" />
                <x-input-error for="name" class="block mt-2" />
            </div>

            <div class="flex items-center">
                <x-label class="mr-3 text-lg">E-mail</x-label>
                <x-input type="text" class="input w-full border mt-2 flex-1" wire:model.lazy="email" />
                <x-input-error for="email" class="mt-2" />
            </div>

            <div class="flex items-center">
                <x-label class="mr-3 text-lg">Роль</x-label>
                <select class="input w-full border mt-2 flex-1" wire:model="role">
                    <option value="0">Выберите...</option>
                    @foreach(\App\Models\User::ROLES as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </x-slot>

    <x-slot name="footer">


            <x-button class="mr-2 bg-green-500 hover:bg-green-600 shadow-xl px-5 py-2 text-white rounded" wire:click.prevent="store()" wire:loading.attr="disabled">
                Сохранить
            </x-button>




    </x-slot>
</x-form-modal>

</div>
