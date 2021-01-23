@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'hidden sm:block leading-tight border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm']) !!} wire:model="perPage">
    <option>5</option>
    <option>10</option>
    <option>20</option>
</select>
