<div>

    <x-app-spinner target="search" />
    <x-app-spinner target="showPersonalGroups" />


    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            <div class="float-left">
                <x-add-button wire:click="update()">
                    <div class="hidden sm:inline-block">
                        Новый
                    </div>
                    Журнал
                </x-add-button>
            </div>

            <div class="m-2 sm:flex text-gray-500 sm:float-right">


                <x-select-semester class=""/>

                <div class="flex mb-2 sm:m-0 sm:mr-2">
                    <x-select class="sm:rounded-none border-green-400 leading-tight" wire:model="showPersonalGroups">
                        <option value="1">Мои группы</option>
                        <option value="0">Все группы</option>
                    </x-select>

                    <x-search class="" />


                    <x-per-page-select class="rounded-r-md" />


                </div>

            </div>


            <table class="min-w-full table-fixed">
                <thead>
                <tr>
                    <th class="p-3 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider">
                        Курс/Факультет/Группа
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                        Занятие
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                        Время
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
                        Дисциплина
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 text-center tracking-wider">
                        Аудитория
                    </th>
                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 text-center tracking-wider">
                        Управление
                    </th>
                    <th class="w-auto px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Изменено
                    </th>
                </tr>
                </thead>
                <tbody>

                @forelse($journals as $journal)

                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="p-3 text-center border-r">
                            {{ (($journals->currentPage() * $perPage) - $perPage) + $loop->iteration }}
                        </td>
                        <td class="text-left p-2 px-4 border-r">
                            <a href="{{ route('lessons', $journal->id) }}" class="cursor-pointer">
                                <div class="flex">
                                    {{ $journal->course_number }} курс
                                    <p class="px-2 text-xl font-bold hover:underline">
                                        Группа {{ $journal->group_number }}
                                    </p>
                                </div>

                                <p class="text-{{ $journal->faculty->color }}-500">
                                    {{ $journal->faculty->name }}
                                </p>
                            </a>
                        </td>
                        <td class="p-3 text-sm text-center border-r">
                            @if (!is_null($journal->date))
                                {{ Str::ucfirst(\Carbon\Carbon::parse($journal->date)->isoFormat('dddd')) }}
                                <p class="text-gray-900 font-bold">
                                    {{ \Carbon\Carbon::parse($journal->date)->translatedFormat('d F Y') }}
                                </p>
                            @endif

                                {{ $journal->day_type }}
                            <div class="text-xs text-gray-500">
                                {{ $journal->getWeekTypeRus() }}
                            </div>
                        </td>
                        <td class="p-3 text-center border-r">

                            {{ \Carbon\Carbon::parse($journal->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($journal->time_end)->format('H:i') }}

                        </td>
                        <td class="p-3 text-sm text-center border-r">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $journal->discipline->short_name }}
                            </p>
                        </td>

                        <td class="p-3 text-sm text-center border-r">
                            <div class="text-xs text-gray-500">
                                {{ $journal->room }}
                            </div>
                        </td>
                        <td class="p-3 border-r">
                            <div class="flex justify-center">
                                @if(\App\Models\Journal::isOwner($journal->user_id))

                                    <x-update-button value="{{ $journal->id }}" />

                                    <x-delete-button value="{{ $journal->id }}" />

                                @endif
                            </div>
                        </td>
                        <td class="p-3 text-xs text-gray-500 text-center">
                                {{ $journal->updated_at->diffForHumans() }}
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

                {{ $journals->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>


    @include('livewire.modals.edit_journal')

</div>
