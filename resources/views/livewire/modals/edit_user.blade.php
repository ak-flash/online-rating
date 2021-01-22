<x-form-modal wire:model="openModal" :maxWidth="2">

    <x-slot name="title">
        <p class="pt-2 text-lg font-semibold">Управление пользователем</p>
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-3 gap-4 items-center">

            <label class="font-bold">Ф.И.О.</label>
            <x-input type="text" class="col-span-2" wire:model.lazy="name" />
            <x-input-error for="name" class="col-span-3 text-center" />

            <label class="font-bold">E-mail</label>
            <x-input type="text" class="col-span-2" wire:model.lazy="email" />
            <x-input-error for="email" class="col-span-3 text-center" />

            <label class="">Телефон</label>
            <x-input type="text" class="col-span-2" wire:model.lazy="phone" />
            <x-input-error for="phone" class="col-span-3 text-center" />

            <label class="font-bold">Роль</label>
            <x-select class="col-span-2" wire:model="role_id">
                <option value="0">Выберите...</option>
                @foreach(User::listRoles(auth()->user()->isAdmin()) as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-select>
            <x-input-error for="role" class="col-span-3 text-center" />

            <label class="">Должность</label>
            <x-select class="col-span-2" wire:model="position_id">
                <option value="">Выберите...</option>
                @foreach(User::POSITIONS as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-select>
            <x-input-error for="position" class="col-span-3 text-center" />
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
        Удалить аккаунт пользователя?
    </x-slot>

    <x-slot name="content">
       Вы уверены, что хотите удалить пользователя?
        <div class="m-2 text-bold text-lg">
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
