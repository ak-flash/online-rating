<div>
    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <button class="bg-green-700 hover:bg-green-500 ml-5 m-2 p-2 px-4
                                     text-white text-sm font-semibold rounded">
                <i class="fas fa-plus" style="font-size:12px;"></i> Новый Журнал
            </button>

            <div class="m-2 hidden md:flex sm:flex-row flex-col float-right">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <select class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="perPage">
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
                        <select class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500" wire:model="showPersonalGroups">
                            <option value="1">Мои группы</option>
                            <option value="0">Все группы</option>
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
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Курс/Факультет/Группа
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        Дата
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


                @foreach($lessons as $lesson)

                    <tr>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                            {{ (($lessons->currentPage() * $perPage) - $perPage) + $loop->iteration }}
                        </td>
                        <td class="border-b border-gray-200 bg-white text-sm text-left">
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
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                            {{ Str::ucfirst(\Carbon\Carbon::parse($lesson->date)->isoFormat('dddd')) }}
                            <p class="text-gray-900 font-semibold">
                                {{ \Carbon\Carbon::parse($lesson->date)->translatedFormat('d F Y') }}


                            </p>

                            <div class="text-xs text-gray-500">
                                {{ $lesson->type }}
                            </div>
                        </td>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">

                            {{ \Carbon\Carbon::parse($lesson->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($lesson->time_end)->format('H:i') }}

                        </td>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $lesson->discipline_id }}
                            </p>
                        </td>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                            <div class="text-xs text-gray-500">
                                {{ $lesson->title }}
                            </div>
                        </td>
                        <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                            <div class="text-xs text-gray-500">
                                {{ $lesson->room }}
                            </div>
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
            <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

                {{ $lessons->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>
</div>
