<div>

    <x-app-spinner target="search" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-12">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
            <div class="float-left">
                <a href="{{ url()->previous() }}">
                    <x-secondary-button class="ml-3">
                        <- Назад
                    </x-secondary-button>
                </a>

                @if(auth()->user()->isModerator())

                    <x-add-button wire:click="update()">
                        Добавить
                    </x-add-button>

                @endif
            </div>
            <div class="m-2 md:flex sm:flex-row flex-col float-right ">

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
                    <th class="p-3 w-5 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                        №
                    </th>
                    <th class="flex-grow px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 text-center uppercase tracking-wider">
                        Тема занятия
                    </th>

                    @if(auth()->user()->isModerator())
                        <th class="w-1/5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                            Управление
                        </th>
                    @endif
                    <th class="w-auto px-5 py-3 border-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 text-center tracking-wider">
                        Изменено
                    </th>
                </tr>
                </thead>
                <tbody>


                @forelse($topics as $topic)

                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="text-sm text-center border-r">
                            {{ $topic->t_number }}
                        </td>
                        <td class="p-3 border-r">
                                {{ $topic->title }}
                        </td>

                        @if(auth()->user()->isModerator())
                            <td class="border-r">
                                <div class="flex justify-center">
                                    <x-update-button value="{{ $topic->id }}" />
                                    <x-delete-button value="{{ $topic->id }}" />
                                </div>
                            </td>
                        @endif
                        <td class="w-5 text-gray-500 text-xs text-center">
                            {{ $topic->updated_at->diffForHumans() }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="p-3 text-red-700 text-sm text-center" colspan="7">
                            Темы занятий не найдены...
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">

                {{ $topics->onEachSide(1)->links('livewire.pagination-links-view') }}

            </div>
        </div>
    </div>


    @include('livewire.modals.edit_topic')



</div>
