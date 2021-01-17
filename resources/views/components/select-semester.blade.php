<x-app-spinner target="year" />
<x-app-spinner target="semester" />

<div {{ $attributes->merge(['class' => 'mb-2 sm:mb-0']) }} >
    <x-select class="sm:rounded-none sm:rounded-l-md py-2 px-4 pr-8 leading-tight" wire:model="year">
        @for($i=0; $i<=(now()->format('Y')-2020); $i++)
            <option value="{{ (now()->format('Y') - $i) }}">
                {{ (now()->format('Y') - $i) }}
            </option>
        @endfor
    </x-select>

    <x-select class="mr-1 rounded-r-lg sm:rounded-none py-2 px-4 pr-8 leading-tight" wire:model="semester">
        <option value="autumn">Осенний</option>
        <option value="spring">Весенний</option>
    </x-select>
</div>
