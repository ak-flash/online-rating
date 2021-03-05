<x-form-modal wire:model="openModal" :maxWidth="3">

    <x-slot name="title">
        <p class="pt-2 text-lg font-bold">Управление кафедрой</p>
    </x-slot>

    <x-slot name="content">


            <div class="grid grid-cols-3 gap-4 items-center">
                <x-label class="font-bold">Кафедра</x-label>
                <textarea class="col-span-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.lazy="name">
                </textarea>
                <x-input-error for="name" class="col-span-3 block mt-2" />



                <x-label class="text-md">Ответственный</x-label>
                <x-select class="col-span-2 rounded-md" wire:model="userId">
                    <option value="">Выберите...</option>
                    @foreach($moderators as $moderator)
                        <option value="{{ $moderator->id }}">{{ $moderator->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="userId" class="col-span-3 text-center" />

                <x-label class="font-bold">ID volgmed</x-label>
                <x-input type="text" class="col-span-2 w-1/2" wire:model.lazy="volgmedId" />
                <x-input-error for="volgmedId" class="col-span-3 text-center" />

            </div>


    </x-slot>

    <x-slot name="footer">


        <x-button class="mr-2 bg-green-500 hover:bg-green-600 shadow-xl px-5 py-2 text-white rounded" wire:click.prevent="store()" wire:loading.attr="disabled">
            Сохранить
        </x-button>




    </x-slot>
</x-form-modal>
