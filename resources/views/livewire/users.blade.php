<div>

    <x-app-spinner target="search" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-12">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            @if(auth()->user()->isModerator())
                <div class="float-left">
                    <x-add-button wire:click="update()">
                        Добавить
                    </x-add-button>
                </div>
            @endif

            <div class="m-2 md:flex sm:flex-row flex-col float-right ">
                <div class="flex flex-row mb-1 sm:mb-0">

                        <select class="rounded-l block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="findByRole">
                            <option value="0">Все роли</option>
                            @foreach(User::ROLES as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                        <select class="block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="findByPosition">
                            <option value="0">Все должности</option>
                            @foreach(User::POSITIONS as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                </div>

                <x-search />

                <x-per-page-select  class="rounded-r-md"/>

            </div>

            <table class="min-w-full table-fixed">
                <thead>
                <tr>
                    <th class="p-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="w-1/3 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Ф.И.О
                    </th>
                    <th class="w-1/5 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        {{ Auth::user()->isAdmin() ? 'Кафедра': 'Роль' }}
                    </th>
                    <th class="w-auto px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        e-mail
                    </th>
                    <th class="w-1/3 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Телефон
                    </th>
                    @if(auth()->user()->isModerator())
                        <th class="w-2/5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center">
                            Управление
                        </th>
                    @endif
                    <th class="w-auto px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Изменено
                    </th>
                </tr>
                </thead>
                <tbody>


                @foreach($users as $user)

                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="{{ !$user->active ? 'bg-red-300' : '' }} text-sm text-center">
                            {{ $user->id }}
                        </td>
                        <td class="text-sm text-left py-3">
                            <img class="h-10 w-10 rounded-full object-cover mr-3 flex sm:float-left" src="{{ $user->profile_photo_url }}" />

                            <div class="{{ !$user->active ? 'line-through' : '' }} md:whitespace-nowrap">
                                @livewire('edit-user-name', compact('user'), key($user->id))
                            </div>
                            <div class="flex text-sm text-gray-500">
                                {{ $user->position }}

                            </div>
                        </td>
                        <td class="p-3 text-gray-900 text-xs text-center">
                            <div class=" rounded-lg p-1 {{ $user->isAdmin() ? 'text-red-900 bg-red-100': '' }} {{ ($user->role=='moderator') ? 'text-green-900 bg-green-100': '' }}">
                                {{ $user->getRoleName() }}
                            </div>

                            @if(Auth::user()->isAdmin())
                                <div class="text-wrap">
                                    {{ $user->department->name ?? 'не указана' }}
                                </div>
                            @endif

                        </td>
                        <td class="p-3 text-xs text-center">
                            <p class="text-gray-900">
                                {{ $user->email }}
                            </p>
                        </td>
                        <td class="p-3 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $user->phone ?? '-' }}
                            </p>
                        </td>
                        @if(auth()->user()->isModerator())
                            <td class="p-3 border">
                                <div class="flex justify-center">
                                    <x-update-button value="{{ $user->id }}" />
                                    <x-delete-button value="{{ $user->id }}" />
                                </div>
                            </td>
                        @endif
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


@include('livewire.modals.edit_user')



</div>
