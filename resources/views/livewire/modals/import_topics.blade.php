<x-form-modal wire:model="openImport" :maxWidth="4">

    <x-slot name="title">
        <div class="text-sm text-justify">
            Скопируйте столбец таблицы с темами (можно прямо с цифрами) из файла с тематическим планом и вставьте названия тем.
        </div>
    </x-slot>

    <x-slot name="content">

        <div class="flex text-base justify-end items-center mb-2">
            {{ $discipline->volgmed_id ? 'Дисциплина '.$discipline->name : 'Синхронизируйте дисциплины'}}

            <x-main-button class="ml-3 w-full" wire:click.prevent="receiveFromVolgmed()">
                Получить файл с <b>volgmed.ru</b>
            </x-main-button>
        </div>
        <textarea class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" cols="40" rows="10" wire:model.debounce1s="topicsTitles">



        </textarea>

    </x-slot>

    <x-slot name="footer">


        <x-button class="mr-2 bg-green-500 hover:bg-green-600 shadow-xl px-5 py-2 text-white rounded" wire:click.prevent="import()" wire:loading.attr="disabled">
            Импорт
        </x-button>




    </x-slot>
</x-form-modal>
