<x-form-modal wire:model="openModal" :maxWidth="4">

    <x-slot name="title">
        <p class="pt-2 text-lg font-bold">Управление занятием</p>
    </x-slot>

    <x-slot name="content">


        <div class="grid grid-cols-3 gap-4 items-center">

            <label class="">Тип занятия</label>
            <x-select class="col-span-2 w-full" wire:model="studyClassTypeId">
                <option value="">Выберите...</option>
                @foreach(\App\Models\Lesson::TYPES as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-select>
            <x-input-error for="studyClassTypeId" class="col-span-3 text-center" />

            <label class="">Дата</label>
            <x-date-picker wire:model.lazy="date" class="col-span-2 w-1/2"/>
            <x-input-error for="date" class="col-span-3 text-center" />

            <label class="">Время</label>

            <div class="col-span-2 flex items-center">
                <x-input type="text" class="pl-3 pr-1 mr-3 w-16" data-mask='##:##' wire:model.lazy="timeStart" /> -
                <x-input type="text" class="pl-3 pr-1 ml-3 w-16" data-mask='##:##' wire:model.lazy="timeEnd" />
            </div>

            <x-input-error for="timeStart" class="col-span-3 text-center" />
            <x-input-error for="timeEnd" class="col-span-3 text-center" />


            <label class="font-bold">Тема</label>
            <x-select class="col-span-2" wire:model="topicId">
                <option value="">Выберите...</option>
                @forelse($topics as $topic)
                    <option value="{{ $topic->id }}">
                        {{ $topic->t_number }} {{ mb_substr($topic->title, 0, 100) }}
                    </option>
                @empty
                    <option value="">Все темы пройдены!</option>
                @endforelse
            </x-select>
            <x-input-error for="topicId" class="col-span-3 text-center" />



            <label class="font-bold">Учебная комната</label>
            <x-input type="text" class="col-span-2 w-1/2" wire:model.lazy="room" />
            <x-input-error for="room" class="col-span-3 text-center" />

        </div>
    </x-slot>

    <x-slot name="footer">
        @if($studyClassId)
            <x-danger-button class="float-left" wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                Удалить
            </x-danger-button>
        @endif

        <x-button class="mr-2 bg-green-500 hover:bg-green-600 shadow-xl px-5 py-2 text-white rounded" wire:click.prevent="store" wire:loading.attr="disabled">
            Сохранить
        </x-button>




    </x-slot>
</x-form-modal>


<x-confirmation-modal wire:model="confirmingDeletion">
    <x-slot name="title">
        Удалить?
    </x-slot>

    <x-slot name="content">
       Вы уверены, что хотите удалить занятие?
        <div class="m-2 text-bold text-lg">
            Вся информация о занятии (оценки студентов) будет удалена безвозвратно!
        </div>
    </x-slot>

    <x-slot name="footer">

        <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
            Удалить
        </x-danger-button>

        <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
            Отмена
        </x-secondary-button>
    </x-slot>
</x-confirmation-modal>
