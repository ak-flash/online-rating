<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-5 py-2 bg-green-700 text-white hover:bg-green-800 active:bg-gray-900 transition ease-in duration-200 text-center text-base shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 rounded-md']) }}>
    {{ $slot }}
</button>
