<x-form-modal wire:model="openModal" :maxWidth="4">

    <x-slot name="title">
        <p class="pt-2 text-lg font-bold">Управление дисциплиной</p>
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center">

            <x-label class="font-bold">Название</x-label>
            <x-input type="text" class="col-span-2" wire:model.lazy="name" />
            <x-input-error for="name" class="col-span-3 text-center" />

            <x-label class="">Короткое</x-label>
            <x-input type="text" class="col-span-2 w-1/2" wire:model.lazy="shortName" />
            <x-input-error for="shortName" class="col-span-3 text-center" />

            <x-label class="font-bold">Факультет</x-label>
            <x-select class="col-span-2 rounded-md" wire:model="facultyId">
                <option value="">Выберите...</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->speciality }}</option>
                @endforeach
            </x-select>
            <x-input-error for="facultyId" class="col-span-3 text-center" />


            <x-label class="font-bold">Семестр</x-label>
            <x-select class="col-span-2 rounded-md w-1/4" wire:model="semester">
                <option value="">...</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="semester" class="col-span-3 text-center" />

            <x-label class="">Помежуточная аттестация</x-label>
            <x-select class="col-span-2 rounded-md w-3/5" wire:model="lastClassId">
                <option value="">Выберите...</option>
                @foreach(\App\Models\Discipline::LAST_CLASS_TYPES as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-select>
            <x-input-error for="lastClassId" class="col-span-3 text-center" />

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
       Вы уверены, что хотите удалить дисциплину?
        <div class="m-2 text-bold text-lg">
            {{ $name }}
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
