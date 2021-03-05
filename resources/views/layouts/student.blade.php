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

{{--        <script src="https://kit.fontawesome.com/661974c3ba.js" crossorigin="anonymous"></script>--}}

    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="h-screen w-full flex overflow-hidden">
                <nav class="hidden md:flex w-56 px-4 flex-col bg-gray-200 dark:bg-gray-900 pt-4 pb-6">
                    <!-- SideNavBar -->

                    <a class="flex items-center text-xl w-full px-3" href="{{ route('home') }}">
                        <i class="fa fa-graduation-cap text-2xl"></i>
                        <span class="ml-2 font-bold">
                    ВолгГМУ
                </span>
                    </a>
                    <div class="w-full px-2">
                        <div class="flex flex-col justify-center items-center w-full mt-3 border-t border-gray-700" x-data>
                            <!-- User info -->

                            @if($student->profile_photo_path)
                                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ $student->profile_photo_url }}', imgModalDesc: '' })" class="cursor-pointer">
                                    <img class="mt-3 rounded-full object-cover mx-auto" src="{{ $student->getThumbnail() }}" alt="student_avatar" style="width: 100px;height: 100px;" />
                                </a>
                            @else
                                <img class="mt-3 rounded-full object-cover mx-auto" src="{{ $student->profile_photo_url }}" alt="student_avatar" style="width: 100px;height: 100px;" />
                            @endif
                            <x-image-popup />

                            <div class="mt-2 text-2xl dark:text-gray-300 capitalize">
                                {{ $student->last_name }}
                            </div>

                            {{ $student->name }}
                        </div>

                        <div class="flex text-sm justify-center items-center w-full mt-2 pt-2 border-t border-gray-700">
                    <span class="font-bold text-green-800">
                        Курс
                    </span>
                            <span class="ml-1 text-lg">
                        {{ $student->course_number }}
                    </span>

                            <span class="ml-2 font-bold text-green-800">
                        Группа
                    </span>
                            <span class="ml-1 text-lg">
                        {{ $student->group_number }}
                    </span>
                        </div>

                        <div class="text-xs text-center">
                            {{ $student->faculty->name }}
                        </div>

                        <div class="flex flex-col items-center w-full mt-2 border-t border-gray-700">
                            <a class="flex items-center w-full h-10 px-3 my-3 rounded hover:bg-green-800 hover:text-white {{ request()->routeIs('student.dashboard') ? 'text-white bg-green-600 shadow-lg' : '' }}" href="{{ route('student.dashboard') }}">
                                <i class="fa fa-book-open text-xl"></i>
                                <span class="ml-3 text-base">
                            {{ __('Journals') }}
                        </span>
                            </a>

                        </div>

                        <div class="flex flex-col items-center w-full border-t border-gray-700">

                            <a class="flex items-center w-full h-10 px-3 mt-2 rounded hover:bg-green-800 hover:text-white {{ request()->routeIs('student.settings') ? 'text-white bg-green-600 shadow-lg' : '' }}" href="{{ route('student.settings') }}">
                                <i class="fa fa-sliders-h text-xl"></i>
                                <span class="ml-3 text-base">
                            {{ __('Settings') }}
                        </span>
                            </a>
                            <a class="relative flex items-center w-full h-10 px-3 mt-1 rounded hover:bg-green-800 hover:text-gray-300" href="#">
                                <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <span class="ml-2 text-sm">
                            {{ __('Notifications') }}
                        </span>
                                <span class="absolute top-0 left-0 w-2 h-2 mt-2 ml-2 bg-green-500 rounded-full"></span>
                            </a>
                        </div>

                        <div class="my-10 flex items-center w-full">
                            <a href="{{ route('student.logout') }}" class="border border-red-500 hover:bg-red-600 hover:text-white text-sm flex items-center justify-center w-full h-10 px-3 my-3 rounded shadow-lg">
                                <i class="fa fa-sign-in-alt text-lg mr-2"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>


                    </div>

                </nav>


                <main class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">

                    <div id="mobile_menu" class="md:hidden bg-green-800 h-auto">

                        <div class="flex">
                            <div class="flex ml-5 p-3 text-base text-white w-full ">
                                {{ $student->last_name }}
                                <div class="flex ml-2 text-sm text-gray-300">
                                    {{ $student->name }}
                                </div>
                            </div>

                            <a href="{{ route('student.logout') }}" class="px-3 bg-red-700 hover:bg-red-500 shadow m-2 float-right rounded-sm text-white pt-1 mr-3">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </div>

                    <div class="sm:mx-0 md:mx-10 my-2">

                        <nav class="flex flex-row sm:hidden justify-between border-b transition duration-500
				ease-in-out ml-4 md:ml-0">
                            <div class="flex">
                                <!-- Top NavBar -->

                                <a href="{{ route('student.dashboard') }}" class="py-1 px-4 block border-b-2 focus:outline-none font-medium capitalize focus:text-green-600 focus:border-green-600 transition duration-100 ease-in-out {{ request()->routeIs('student.dashboard') ? 'border-green-600 text-green-600' : 'border-transparent' }}">
                                    {{ __('Journals') }}
                                </a>

                                <a href="{{ route('student.settings') }}" class="py-1 px-4 block border-b-2 focus:outline-none font-medium capitalize focus:text-green-600 focus:border-green-600 border-transparent transition duration-100 ease-in-out
{{ request()->routeIs('student.settings') ? 'border-green-600 text-green-600' : 'border-transparent' }}">
                                    {{ __('Settings') }}
                                </a>

                            </div>

                        </nav>


                            {{ $slot }}

                    </div>
                </main>

            </div>


        </div>

        @livewireScripts

    </body>
</html>
