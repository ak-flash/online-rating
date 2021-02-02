<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>

                    <div class="md:hidden text-green-900 text-2xl ml-5">
                        {{ App\Helper\Helper::getRouteName() }}
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Главная') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:flex">
                    <x-nav-link href="{{ route('journals') }}" :active="request()->routeIs('journals')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Journals') }}
                    </x-nav-link>
                </div>


                    <div class="hidden sm:flex">
                        <x-nav-link href="{{ route('disciplines') }}" :active="request()->routeIs('disciplines')" class="hover:bg-green-600 hover:text-white">
                            {{ __('Disciplines') }}
                        </x-nav-link>
                    </div>


                <div class="hidden sm:flex">
                    <x-nav-link href="{{ route('students') }}" :active="request()->routeIs('students')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Students') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:flex">
                    <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Workers') }}
                    </x-nav-link>
                </div>

                @if(auth()->user()->isAdmin())
                    <div class="hidden sm:flex">
                        <x-nav-link href="{{ route('departments') }}" :active="request()->routeIs('departments')" class="hover:bg-red-500 bg-red-50 hover:text-white">
                            {{ __('Departments') }}
                        </x-nav-link>
                    </div>
                @endif


            </div>




            <div class="hidden sm:flex sm:items-center sm:ml-6">

                    <div x-data="{ dropdownOpen: false }" class="relative my-32">
                        <button @click="dropdownOpen = !dropdownOpen" class="relative block rounded-md bg-white mr-6 focus:outline-none">
                            <i class="far fa-bell text-2xl text-gray-600 hover:text-gray-900"></i>

                            <span class="absolute -top-3 left-2 w-2 h-2 mt-2 ml-2 bg-green-500 rounded-full"></span>
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:20rem;display: none;">
                            <div class="py-2">

                                <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
                                    <p class="text-gray-600 text-sm mx-2">
                                        <span class="font-bold" href="#">Sara Salah</span> replied on the <span class="font-bold text-blue-500" href="#">Upload Image</span> artical . 2m
                                    </p>
                                </a>

                                <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-100 -mx-2">
                                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80" alt="avatar">
                                    <p class="text-gray-600 text-sm mx-2">
                                        <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
                                    </p>
                                </a>

                            </div>
                            <a href="#" class="block bg-gray-800 text-white text-center py-2">Показать все</a>
                        </div>
                    </div>




                <a href="{{ route('profile.show') }}" class="mr-5">
                    <i class="fa fa-user-cog text-xl text-gray-600 hover:text-gray-900"></i>

                </a>
                <!-- Settings Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex p-1 pr-3 text-sm hover:bg-gray-300 transition duration-150 ease-in rounded-xl bg-gray-100 ">
                                <img class="h-10 w-10 object-cover rounded-lg" src="{{ auth()->user()->profile_photo_url }}" />

                                <div class="hidden lg:block text-left pl-2 text-black">
                                    {{ auth()->user()->name }}

                                    <div class="text-gray-500">
                                        @if(auth()->user()->isModerator())
                                            <i class="fas fa-check-square text-{{ auth()->user()->isAdmin() ? 'red' : 'green' }}-700 text-xs"></i>
                                        @endif
                                            {{ auth()->user()->position }}
                                    </div>
                                </div>


                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
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

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Department Management -->

                            <div class="px-4 py-2 text-sm text-gray-400 hover:bg-gray-200">
                                {{ __('Кафедра') }}

                                @if(auth()->user()->department_id)
                                    <div class="pl-1 text-sm text-black cursor-pointer">
                                        <a href="{{ route('department.settings', auth()->user()->department_id) }}">
                                            {{ auth()->user()->department->name }}
                                        </a>
                                    </div>
                                @else
                                    <div class="pl-1 text-sm text-red-500">
                                        отсутствует
                                    </div>
                                @endif
                            </div>
                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link class="hover:bg-red-200" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fa fa-sign-in-alt mr-1"></i>
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
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

            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('journals') }}" :active="request()->routeIs('journals')">
                {{ __('Journals') }}
            </x-responsive-nav-link>

            @if(auth()->user()->isModerator())
                <x-responsive-nav-link href="{{ route('disciplines') }}" :active="request()->routeIs('disciplines')">
                    {{ __('Disciplines') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('students') }}" :active="request()->routeIs('students')">
                    {{ __('Students') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                    {{ __('Workers') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link href="{{ route('departments') }}" :active="request()->routeIs('departments')">
                    {{ __('Departments') }}
                </x-responsive-nav-link>
            @endif

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->role }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
</nav>
