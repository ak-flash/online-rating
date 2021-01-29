<x-form-modal wire:model="openModal" :maxWidth="4">

    <x-slot name="title">
        <p class="pt-2 text-lg font-bold">Управление журналом</p>
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center"  x-data="">

            <label class="">Тип занятия</label>
            <x-select class="w-full" wire:model="weekTypeId">
                <option value="">Выберите...</option>
                @foreach(\App\Models\Journal::WEEKTYPESRUS as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-select>
            <x-select class="w-full" wire:model="dayTypeId">
                <option value="">Выберите...</option>
                @foreach(\App\Models\Journal::DAYTYPES as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-select>
            <x-input-error for="weekTypeId" class="col-span-3 text-center" />
            <x-input-error for="dayTypeId" class="col-span-3 text-center" />

            <label class="">Время</label>

            <div class="col-span-2 flex items-center">
                <x-input type="text" class="pl-3 pr-1 mr-3 w-16" data-mask='##:##' wire:model.lazy="timeStart" /> -
                <x-input type="text" class="pl-3 pr-1 ml-3 w-16" data-mask='##:##' wire:model.lazy="timeEnd" />
            </div>

            <x-input-error for="timeStart" class="col-span-3 text-center" />
            <x-input-error for="timeEnd" class="col-span-3 text-center" />


            <label class="font-bold">Дисциплина</label>
            <x-select class="col-span-2" wire:model="disciplineId" id="discipline">
                <option value="">Выберите...</option>
                @foreach($disciplines as $discipline)
                    <option value="{{ $discipline->id }}">{{ $discipline->name }}
                        ({{ Helper::getCourseNumber($discipline->semester) }} {{ $discipline->faculty->tag }} {{ $discipline->semester }} семестр)
                    </option>
                @endforeach
            </x-select>
            <x-input-error for="disciplineId" class="col-span-3 text-center" />

            <label class="font-bold">Факультет</label>
            <span class="col-span-2" x-text="getFaculty()"></span>

            <label class="font-bold">Группа</label>
            <x-select class="col-span-2 w-1/3" wire:model="groupNumber" disabled>
                <option value="">...</option>
                @for ($i = 1; $i <= 55; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="groupNumber" class="col-span-3 text-center" />

            <label class="font-bold">Учебная комната</label>
            <x-input type="text" class="col-span-2 w-1/2" wire:model.lazy="room" />
            <x-input-error for="room" class="col-span-3 text-center" />

        </div>


    </x-slot>

    <x-slot name="footer">

        <x-button class="mr-2 bg-green-500 hover:bg-green-600 shadow-xl px-5 py-2 text-white rounded" wire:click.prevent="store()" wire:loading.attr="disabled">
            Сохранить
        </x-button>

    </x-slot>
</x-form-modal>


<x-confirmation-modal wire:model="confirmingDeletion">
    <x-slot name="title">
        Удалить?
    </x-slot>

    <x-slot name="content">
       Вы уверены, что хотите удалить журнал?
        <div class="m-2 text-bold text-lg">

        </div>
    </x-slot>

    <x-slot name="footer">

        <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
            Удалить
        </x-danger-button>

        <x-secondary-button wire:click="$set('confirmingDeletion', false)" wire:loading.attr="disabled">
            Отмена
        </x-secondary-button>
    </x-slot>
</x-confirmation-modal>

<script>
    function getFaculty() {
        let selected = document.getElementById("discipline");
        let text = "-";

        if(selected!==null && selected.selectedIndex!==0) {
            text = selected.options[selected.selectedIndex].text;
            text = text.match(/\((.*?)\)/g);
        }
        return text;
    }
</script>
