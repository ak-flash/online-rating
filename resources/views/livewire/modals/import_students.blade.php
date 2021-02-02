<x-form-modal wire:model="openImport" :maxWidth="3">

    <x-slot name="title">
        Импорт студентов
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center">
            <label class="font-bold">Специальность</label>
            <x-select class="rounded col-span-2" wire:model="facultyId">
                <option value="">...</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->speciality }}</option>
                @endforeach
            </x-select>
            <x-input-error for="facultyId" class="col-span-3 text-center" />

            <label class="">Курс</label>
            <x-select class="col-span-2 w-1/3 rounded" wire:model="courseNumber">
                <option value="">...</option>
                @for ($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-select>
            <x-input-error for="courseNumber" class="col-span-3 text-center" />
        </div>

        <div class="my-5 text-justify">
            Загрузите файл из Искры со списком студентов по факультету и курсу
        </div>

        <div class="flex w-full items-center justify-center bg-grey-500 mb-2" x-data="{ fileName: '' }">
            <label class="flex items-center p-4 bg-white text-blue-800 rounded-lg shadow-lg tracking-wide border border-blue-700 cursor-pointer hover:bg-blue-600 hover:text-white" x-on:click.prevent="$refs.fileImport.click()">
                <i class="fa fa-cloud-upload-alt mr-2"></i>
                <span class="text-base leading-normal">Загрузить файл</span>

            </label>
            <input type='file' class="hidden" x-ref="fileImport" x-on:change="fileName = $refs.fileImport.files[0].name" wire:model="fileImport" />
            <x-input-error for="fileImport" class="text-center" />

            <span class="ml-5 text-sm text-gray-600" x-text="fileName"></span>
        </div>

    </x-slot>

    <x-slot name="footer">


        <x-button class="mr-2 bg-green-500 hover:bg-green-600 shadow-xl px-5 py-2 text-white rounded" wire:click.prevent="import()" wire:loading.attr="disabled">
            Импорт
        </x-button>




    </x-slot>
</x-form-modal>
