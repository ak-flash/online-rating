<x-app-spinner target="year" />
<x-app-spinner target="semester" />

<select class="rounded-l w-auto text-gray-500 py-2 px-4 md:pr-8 leading-tight border-gray-300" wire:model="year">
    @for($i=0; $i<=(now()->format('Y')-2020); $i++)
        <option value="{{ (now()->format('Y') - $i) }}">
            {{ (now()->format('Y') - $i) }}
        </option>
    @endfor
</select>

<select class="text-gray-500 w-auto py-2 px-4 md:pr-8 leading-tight border-gray-300" wire:model="semester">
    <option value="autumn">Осенний</option>
    <option value="spring">Весенний</option>
</select>
