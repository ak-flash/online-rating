<div>

    <x-app-spinner target="search" />
    <x-app-spinner target="repairStudent" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            <div class="float-left flex items-center items-center py-2">


                @if(\App\Models\Journal::isOwner($journal->user_id))
                    <x-add-button class="mr-5" wire:click="update()">
                        Занятие
                    </x-add-button>
                @endif

                <div class="block ml-3">
                    {{ $journal->course_number }} курс
                    <p class="px-2 text-xl font-bold">
                        Группа {{ $journal->group_number }}
                    </p>
                </div>
                <div class="flex-grow-0 ml-3">
                    <p class="text-{{ $journal->faculty->color }}-500 text-sm">
                        ({{ $journal->faculty->name }})
                    </p>
                    {{ $journal->discipline->name }}
                </div>




            </div>

            <div class="float-right flex m-4 items-center">

                <x-back-button />

                <div class="text-md mr-4">
                    <x-secondary-button class="mr-1" wire:click="$toggle('showOneLesson')" >
                        Показать {{ $showOneLesson ? 'все' : 'последнее' }}
                    </x-secondary-button>
                </div>

                <x-button>Excel</x-button>
            </div>
        </div>
    </div>

    <div class="flex flex-col h-screen mx-auto sm:px-2 lg:px-4 mb-10" id="journal_table">
        <div class="flex-grow overflow-auto bg-white scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-200">
            <table class="relative w-full">
                <thead>
                <tr>
                    <th class="sticky top-0 p-3 w-10 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="sticky top-0 px-5 py-3 w-auto border-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 tracking-wider">
                        Ф.И.О.
                    </th>


                        @if($showOneLesson)
                            <th class="sticky top-0 px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs text-gray-600">

                                <a href="#" title="{{ $lessonsDates[$oneViewIndex]->type }}" wire:click.prevent="update({{ $lessonsDates[$oneViewIndex]->id }})" class="flex items-center justify-center">

                                    {!! $showOneLesson ? '<i class="fas fa-edit text-xl mr-2"></i>' : '' !!}
                                    <div class="flex flex-col">
                                        <div class="text-left text-sm text-center">
                                            {{ $lessonsDates[$oneViewIndex]->date->format('d/m/y') }}
                                        </div>
                                        <div class="font-normal">
                                            {{ $lessonsDates[$oneViewIndex]->date->translatedFormat('l') }}
                                        </div>
                                        @if($lessonsDates[$oneViewIndex]->type_id>=4)
                                            <p class="text-red-700">
                                                {{ $lessonsDates[$oneViewIndex]->type }}
                                            </p>
                                        @endif
                                    </div>
                                </a>
                            </th>


                        @else
                        @foreach($lessonsDates->reverse() as $lesson)
                            <th class="sticky top-0 px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs text-gray-600">

                                <a href="#" title="{{ $lesson->type }}" wire:click.prevent="update({{ $lesson->id }})" class="flex items-center justify-center">

                                    {!! $showOneLesson ? '<i class="fas fa-edit text-xl mr-2"></i>' : '' !!}
                                    <div class="flex flex-col">
                                        <div class="text-left text-sm text-center">
                                            {{ $lesson->date->format('d/m/y') }}
                                        </div>
                                        <div class="font-normal">
                                            {{ $lesson->date->translatedFormat('l') }}
                                        </div>
                                        @if($lesson->type_id>=4)
                                            <p class="text-red-700">
                                                {{ $lesson->type }}
                                            </p>
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
                     <td class="sticky left-0 border-r p-3 text-sm whitespace-nowrap">
                        <div class="rounded-sm p-1 px-2 font-bold bg-gray-200 opacity-90">
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
                        <x-button onclick="openFullscreen()">full</x-button>
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
                                    <x-secondary-button class="" wire:click="editModeEnable({{ $lesson->id }});" >
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

    <x-open-fullscreen for="journal_table" />
</div>
