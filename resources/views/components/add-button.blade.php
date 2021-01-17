<button {{ $attributes->merge(['class' => 'flex items-center bg-green-700 hover:bg-green-900 ml-5 m-2 p-2 px-4 text-white text-sm font-semibold rounded-md transition ease-in-out duration-150']) }}>
    <i class="fas fa-plus text-xl sm:text-md sm:mr-2"></i>
    <div class="hidden sm:flex">
        {{ $slot }}
    </div>
</button>
