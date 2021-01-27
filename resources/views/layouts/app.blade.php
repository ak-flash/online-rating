<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title : config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <script src="{{ asset('js/functions.js') }}"></script>



{{--        <script src="https://kit.fontawesome.com/661974c3ba.js" crossorigin="anonymous"></script>--}}

    </head>
    <body>

        <div class="bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <livewire:toastr/>

        @stack('modals')

        @livewireScripts

        <script>
            window.onload = function(e){
                // Make input mask
                let inputs = document.getElementsByTagName('input');
                Maska.create(inputs);

            }
        </script>
    </body>
</html>
