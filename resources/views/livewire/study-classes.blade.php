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
                <div class="text-md mr-4">
                    <x-secondary-button class="mr-1" wire:click="$toggle('onlyCurrentLesson')" >
                        Показать {{ $onlyCurrentLesson ? 'все занятия' : 'последнее' }}
                    </x-secondary-button>
                </div>

                <x-button>Excel</x-button>
            </div>


            <table class="min-w-full table-fixed">
                <thead>
                <tr>
                    <th class="px-5 py-3 w-10 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="px-5 py-3 w-auto border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Ф.И.О.
                    </th>

                    @foreach($study_classes->sortBy('date') as $study_class)
                            <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs text-gray-600">
                                <a href="#" title="{{ $study_class->type }}" wire:click.prevent="update({{ $study_class->id }})" class="flex items-center justify-center">
                                    <i class="fas fa-edit text-xl"></i>
                                    <div class="ml-2 flex flex-col">
                                        <div class="text-left text-sm">
                                            {{ $study_class->date->format('d/m/y') }}
                                        </div>
                                        <div class="">
                                            {{ $study_class->date->translatedFormat('l') }}
                                        </div>
                                    </div>
                                    @if($study_class->type_id>=4)
                                        <div class="text-red-700">
                                            {{ $study_class->type }}
                                        </div>
                                    @endif

                                </a>
                            </th>

                    @endforeach
                    @if($study_classes->isNotEmpty())
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
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
                        <td class="border-r p-3 text-sm whitespace-nowrap">
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

                            <div class="flex justify-center">
                                @livewire('edit-mark',
                                        ['mark' => $student_study_class->pivot->mark1,
                                        'lesson_id' => $student_study_class->pivot->id,
                                        'type' => 'mark1'],
                                        key('student-'.$student_study_class->id.'-mark1-'.$student_study_class->pivot->id.$loop->iteration))

                                @livewire('edit-mark',
                                        ['mark' => $student_study_class->pivot->mark2,
                                        'lesson_id' => $student_study_class->pivot->id,
                                        'type' => 'mark2'],
                                key('student-'.$student_study_class->id.'-mark2-'.$student_study_class->pivot->id.$loop->iteration))
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

                </tbody>
            </table>

        </div>
    </div>

    @include('livewire.modals.edit_study_class')

</div>
