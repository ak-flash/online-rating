<nav x-data="{ open: false }" class="bg-gray-300 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                       <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Кафедра') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:flex">
                    <x-nav-link href="{{ route('journals') }}" :active="request()->routeIs('journals')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Журналы') }}
                    </x-nav-link>
                </div>

                @if(auth()->user()->isModerator())
                <div class="hidden sm:flex">
                    <x-nav-link href="{{ route('disciplines') }}" :active="request()->routeIs('disciplines')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Дисциплины') }}
                    </x-nav-link>
                </div>
                @endif

                <div class="hidden sm:flex">
                    <x-nav-link href="{{ route('students') }}" :active="request()->routeIs('students')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Студенты') }}
                    </x-nav-link>
                </div>


                @if(auth()->user()->isAdmin())
                    <div class="hidden sm:flex">
                        <x-nav-link href="{{ route('departments') }}" :active="request()->routeIs('departments')" class="hover:bg-green-600 hover:text-white">
                            {{ __('Кафедры') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden sm:flex">
                        <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')" class="hover:bg-green-600 hover:text-white">
                            {{ __('Пользователи') }}
                        </x-nav-link>
                    </div>

                @endif


            </div>






            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex p-1 text-sm border-2 border-transparent rounded-md focus:outline-none focus:border-gray-300 hover:border-gray-300 hover:bg-gray-200 transition duration-150 ease-in-out">
                            <div class="hidden lg:block text-right mr-3 pl-2 text-black">
                                {{ auth()->user()->name }}
                                <div class="text-gray-500">
                                    {{ auth()->user()->getPosition() }}
                                </div>
                            </div>

                            <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ auth()->user()->profile_photo_url }}" />
                        </button>
                    </x-slot>

                    <!-- Account Management -->
                    <x-slot name="content">

                        @if(auth()->user()->isAdmin())
                            <div class="block px-4 py-1 text-xs text-gray-400">
                                {{ __('Администрирование') }}
                            </div>

                            <x-dropdown-link href="{{ route('logs') }}" class="pl-5">
                                <i class="fa fa-head-side-mask mr-1"></i>
                                {{ __('Управление') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100"></div>
                        @endif


                        <div class="block px-4 py-1 text-xs text-gray-400">
                            {{ __('Управление аккаунтом') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}" class="pl-5">
                            <i class="fa fa-head-side-mask mr-1"></i> {{ __('Профиль') }}
                        </x-dropdown-link>


                        <div class="border-t border-gray-100"></div>

                        <!-- Department Management -->

                        <div class="flex px-4 py-2 text-sm text-gray-400">
                            {{ __('Кафедра') }}

                        @if(auth()->user()->department_id)
                            <div class="pl-1 text-sm text-black">
                                {{ auth()->user()->department->name }}
                            </div>
                        @else
                            <div class="pl-1 text-sm text-red-500">
                                отсутствует
                            </div>
                        @endif
                        </div>
                        <div class="border-t border-gray-100"></div>

                        @if(auth()->user()->department_id)
                            <!-- Department Settings -->
                        <x-dropdown-link href="" class="pl-5">
                            <i class="fa fa-head-side-mask mr-1"></i>
                            {{ __('Настройки') }}
                        </x-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        @endif


                            <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fa fa-sign-in-alt mr-1"></i> {{ __('Выйти') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
