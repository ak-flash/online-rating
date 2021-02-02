<x-form-modal wire:model="openModal" :maxWidth="3">

    <x-slot name="title">
        <p class="pt-2 text-lg font-bold">{{ $studentId ? 'Редактировать' : 'Добавить' }} студента</p>
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center">

            <label class="font-bold">Фамилия</label>
            <x-input type="text" class="col-span-2" wire:model.lazy="lastName" />
            <x-input-error for="lastName" class="col-span-3 text-center" />

            <label class="font-bold">Имя Отчество</label>
            <x-input type="text" class="col-span-2" wire:model.lazy="name" />
            <x-input-error for="name" class="col-span-3 text-center" />

            @if(auth()->user()->isModerator())
                <label class="font-bold">Специальность</label>
                <x-select class="rounded col-span-2" wire:model="facultyId">
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}">{{ $faculty->speciality }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="facultyId" class="col-span-3 text-center" />
            @endif

            <label class="">Курс</label>
            <x-select class="col-span-2 w-1/3 rounded" wire:model="courseNumber">
                <option value="">...</option>
                @for ($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="courseNumber" class="col-span-3 text-center" />

            <label class="">Группа</label>
            <x-select class="col-span-2 w-1/3 rounded" wire:model="groupNumber">
                <option value="">...</option>
                @for ($i = 1; $i <= 55; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="groupNumber" class="col-span-3 text-center" />


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
        Вы уверены, что хотите удалить студента?
    </x-slot>

    <x-slot name="content">
        <div class="flex items-center">
            <div class="mr-2 text-bold text-lg">
                {{ $lastName }}
            </div>
            {{ $name }}
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
