<x-form-modal wire:model="openModal" :maxWidth="3">

    <x-slot name="title">
        <p class="pt-2 text-lg font-semibold">Управление кафедрой</p>
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-col items-center m-4">

            <div class="flex items-center">
                <x-label class="mr-3 text-lg w-1/2">Кафедра</x-label>
                <textarea class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.lazy="name">
                </textarea>
                <x-input-error for="name" class="block mt-2" />
            </div>

            <div class="flex items-center m-4">
                <x-label class="mr-3 text-md w-1/2">Ответственный</x-label>
                <x-select class="" wire:model="user_id">
                    <option value="">Выберите...</option>
                    @foreach($moderators as $moderator)
                        <option value="{{ $moderator->id }}">{{ $moderator->name }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>

    </x-slot>

    <x-slot name="footer">


        <x-button class="mr-2 bg-green-500 hover:bg-green-600 shadow-xl px-5 py-2 text-white rounded" wire:click.prevent="store()" wire:loading.attr="disabled">
            Сохранить
        </x-button>




    </x-slot>
</x-form-modal>
