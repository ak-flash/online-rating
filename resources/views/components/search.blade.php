<div {{ $attributes->merge(['class' => 'block relative']) }} x-data="{search: null}">
    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2 ml-2 sm:ml-0">
        <span class="fa fa-search opacity-50"></span>
    </span>
    <x-input type="text" placeholder="Поиск" class="pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 border-gray-300 rounded-lg ml-2 sm:ml-0 sm:rounded-none" wire:model.debounce.600ms="search" x-ref="search" />

    <span class="h-full absolute inset-y-0 right-0 flex items-center pr-2">
        <span class="fa fa-times-circle opacity-10 hover:opacity-75 cursor-pointer" x-on:click="$refs.search.value = '';$wire.search = '';"></span>
    </span>
</div>
