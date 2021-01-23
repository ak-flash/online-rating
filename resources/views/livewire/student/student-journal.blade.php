<div>



    <div class="pb-2 flex items-center justify-between text-gray-600
        dark:text-gray-400 border-b dark:border-gray-600">
        <!-- Header -->
        <h2 class="mx-4 md:mx-2 text-xl md:text-3xl pt-2 md:pt-0 font-semibold dark:text-gray-400">
            Кафедры
        </h2>

        <div class="my-2 mr-5 md:mt-4 md:mr-0 md:flex">

                <x-select-semester />


            <div class="flex">
                <div class="relative">
                    <select class="block w-full focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm leading-tight border-gray-300 focus:border-indigo-300">
                        <option value="0">Все</option>
                        <option value="1">Есть долги</option>
                        <option value="2">Нет долгов</option>
                    </select>
                </div>

                <x-search />

                <x-per-page-select class="rounded-r-md" />

            </div>
        </div>

    </div>
    <div class="mt-2 flex justify-between text-gray-600 dark:text-gray-400">



<!-- component -->
<div class="container mx-auto px-4 sm:px-0">

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">

            <table class="min-w-full table-fixed">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        №
                    </th>
                    <th class="w-1/2 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Кафедра
                    </th>

                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-bold text-gray-600">
                        Прошедшее занятие
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-bold text-gray-600">
                        Оценки
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 text-center tracking-wider">
                        Преподаватель
                    </th>
                </tr>
                </thead>
                <tbody>

                @forelse($journals as $journal)

                    <tr class="border-b border-gray-200 bg-white hover:bg-gray-100 h-20">
                        <td class="text-center">
                            {{ (($journals->currentPage() * $perPage) - $perPage) + $loop->iteration }}
                        </td>
                        <td class="py-4">
                            <div class="flex items-center ">
                              <button class="text-left text-black font-bold" wire:click="showLessonsPage({{ $journal->id }})">
                                  {{ Str::ucfirst($journal->department->name) }}
                                <div class="text-xs text-gray-500 font-normal">
                                    {{ $journal->discipline->name }}
                                </div>
                              </button>
                            </div>
                        </td>

                        <td class="font-bold text-center">
                            @if($journal->lessons->isNotEmpty())
                                    {{ $journal->lessons[0]->date->translatedFormat('d F y') }}

                                    <div class="text-xs text-gray-600 font-normal">
                                        {{ $journal->lessons[0]->type }}
                                    </div>
                            @endif
                        </td>
                        <td class="px-5 text-center font-bold">
                            @if($journal->lessons->isNotEmpty())
                                <div class="flex justify-center text-lg">
                                    <x-student-marks for="student"
                                        mark1="{{ $journal->lessons[0]->students[0]->pivot->mark1 }}"
                                        mark2="{{ $journal->lessons[0]->students[0]->pivot->mark2 }}"
                                    />

                                </div>
                                {{--<div class="mt-1 rounded-lg bg-green-50 text-green-900 text-xs text-center p-1">
                                    {{ $journal->lessons[0]->students[0]->pivot->updated_at->format('d/m/Y') }}
                                </div>--}}
                            @endif




                        </td>
                        <td class="pl-4">
                            <div class="flex">
                                 <img class="h-10 w-10 rounded-full object-cover mr-2" src="{{ $journal->user->profile_photo_path ?
                 '../storage/'.$journal->user->profile_photo_path : '../img/avatar-placeholder.png' }}" alt="{{ $journal->user->name }}"/>
                                 <div class="flex-col text-gray-900 whitespace-no-wrap text-sm mr-2">
                                     {{ Helper::getShortName($journal->user->name) }}
                                     <div class="text-xs text-gray-500">
                                     {{ $journal->user->position }}
                                     </div>
                                 </div>
                            </div>
                         </td>
                    </tr>


            @empty
                <tr>
                    <td class="p-3 text-red-700 text-sm text-center" colspan="7">
                        Журналы не найдены...
                    </td>
                </tr>
            @endforelse

                </tbody>
            </table>
            <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

                    {{ $journals->links('livewire.pagination-links-view') }}

                </div>
            </div>
        </div>
    </div>
</div>

</div>
