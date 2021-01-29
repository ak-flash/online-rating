<x-form-modal wire:model="openImport" :maxWidth="4">

    <x-slot name="title">
        <div class="text-xs text-justify">
            Скопируйте столбец из таблицы из файла с тематическим планом и вставьте названия тем или попробуйте нажмите кнопку "Получить темы" и далее отформатируйте текст: удалите лишнее. Каждая тема должна начинаться с новой строки, остальные переносы (если есть) необходимо убрать!
        </div>
    </x-slot>

    <x-slot name="content">

        <div class="flex text-base justify-end items-center mb-2">
            {{ $discipline->volgmed_id ? 'Дисциплина '.$discipline->name : 'Синхронизируйте дисциплины'}}

            <x-main-button class="ml-3 w-full" wire:click.prevent="receiveFromVolgmed()">
                Получить темы
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
