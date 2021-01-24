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

                <x-per-page-select  class="rounded-r-md"/>

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


                        <td class="p-3 border">
                            <div class="flex justify-center">
                                    <x-update-button value="{{ $department->id }}" />
                                    <x-delete-button value="{{ $department->id }}" />
                            </div>
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
