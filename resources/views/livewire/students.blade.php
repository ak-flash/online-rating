<div>

    <x-app-spinner target="search" />
    <x-app-spinner target="findByFaculty" />
    <x-app-spinner target="findByCourse" />
    <x-app-spinner target="findByGroup" />
    <x-app-spinner target="import" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-12">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            <div class="float-left w-auto flex items-center mr-10">
                <x-add-button wire:click="update()">
                    Добавить
                </x-add-button>

                @if(auth()->user()->isModerator())
                    <x-main-button wire:click="showImport" class="m-2">
                        <i class="fa fa-upload mr-1"></i>
                        Импортировать
                    </x-main-button>
                @endif

            </div>

            <div class="m-2 md:flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">

                    <x-select class="rounded-l" wire:model="findByFaculty">
                        <option value="0">Все специальности</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->speciality }}</option>
                        @endforeach
                    </x-select>

                    <x-select class="" wire:model="findByCourse">
                        <option value="0">Все курсы</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </x-select>

                    <x-select class="" wire:model="findByGroup">
                        <option value="0">Все группы</option>
                        @for ($i = 1; $i <= 55; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </x-select>
                </div>

                <x-search class="w-auto" />

                <x-per-page-select  class="rounded-r-md" />

            </div>

            <table class="min-w-full table-fixed">
                <thead>
                <tr class="border-b-2 border-gray-200 text-center bg-gray-100 font-bold text-xs text-gray-600">
                    <th class="font-bold uppercase">
                        №
                    </th>
                    <th class="w-1/4 px-5 py-3 text-left uppercase">
                        Ф.И.О
                    </th>
                    <th class="w-1/4 text-left">
                        Курс/Факультет/Группа
                    </th>
                    <th class="w-auto">
                        № зачётки
                    </th>
                    <th class="w-1/5">
                        E-mail/Телефон
                    </th>
                    <th class="w-1/7">
                        Управление
                    </th>

                    <th class="px-5">
                        Изменено
                    </th>
                </tr>
                </thead>
                <tbody>


                @foreach($students as $student)

                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="px-2 py-2 {{ !$student->active ? 'bg-red-300' : '' }} text-sm text-center">
                            {{ $student->id }}
                        </td>
                        <td class="text-sm text-left">
                            <img class="h-10 w-10 rounded-full object-cover mr-3 flex sm:float-left" src="{{ $student->profile_photo_url }}" />

                            <div class="{{ !$student->active ? 'line-through' : '' }} md:whitespace-nowrap font-bold ">
                                {{ $student->last_name }}
                            </div>
                            <div class="flex text-sm text-gray-700">
                                {{ $student->name }}

                            </div>
                        </td>
                        <td class="p-2 text-xs text-left">

                            <div class="flex ">
                                <div class="p-2 bg-{{ ($student->course_number>=3) ? 'green' : 'yellow' }}-600 text-base text-white  rounded-l">
                                    {{ $student->course_number }}
                                </div>
                                <div class="p-2 pt-3 bg-{{ $student->faculty->color }}-600 text-white">
                                    {{ $student->faculty->speciality }}
                                </div>
                                <div class="p-2 bg-gray-600 text-base text-white rounded-r {{ $student->chief ? 'text-red-900': '' }}">
                                    {{ $student->group_number }}
                                </div>
                            </div>

                        </td>
                        <td class="text-sm text-center">
                            {{ $student->document_id }}
                        </td>
                        <td class="text-sm text-center">
                            <p class="text-gray-900">
                                {{ $student->email }}
                            </p>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $student->phone ?? '-' }}
                            </p>
                        </td>
                        <td class="border">
                            <div class="flex justify-center px-2">
                                <x-update-button value="{{ $student->id }}" />

                                @if(auth()->user()->isModerator())
                                    <x-delete-button value="{{ $student->id }}" />
                                @endif
                            </div>
                        </td>
                        <td class="px-2 text-gray-500 text-xs text-center">
                            {{ $student->updated_at->diffForHumans() }}
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
            <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

                {{ $students->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>


    @include('livewire.modals.edit_student')

    @if(auth()->user()->isModerator())
        @include('livewire.modals.import_students')
    @endif

</div>
