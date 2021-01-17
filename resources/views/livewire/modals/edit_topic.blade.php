<x-form-modal wire:model="openModal" :maxWidth="4">

    <x-slot name="title">
        <p class="pt-2 text-lg font-bold">Редактировать тему занятия</p>
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center">

            <label class="">Номер</label>
            <x-input type="text" class="col-span-2 w-1/2" wire:model.lazy="topicNumber" />
            <x-input-error for="topicNumber" class="col-span-3 text-center" />

            <label class="font-bold">Название</label>
            <textarea type="text" class="col-span-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.lazy="title" >
            </textarea>
            <x-input-error for="title" class="col-span-3 text-center" />

            <label class="">Ключевые слова</label>
            <x-input type="text" class="col-span-2" wire:model.lazy="tags" />
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
