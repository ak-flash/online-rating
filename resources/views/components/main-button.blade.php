<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-indigo-600 text-white py-2 px-4 border-b-4 hover:border-b-2 hover:border-t-2 border-blue-300 hover:border-blue-900 hover:bg-indigo-500 rounded text-sm']) }}>
    {{ $slot }}
</button>
