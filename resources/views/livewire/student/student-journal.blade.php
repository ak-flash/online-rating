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
                    <select class="block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300">
                        <option value="0">Все</option>
                        <option value="1">Есть долги</option>
                        <option value="2">Нет долгов</option>
                    </select>
                </div>

                <x-search />

                <select class="hidden md:block rounded-r  bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="perPage">
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                </select>
            </div>
        </div>

    </div>
    <div class="mt-2 flex justify-between text-gray-600 dark:text-gray-400">
        <!-- List sorting -->


{{--<!-- Card -->
    <div class="mt-2 flex px-4 py-4 justify-between bg-white
        dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">





    </div>--}}


<!-- component -->
<div class="container mx-auto px-4 sm:px-0">

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        №
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Кафедра
                    </th>

                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600">
                        Прошедшее занятие
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600">
                        Оценки
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Преподаватель
                    </th>
                </tr>
                </thead>
                <tbody>

            @if($lessons->isNotEmpty())
                @foreach($lessons as $lesson)

                <tr class="border-b border-gray-200 bg-white hover:bg-gray-100">
                    <td class="text-center">
                        {{ (($lessons->currentPage() * $perPage) - $perPage) + $loop->iteration }}
                    </td>
                    <td class="py-4">
                        <div class="flex items-center ">
                          <button class="text-left text-black font-bold" wire:click="showMarks({{ $lesson->discipline->id }})">
                              {{ Str::ucfirst($lesson->department->name) }}
                            <div class="text-xs text-gray-500 font-normal">
                                {{ $lesson->discipline->name }}
                            </div>
                          </button>
                        </div>
                    </td>

                    <td class="font-bold text-center">

                        @if($lesson->study_classes->isNotEmpty())

                            {{ \Carbon\Carbon::parse($lesson->study_classes[0]->date)->translatedFormat('d F Y') }}
                            <div class="text-xs text-gray-600 font-thin">
                                {{ $lesson->study_classes[0]->type }}
                            </div>

                        @endif

                    </td>
                    <td class="px-5 text-center font-semibold">
                        @if($lesson->study_classes->isNotEmpty()&&$lesson->study_classes[0]->updated_at!=NULL)

                            {{--<div class="flex justify-center">
                                {!! App\Models\StudyClass::set_mark_color($lesson->study_classes[0]->mark1) !!}

                                {!! App\Models\StudyClass::set_mark_color($lesson->study_classes[0]->mark2) !!}


                            </div>--}}
                            <div class="rounded-lg bg-green-50 text-green-900 text-xs text-center p-1">
                                {{ $lesson->study_classes[0]->updated_at->format('d/m/Y') }}
                            </div>
                        @endif
                    </td>
                    <td class="pl-4">
                        <div class="flex">
                             <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ $lesson->user->profile_photo_path ?
             '../storage/'.$lesson->user->profile_photo_path : '../img/avatar-placeholder.png' }}"/>
                             <div class="flex-col text-gray-900 whitespace-no-wrap text-sm">
                                 {{ $lesson->user->name }}
                                 <div class="text-xs text-gray-500">
                                 {{ $lesson->user->position }}
                                 </div>
                             </p>
                        </div>
                     </td>
                </tr>

                @endforeach
            @else
                <tr>
                    <td class="p-3 text-red-700 text-sm text-center" colspan="7">
                        Журналы не найдены...
                    </td>
                </tr>
            @endif

                </tbody>
            </table>
            <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

                    {{ $lessons->links('livewire.pagination-links-view') }}

                </div>
            </div>
        </div>
    </div>
</div>

</div>
