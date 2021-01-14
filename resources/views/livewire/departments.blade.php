<div>

    <x-app-spinner target="search" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">


            <div class="float-left">
                <x-add-button wire:click="update()">
                    Добавить
                </x-add-button>
            </div>

            <div class="m-2 md:flex sm:flex-row flex-col float-right">

                <x-search />

                <div class="flex flex-row mb-1 sm:mb-0">
                    <select class="rounded-r block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight" wire:model="perPage">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>
                </div>

            </div>

            <table class="min-w-full table-fixed">
                <thead>
                <tr>
                    <th class="px-5 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Кафедра
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Ответственный
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
                        Изменено
                    </th>
                </tr>
                </thead>
                <tbody>


                @foreach($departments as $department)

                    <tr>
                        <td class="border-b border-gray-200 text-sm text-center">
                            {{ $department->id }}
                        </td>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-left">

                            <div class="">
                                {{ Str::ucfirst($department->name) }}
                            </div>
                        </td>

                        <td class="p-3 border-b border-gray-200 bg-white text-gray-900 text-xs text-center">
                            {{ $department->user->name ?? 'не указан' }}
                        </td>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $department->email }}
                            </p>
                        </td>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ !$department->phone ? '-' : $department->phone }}
                            </p>
                        </td>


                        <td class="p-3 border-b border-gray-200 bg-white text-center whitespace-nowrap">
                            <button class="bg-green-700 hover:bg-green-500 ml-5 m-2 p-2 px-4 text-white text-sm font-semibold rounded" wire:click="update({{ $department->id }})">
                                <i class="fas fa-edit" style="font-size:12px;"></i>
                            </button>
                            <button class="bg-red-700 hover:bg-red-500 m-2 p-2 px-4
                                     text-white text-sm font-semibold rounded" wire:click="toggle($confirmingUserDeletion)">
                                <i class="fas fa-trash" style="font-size:12px;"></i>
                            </button>


                        </td>
                        <td class="p-1 w-5 border-b border-gray-200 text-gray-500 bg-white text-xs text-center">
                            {{ is_null($department->updated_at) ?  'никогда' : $department->updated_at->diffForHumans() }}
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
            <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

                {{ $departments->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>


@include('livewire.modals.edit_department')

</div>
