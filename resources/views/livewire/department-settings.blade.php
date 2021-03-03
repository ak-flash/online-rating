<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 h-auto">
        <x-form-section submit="store">
            <x-slot name="title">
                Редактировать информацию о кафедре
            </x-slot>

            <x-slot name="description">
                Название кафедры
            </x-slot>

            <x-slot name="form">

            <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="Название" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="email" value="Ответственный" />
                    <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                    <x-input-error for="email" class="mt-2" />
                </div>


            </x-slot>

            <x-slot name="actions">
                <x-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>

                <x-button wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>

        <x-form-section submit="inviteUser" class="pt-5">
            <x-slot name="title">
                Добавить сотрудника
            </x-slot>

            <x-slot name="description">
                Вы можете пригласить нового сотрудника вашей кафедры
            </x-slot>

            <x-slot name="form">

                <!-- Email -->
                <div class="flex">
                    <x-label for="email" value="Email сотрудника" class="mr-5" />
                    <x-input id="email" type="email" class="mx-5" wire:model.defer="state.email" />
                    <x-input-error for="email" class="mt-2" />


                    <x-button wire:loading.attr="disabled" wire:target="photo">
                        Пригласить
                    </x-button>

                </div>
            </x-slot>


        </x-form-section>

    </div>
</div>
