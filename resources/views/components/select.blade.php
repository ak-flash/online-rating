@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white text-gray-700 py-2 px-4 pr-8 leading-tight border-gray-300 shadow-sm']) !!}>
    {{ $slot }}
</select>
