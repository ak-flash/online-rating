<div>

    <x-app-spinner target="search" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-12">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

            @if(auth()->user()->isModerator())
                <div class="float-left">
                    <x-add-button wire:click="update()">
                        Добавить
                    </x-add-button>
                </div>
            @endif
            <div class="m-2 md:flex sm:flex-row flex-col float-right ">
                <div class="flex flex-row mb-1 sm:mb-0">

                    <select class="rounded-l block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="findByFaculty">
                        <option value="0">Все факультеты</option>
                        @foreach(\App\Models\Faculty::all(['id','name']) as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>


                </div>

                <x-search />

                <div class="flex flex-row mb-1 sm:mb-0">
                    <select class="rounded-r block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300" wire:model="perPage">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>
                </div>
            </div>

            <table class="min-w-full table-fixed">
                <thead>
                <tr>
                    <th class="p-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="w-1/3 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Название
                    </th>
                    <th class="w-1/5 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Короткое
                    </th>
                    <th class="w-1/5 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Курс/Семестр
                    </th>
                    <th class="w-auto px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Факультет
                    </th>
                    <th class="w-1/5 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        ПА
                    </th>
                    @if(auth()->user()->isModerator())
                        <th class="w-1/3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Управление
                        </th>
                    @endif
                    <th class="w-auto px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Изменено
                    </th>
                </tr>
                </thead>
                <tbody>


                @forelse($disciplines as $discipline)

                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="text-sm text-center">
                            {{ (($disciplines->currentPage() * $perPage) - $perPage) + $loop->iteration }}
                        </td>
                        <td class="p-3 text-sm text-center">
                            <a href="{{ route('topics', $discipline->id) }}" class="cursor-pointer hover:underline">
                            {{ $discipline->name }}
                            </a>
                        </td>
                        <td class="p-3 text-gray-900 text-xs text-center">
                                {{ $discipline->short_name }}
                        </td>
                        <td class="p-3 text-sm text-center">

                            <div class="inline text-2xl">
                                {{ \App\Models\Faculty::getCourseNumber($discipline->semester) }}
                            </div>

                                ({{ $discipline->semester }} сем)
                        </td>
                        <td class="p-3 text-xs text-center">
                            <p class="text-white bg-{{ $discipline->faculty->color }}-600 rounded-md p-2">
                                {{ $discipline->faculty->name }}

                            </p>
                        </td>
                        <td class="p-3 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $discipline->last_class }}
                            </p>
                        </td>
                        @if(auth()->user()->isModerator())
                            <td class="p-3 border">
                                <div class="flex justify-center">
                                    <x-update-button value="{{ $discipline->id }}" />
                                    <x-delete-button value="{{ $discipline->id }}" />
                                </div>
                            </td>
                        @endif
                        <td class="p-1 w-5 text-gray-500 text-xs text-center">
                            {{ $discipline->updated_at->diffForHumans() }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="p-3 text-red-700 text-sm text-center" colspan="7">
                            Дисциплины не найдены...
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

                {{ $disciplines->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>


    @include('livewire.modals.edit_discipline')



</div>
