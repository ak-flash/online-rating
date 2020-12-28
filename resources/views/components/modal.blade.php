@props(['id', 'maxWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));

switch ($maxWidth ?? 2) {
    case 1:
        $maxWidth = 'max-w-xs';
        break;
    case 2:
        $maxWidth = 'sm:max-w-sm';
        break;
    case 3:
        $maxWidth = 'sm:max-w-md';
        break;
    case 4:
        $maxWidth = 'sm:max-w-lg';
        break;
    case 5:
        $maxWidth = 'sm:max-w-xl';
        break;
    case 6:
    default:
        $maxWidth = 'sm:max-w-2xl';
        break;
}
@endphp

<div x-data="{
        show: @entangle($attributes->wire('model')),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    id="{{ $id }}"
    class="fixed top-0 inset-x-0 px-4 pt-6 z-50 sm:px-0 flex h-screen justify-center items-center"
    style="display: none;"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div x-show="show" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} ">
        {{ $slot }}
    </div>
</div>
