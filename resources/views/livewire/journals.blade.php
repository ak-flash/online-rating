<div>

    <x-app-spinner target="search" />
    <x-app-spinner target="showPersonalGroups" />


    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            <div class="float-left">
                <x-add-button wire:click="update()">
                    Новый Журнал
                </x-add-button>
            </div>

            <div class="m-2 hidden md:flex sm:flex-row flex-col float-right">
                <div class="flex flex-row mb-1 sm:mb-0">

                    <x-select-semester />

                    <select class="text-gray-500 py-2 px-4 pr-8 leading-tight" wire:model="showPersonalGroups">
                        <option value="1">Мои группы</option>
                        <option value="0">Все группы</option>
                    </select>

                </div>

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
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Курс/Факультет/Группа
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        Занятие
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        Время
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        Дисциплина
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Аудитория
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Управление
                    </th>
                    <th class="w-auto px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Изменено
                    </th>
                </tr>
                </thead>
                <tbody>

                @forelse($journals as $journal)

                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center">
                            {{ (($journals->currentPage() * $perPage) - $perPage) + $loop->iteration }}
                        </td>
                        <td class="text-left py-5 cursor-pointer">
                            <a href="{{ route('study_classes', $journal->id) }}" class="flex">
                                {{ $journal->course_number }} курс
                                <p class="px-2 font-lg font-semibold hover:underline">
                                    Группа {{ $journal->group_number }}
                                </p>
                            </a>
                            <p class="text-{{ $journal->faculty->color }}-500">
                                {{ $journal->faculty->name }}
                            </p>

                        </td>
                        <td class="p-3 text-sm text-center">
                            @if (!is_null($journal->date))
                                {{ Str::ucfirst(\Carbon\Carbon::parse($journal->date)->isoFormat('dddd')) }}
                                <p class="text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($journal->date)->translatedFormat('d F Y') }}
                                </p>
                            @endif


                            <div class="text-xs text-gray-500">
                                {{ $journal->getDayTypeRus() }}
                            </div>
                        </td>
                        <td class="p-3 text-center">

                            {{ \Carbon\Carbon::parse($journal->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($journal->time_end)->format('H:i') }}

                        </td>
                        <td class="p-3 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $journal->discipline->short_name }}
                            </p>
                        </td>

                        <td class="p-3 text-sm text-center">
                            <div class="text-xs text-gray-500">
                                {{ $journal->room }}
                            </div>
                        </td>
                        <td class="p-3 border-2">
                            <x-update-delete-button value="{{ $journal->id }}" />
                        </td>
                        <td class="p-3 text-sm text-center">
                            <div class="text-xs text-gray-500">
                                {{ $journal->updated_at->diffForHumans() }}
                            </div>
                        </td>
                    </tr>


            @empty
                <tr>
                    <td class="p-3 text-red-700 text-md text-center" colspan="7">
                        Журналы не найдены...
                    </td>
                </tr>
            @endforelse

                </tbody>
            </table>
            <div class="px-5 py-2 flex xs:flex-row items-center xs:justify-between">

                {{ $journals->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>

    @include('livewire.modals.edit_journal')

</div>
