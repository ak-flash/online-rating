<div>

    <x-app-spinner target="search" />
    <x-app-spinner target="receiveFromVolgmed" />
    <x-app-spinner target="import" />

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-12">
        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
            <div class="float-left flex items-center">


                @if(auth()->user()->isModerator())

                    <x-add-button wire:click="update()">
                        Добавить
                    </x-add-button>

                    <x-main-button wire:click="$set('openImport', true)" class="m-2 ml-3">
                        <i class="fa fa-upload mr-1"></i>
                        Импортировать
                    </x-main-button>
                @endif

                <div class="flex ml-5">
                    Дисциплина
                    <div class="ml-2 font-bold">
                        «{{ $discipline->name }}»
                    </div>
                </div>
            </div>
            <div class="m-2 md:flex sm:flex-row flex-col float-right ">
                <x-back-button />

                <x-search class="rounded-l-md" />

                <x-per-page-select class="rounded-r-md" />
            </div>

            <table class="min-w-full table-fixed">
                <thead>
                <tr class="bg-gray-200 border-gray-300 border-b-2 text-gray-600 text-center text-xs">
                    <th class="p-3 w-5 font-bold">
                        №
                    </th>
                    <th class="flex-grow uppercase">
                        Тема занятия
                    </th>

                    @if(auth()->user()->isModerator())
                        <th class="w-1/5 font-bold">
                            Управление
                        </th>
                    @endif
                    <th class="w-36">
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
                        <td class="p-3 border-r text-base">
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
    @include('livewire.modals.import_topics')


</div>
