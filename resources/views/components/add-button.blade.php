<button {{ $attributes->merge(['class' => 'bg-green-700 hover:bg-green-900 ml-5 m-2 p-2 px-4 text-white text-sm font-semibold rounded-md transition ease-in-out duration-150']) }}>
    <i class="fas fa-plus" style="font-size:12px;"></i> {{ $slot }}
</button>
