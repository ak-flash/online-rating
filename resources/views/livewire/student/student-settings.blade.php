<div>

    <div class="pb-2 items-center justify-between text-gray-600
				dark:text-gray-400 border-b dark:border-gray-600 mt-2">
        <!-- Header -->
        <h2 class=" ml-4 md:ml-0 text-3xl font-semibold dark:text-gray-400">
            Настройки
        </h2>



    </div>

    <div class="ml-4 md:ml-0 mt-2">

        <div class="flex w-auto">
            <div class="p-2">
                {{ __('Password') }}
            </div>
            <div class="p-2">
                <x-input class="h-8" disabled></x-input>
            </div>
        </div>


        <div class="flex w-full items-center justify-center bg-grey-500 mb-2" x-data>
            <label class="flex flex-col items-center px-4 py-6 bg-white text-blue-800 rounded-lg shadow-lg tracking-wide border border-blue-700 cursor-pointer hover:bg-blue-600 hover:text-white" x-on:click.prevent="$refs.avatar.click()">
                <i class="fa fa-cloud-upload-alt mr-1"></i>
                <span class="mt-2 text-base leading-normal">Загрузить аватар</span>

            </label>
            <input type='file' class="hidden" x-ref="avatar" wire:model="avatar" />
            <x-input-error for="avatar" class="text-center" />
        </div>


        <x-button class="mt-3">
            {{ __('Save') }}
        </x-button>

    </div>
</div>
