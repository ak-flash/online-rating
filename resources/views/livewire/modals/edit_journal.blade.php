<x-form-modal wire:model="openModal" :maxWidth="4">

    <x-slot name="title">
        <p class="pt-2 text-lg font-semibold">Управление журналом</p>
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center"  x-data="{ faculty: null }">

            <label class="">Тип занятия</label>
            <x-select class="col-span-2 w-3/5" wire:model="day_type_id">
                <option value="">Выберите...</option>
                @foreach(\App\Models\Journal::DAYTYPESRUS as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-select>
            <x-input-error for="day_type_id" class="col-span-3 text-center" />

            <label class="">Время</label>
            <x-input type="text" class="w-1/2" data-mask='##:##' wire:model.lazy="time_start" />
            <x-input type="text" class="w-1/2" data-mask='##:##' wire:model.lazy="time_end" />
            <x-input-error for="time_start" class="col-span-3 text-center" />
            <x-input-error for="time_end" class="col-span-3 text-center" />


            <label class="font-bold">Дисциплина</label>
            <x-select class="col-span-2" wire:model="discipline_id" id="discipline">
                <option value="">Выберите...</option>
                @foreach($disciplines as $discipline)
                    <option value="{{ $discipline->id }}">{{ $discipline->name }}
                        ({{ Faculty::getCourseNumber($discipline->semester) }} {{ $discipline->faculty->tag }} {{ $discipline->semester }} семестр)
                    </option>
                @endforeach
            </x-select>
            <x-input-error for="discipline_id" class="col-span-3 text-center" />

            <label class="font-bold">Факультет</label>
            <span class="col-span-2" x-text="getFaculty()"></span>

            <label class="font-bold">Группа</label>
            <x-select class="col-span-2 w-1/3" wire:model="group_number">
                <option value="">...</option>
                @for ($i = 1; $i <= 55; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="group_number" class="col-span-3 text-center" />

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

        <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
            Отмена
        </x-secondary-button>
    </x-slot>
</x-confirmation-modal>

<script>
    function getFaculty() {
        var sel = document.getElementById("discipline");
        var text= sel.options[sel.selectedIndex].text;

        if(sel.selectedIndex===0) {
            text="-";
        }

        return text.match(/\((.*?)\)/g);
    }
</script>
