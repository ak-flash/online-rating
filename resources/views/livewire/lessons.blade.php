<div>

    <x-app-spinner target="search" />
    <x-app-spinner target="repairStudent" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            <div class="sm:float-left flex items-center items-center py-2">



                @if(\App\Models\Journal::isOwner($journal->user_id))
                    <x-add-button wire:click="update()">
                        Занятие
                    </x-add-button>
                @endif

                <div class="block ml-2 sm:ml-8">
                    {{ $journal->course_number }} курс
                    <p>
                        Группа
                    </p>
                </div>

                <div class="px-2 text-3xl font-bold">
                    {{ $journal->group_number }}
                </div>

                <div class="flex-grow-0 ml-3">
                    <p class="text-{{ $journal->faculty->color }}-500 text-sm">
                        ({{ $journal->faculty->name }})
                    </p>
                    {{ $journal->discipline->name ?? '-' }}
                    {{ $journal->discipline->trashed() ? '(в архиве)' : '' }}
                </div>




            </div>

            <div class="sm:float-right flex m-4 items-center justify-between">

                <x-back-button class="" />


                <div class="bg-gray-200 text-sm text-gray-500 leading-none border-2 border-gray-200 rounded-full inline-flex mr-2" x-data>
                    <button class="inline-flex items-center focus:outline-none hover:text-green-400 focus:text-green-600 rounded-l-full px-4 py-2 {{ $showOneLesson ? '' : 'active' }}" wire:click="$set('showOneLesson', false)">
                        <i class="fas fa-border-all mr-2"></i>
                        <span class="hidden sm:block">Все</span>
                    </button>
                    <button class="inline-flex items-center focus:outline-none hover:text-green-400 focus:text-green-600 rounded-r-full px-4 py-2 {{ $showOneLesson ? 'active' : '' }}" wire:click="$set('showOneLesson', true)">
                        <i class="fas fa-list mr-2"></i>
                        <span class="hidden sm:block">Последнее</span>
                    </button>

                    <style>
                        /*@apply bg-white text-blue-400 rounded-full;*/
                        .active {background: white; border-radius: 9999px; color: green;}
                    </style>
                </div>



                <x-secondary-button class="ml-3" onclick="openFullscreen('journal_table')">
                    <i class="fa fa-expand-arrows-alt text-lg text-green-700"></i>
                </x-secondary-button>
            </div>
        </div>
    </div>

    <div class="flex flex-col h-screen mx-auto sm:px-2 lg:px-4 mb-10" id="journal_table">
        <div class="flex-grow overflow-auto bg-white md:scrollbar md:scrollbar-thumb-gray-400 md:scrollbar-track-gray-200">
            <table class="relative w-full">
                <thead>
                <tr class="z-5 pin-t">
                    <th class="sticky top-0 p-3 w-10 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="sticky top-0 px-5 py-3 w-auto border-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 tracking-wider">
                        Ф.И.О.
                    </th>


                        @if($showOneLesson && $lastLesson)
                            <th class="sticky top-0 px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs text-gray-600">

                                <a href="#" title="{{ $lastLesson->type }}" wire:click.prevent="update({{ $lastLesson->id }})" class="flex items-center justify-center hover:underline">

                                    {!! $showOneLesson ? '<i class="fas fa-edit text-xl mr-2"></i>' : '' !!}

                                    <div class="text-left text-sm text-center">
                                        {{ $lastLesson->date->format('d/m/y') }}
                                    </div>
                                </a>
                                <div class="font-normal">
                                    {{ $lastLesson->date->translatedFormat('l') }}
                                </div>
                                <a href="#" title="{{ $lastLesson->topic->title }}" wire:click.prevent="showTopic({{ $lastLesson->topic->id }})" class="flex items-center justify-center hover:underline">
                                    @if($lastLesson->type_id>=4)
                                        <p class="text-red-700 text-lg">
                                            №{{ $lastLesson->topic->t_number }} - {{ $lastLesson->type }}
                                        </p>
                                    @else
                                        <div class="flex items-center text-lg" justify-center">
                                            №
                                            <div class="text-base text-xl">
                                                {{ $lastLesson->topic->t_number }}
                                            </div>
                                        </div>
                                     @endif

                                </a>

                            </th>


                        @else
                            @foreach($lessonsDates->reverse() as $lesson)
                                <th class="sticky top-0 px-5 py-1 border-2 border-gray-200 bg-gray-100 text-xs text-gray-600">

                                    <a href="#" title="{{ $lesson->type }}" wire:click.prevent="update({{ $lesson->id }})" class="justify-center">

                                        {!! $showOneLesson ? '<i class="fas fa-edit text-xl mr-2"></i>' : '' !!}
                                        <div class="flex flex-col whitespace-nowrap">
                                            <div class="text-left hover:underline text-sm text-center">
                                                {{ $lesson->date->format('d/m/y') }}
                                            </div>
                                    </a>
                                            <div class="font-normal">
                                                {{ $lesson->date->translatedFormat('l') }}
                                            </div>


                                    <a href="#" title="{{ $lesson->topic->title }}" wire:click.prevent="showTopic({{ $lesson->topic->id }})" class="flex items-center justify-center hover:underline">
                                            @if($lesson->type_id>=4)
                                                <p class="text-red-700">
                                                  №{{ $lesson->topic->t_number }} - {{ $lesson->type }}
                                                </p>
                                            @else
                                                <div class="flex items-center justify-center">
                                                    №
                                                    <div class="text-base">
                                                        {{ $lesson->topic->t_number }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </th>

                            @endforeach
                        @endif
                    @if($lessons->isNotEmpty())
                        <th class="sticky top-0 px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                            Рейтинг
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody>

                @forelse($lessons->groupBy('st_id') as $student)

                    <tr class="border-t hover:bg-gray-100">
                        <td class="border-r p-2 text-center">
                          {{ $loop->iteration }}
                        </td>
                     <td class="sticky left-0 border-r pl-2 sm:p-3 text-sm whitespace-nowrap">
                        <div class="rounded-sm p-1 px-2 font-bold bg-gray-200 opacity-90 w-1/2">
                            {{ $student[0]->last_name }}
                        </div>
                        {{ $student[0]->name }}
                    </td>

                    @foreach($student->reverse() as $student_lesson)

                        @if($lessonsDates[$oneViewIndex-$loop->index]->date->eq(
                                        Helper::formatDate($student_lesson->date, 'Y-m-d H:i:s')
                                        ))

                            <td class="border-r p-3 text-sm text-center">

                                <div class="flex justify-center text-lg">

{{--                             If editor mode enabled insert livewire component--}}
                                    @if($editMode && $editStudyClassId == $student_lesson->id)
                                        <div class="mr-3">
                                            @livewire('edit-mark',
                                                ['mark' => $student_lesson->mark1,
                                                'lesson_student_id' => $student_lesson->piv_id,
                                                'type' => 'mark1'],
                                                key('unique-'.$student_lesson->id.'-mark1-'.$student_lesson->topic_id))
                                        </div>
                                        <div class="">
                                            @livewire('edit-mark',
                                                ['mark' => $student_lesson->mark2,
                                                'lesson_student_id' => $student_lesson->piv_id,
                                                'type' => 'mark2'],
                                        key('unique-'.$student_lesson->id.'-mark2-'.$student_lesson->topic_id))
                                        </div>
                                    @else
                                        <x-student-marks for="teacher"
                                            mark1="{{ $student_lesson->mark1 }}"
                                            mark2="{{ $student_lesson->mark2 }}"
                                        />


                                    @endif
                                </div>
                            </td>
                        @else
                            <td class="border-r p-2 text-center">
                                <div class="rounded-sm p-1 px-2 bg-gray-200 opacity-90">
                                    Отсутствуют некоторые занятия
                                    <x-button wire:click.prevent="repairStudent({{ $student_lesson->id }}, {{ $journal->id }})" class="normal-case m-2 h-7">
                                        Исправить
                                    </x-button>
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <td class="border-r p-3 text-sm text-center">

                    </td>
                    </tr>


                @empty
                    @forelse($students as $student)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="border-r p-3 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border-r p-3 text-sm whitespace-nowrap">
                                <div class="font-bold">
                                    {{ $student->last_name }}
                                </div>
                                {{ $student->name }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-3 text-red-700 text-md text-center" colspan="7">
                                Студенты не найдены...
                            </td>
                        </tr>
                    @endforelse
                @endforelse

{{--                Table bottom--}}
                <tr class="border">
                    <td colspan="2" class="border-r">
                        <div class="flex">
                            <x-button class="ml-3">
                                <i class="fa fa-download shadow-lg mr-2 text-white"></i>
                                Excel
                            </x-button>
                        </div>

                    </td>

                    @if($showOneLesson)
                        <td class="p-2 border-r">
                            <div class="flex justify-center">
                                <x-secondary-button class="" wire:click="editModeEnable({{ $lessonsDates[$oneViewIndex]->id }});" >
                                    {{ ($editMode && $editStudyClassId == $lessonsDates[$oneViewIndex]->id) ? 'Закрыть' : 'Изменить' }}
                                </x-secondary-button>
                            </div>
                        </td>
                    @else
                        @foreach($lessonsDates->reverse() as $lesson)

                            <td class="p-2 border-r">
                                <div class="flex justify-center">
                                    <x-secondary-button class="mb-3" wire:click="editModeEnable({{ $lesson->id }});" >
                                        {{ ($editMode && $editStudyClassId == $lesson->id) ? 'Закрыть' : 'Изменить' }}
                                    </x-secondary-button>
                                </div>
                            </td>

                        @endforeach
                    @endif
                </tr>
                </tbody>
            </table>

        </div>
        </div>


    @include('livewire.modals.edit_lesson')

</div>
