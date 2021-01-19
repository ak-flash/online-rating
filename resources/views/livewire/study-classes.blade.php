<div>

    <x-app-spinner target="search" />


    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            <div class="float-left flex items-center items-center py-2">


                @if(\App\Models\Journal::isOwner($journal->user_id))
                    <x-add-button class="mr-5" wire:click="update()">
                        Занятие
                    </x-add-button>
                @endif

                    {{ $journal->course_number }} курс
                    <p class="px-2 text-xl font-bold">
                        Группа {{ $journal->group_number }}
                    </p>
                    <p class="text-{{ $journal->faculty->color }}-500 text-sm">
                        ({{ $journal->faculty->name }})
                    </p>


            </div>

            <div class="float-right flex m-4 items-center">

                <x-back-button />

                <div class="text-md mr-4">
                    <x-secondary-button class="mr-1" wire:click="$toggle('onlyCurrentLesson')" >
                        Показать {{ $onlyCurrentLesson ? 'все' : 'последнее' }}
                    </x-secondary-button>
                </div>

                <x-button>Excel</x-button>
            </div>
        </div>
    </div>

    <div class="flex flex-col h-screen mx-auto sm:px-2 lg:px-4 mb-10">
        <div class="flex-grow overflow-auto bg-white scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-200">
            <table class="relative w-full">
                <thead>
                <tr>
                    <th class="sticky top-0 px-5 py-3 w-10 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="sticky top-0 px-5 py-3 w-auto border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Ф.И.О.
                    </th>

                    @foreach($study_classes->sortBy('date') as $study_class)
                            <th class="sticky top-0 px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs text-gray-600">
                                <a href="#" title="{{ $study_class->type }}" wire:click.prevent="update({{ $study_class->id }})" class="flex items-center justify-center">

                                    {!! $onlyCurrentLesson ? '<i class="fas fa-edit text-xl mr-2"></i>' : '' !!}
                                    <div class="flex flex-col">
                                        <div class="text-left text-sm text-center">
                                            {{ $study_class->date->format('d/m/y') }}
                                        </div>
                                        <div class="">
                                            {{ $study_class->date->translatedFormat('l') }}
                                        </div>
                                        @if($study_class->type_id>=4)
                                            <p class="text-red-700">
                                                {{ $study_class->type }}
                                            </p>
                                        @endif
                                    </div>


                                </a>
                            </th>

                    @endforeach
                    @if($study_classes->isNotEmpty())
                        <th class="sticky top-0 px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                            Рейтинг
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody>


                @forelse($study_classes->flatMap->students->groupBy('id')->all() as $student)



                    <tr class="border-t hover:bg-gray-100">
                        <td class="border-r p-3 text-center">
                          {{ $loop->iteration }}
                        </td>
                        <td class="sticky left-0 border-r p-3 text-sm whitespace-nowrap">
                            <div class="font-bold">
                                {{ $student[0]['last_name'] }}
                            </div>
                            {{ $student[0]['name'] }}
                        </td>

                        @php
                            $rating = array();
                        @endphp

                        @foreach($student->reverse() as $student_study_class)

                        <td class="border-r p-3 text-sm text-center">

                            <div class="flex justify-center text-lg">

                                @php
                                    $index_for_cycle = $loop->iteration - 1;
                                @endphp

{{--                                 If editor mode enabled insert livewire component--}}
                                @if($editMode && $editStudyClassId == $student[$index_for_cycle]['pivot']['study_class_id'])
                                    <div class="mr-3">
                                        @livewire('edit-mark',
                                            ['mark' => $student_study_class->pivot->mark1,
                                            'lesson_id' => $student_study_class->pivot->id,
                                            'type' => 'mark1'],
                                            key('unique-'.$student_study_class->id.'-mark1-'.$student_study_class->pivot->id.$loop->iteration))
                                    </div>
                                    <div class="">
                                        @livewire('edit-mark',
                                            ['mark' => $student_study_class->pivot->mark2,
                                            'lesson_id' => $student_study_class->pivot->id,
                                            'type' => 'mark2'],
                                    key('unique-'.$student_study_class->id.'-mark2-'.$student_study_class->pivot->id.$loop->iteration))
                                    </div>
                                @else
                                    <x-student-marks for="teacher"
                                        mark1="{{ $student_study_class->pivot->mark1 }}"
                                        mark2="{{ $student_study_class->pivot->mark2 }}"
                                    />


                                @endif
                            </div>
                        </td>
                            @php
                                $rating[] = $student_study_class->pivot->mark1;
                                $rating[] = $student_study_class->pivot->mark2;
                            @endphp
                        @endforeach
                        <td class="border-r p-3 text-sm text-center">
                            {{  \App\Http\Livewire\StudyClasses::getRating($rating) }}
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
                <tr class="border">
                    <td colspan="2" class="border-r">

                    </td>
                    @foreach($study_classes as $study_class)

                            <td class="p-2 border-r">
                                <div class="flex justify-center">
                                    <x-secondary-button class="" wire:click="editModeEnable({{ $study_class->id }});" >
                                   {{ ($editMode && $editStudyClassId == $study_class->id) ? 'Закрыть' : 'Изменить' }}
                                    </x-secondary-button>
                                </div>
                            </td>

                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
        </div>


    @include('livewire.modals.edit_study_class')

</div>
