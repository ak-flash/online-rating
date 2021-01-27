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

        <x-button class="mt-3">
            {{ __('Save') }}
        </x-button>

    </div>
</div>
