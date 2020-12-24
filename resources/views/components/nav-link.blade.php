@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-gray-200 inline-flex text-black items-center px-1 pt-1 border-b-2 border-green-600 text-sm font-medium leading-5 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out px-3'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 hover:border-gray-300 focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out px-3';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
