<x-form-modal wire:model="openModal" :maxWidth="4">

    <x-slot name="title">
        <p class="pt-2 text-lg font-bold">Редактировать тему занятия</p>
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center">

            <label class="">Номер</label>
            <x-select class="col-span-2 w-20 text-xl" wire:model.lazy="topicNumber">
                <option value="">...</option>
                @for ($i = 1; $i <= 30; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="topicNumber" class="col-span-3 text-center" />

            <label class="font-bold">Название</label>
            <textarea type="text" class="col-span-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.lazy="title" rows="5">

            </textarea>
            <x-input-error for="title" class="col-span-3 text-center" />

            <label class="">Ключевые слова</label>
            <textarea type="text" class="col-span-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.lazy="tags" rows="3">

            </textarea>
            <x-input-error for="tags" class="col-span-3 text-center" />

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
       Вы уверены, что хотите удалить тему?
        <div class="m-2 text-bold text-lg">
            {{ $title }}
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
