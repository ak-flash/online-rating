<x-app-spinner target="year" />
<x-app-spinner target="semester" />

<div {{ $attributes->merge(['class' => 'flex']) }} >
    <x-select class="rounded-l" wire:model="year">
        @for($i=0; $i<=(now()->format('Y')-2020); $i++)
            <option value="{{ (now()->format('Y') - $i) }}">
                {{ (now()->format('Y') - $i) }}
            </option>
        @endfor
    </x-select>

    <x-select class="mr-3 rounded-r" wire:model="semester">
        <option value="autumn">Осенний</option>
        <option value="spring">Весенний</option>
    </x-select>
</div>
