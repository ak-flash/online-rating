<div>
    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

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


            <table class="min-w-full leading-normal">
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
                        Тема занятия
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Аудитория
                    </th>
                </tr>
                </thead>
                <tbody>

                @forelse($lessons as $lesson)

                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center">
                            {{ (($lessons->currentPage() * $perPage) - $perPage) + $loop->iteration }}
                        </td>
                        <td class="text-left py-5 cursor-pointer">
                            <div class="flex">
                                {{ $lesson->course_number }} курс
                                <p class="px-2 font-lg font-semibold">
                                    Группа {{ $lesson->group_number }}
                                </p>
                            </div>
                            <p class="text-{{ $lesson->faculty->color }}-500">
                                {{ $lesson->faculty->name }}
                            </p>

                        </td>
                        <td class="p-3 text-sm text-center">
                            @if (!is_null($lesson->date))
                                {{ Str::ucfirst(\Carbon\Carbon::parse($lesson->date)->isoFormat('dddd')) }}
                                <p class="text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($lesson->date)->translatedFormat('d F Y') }}
                                </p>
                            @endif


                            <div class="text-xs text-gray-500">
                                {{ $lesson->getDayTypeRus() }}
                            </div>
                        </td>
                        <td class="p-3 text-center">

                            {{ \Carbon\Carbon::parse($lesson->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($lesson->time_end)->format('H:i') }}

                        </td>
                        <td class="p-3 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $lesson->discipline->short_name }}
                            </p>
                        </td>
                        <td class="p-3 text-sm text-center">
                            <div class="text-xs text-gray-500">
                                {{ $lesson->title }}
                            </div>
                        </td>
                        <td class="p-3 text-sm text-center">
                            <div class="text-xs text-gray-500">
                                {{ $lesson->room }}
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

                {{ $lessons->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>
</div>
