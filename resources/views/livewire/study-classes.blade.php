<div>

    <x-app-spinner target="search" />


    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            <div class="float-left">

            </div>

            <div class="m-2 hidden md:flex sm:flex-row flex-col float-right">
                <div class="flex flex-row mb-1 sm:mb-0">

                    <select class="text-gray-500 py-2 px-4 pr-8 leading-tight" wire:model="showPersonalGroups">
                        <option value="1">Мои группы</option>
                        <option value="0">Все группы</option>
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
                        Ф.И.О.
                    </th>

                    @foreach($study_classes as $study_class)
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        {{ $study_class->date->format('d/m/y') }}

                        {{ $study_class->type }}
                    </th>
                    @endforeach
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        Рейтинг
                    </th>
                </tr>
                </thead>
                <tbody>

                @forelse($study_classes->flatMap->students->groupBy('id') as $student)

                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center">
                          {{ $loop->iteration }}
                        </td>
                        <td class="p-3 text-sm">
                            {{ $student[0]['last_name'] }}
                            {{ $student[0]['name'] }}
                        </td>


                        @foreach($student as $student_study_class)

                        <td class="p-3 text-sm text-center">
                            {{ $student_study_class->pivot->mark1 }}


                        </td>
                        @endforeach
                    </tr>


                @empty
                    <tr>
                        <td class="p-3 text-red-700 text-md text-center" colspan="7">
                            Студенты не найдены...
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

        </div>
    </div>

{{--    @include('livewire.modals.edit_study_class')--}}

</div>
