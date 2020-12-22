<nav x-data="{ open: false }" class="bg-gray-200 shadow-2xl border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-jet-application-logo class="h-13 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:ml-15 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Личный кабинет') }}
                    </x-jet-nav-link>
                </div>



                <div class="hidden sm:flex">
                    <x-jet-nav-link href="{{ route('journals') }}" :active="request()->routeIs('journals')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Журналы') }}
                    </x-jet-nav-link>
                </div>

                @if(Auth::user()->isModerator())
                <div class="hidden sm:flex">
                    <x-jet-nav-link href="{{ route('disciplines') }}" :active="request()->routeIs('disciplines')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Дисциплины') }}
                    </x-jet-nav-link>
                </div>
                @endif

                <div class="hidden sm:flex">
                    <x-jet-nav-link href="{{ route('students') }}" :active="request()->routeIs('students')" class="hover:bg-green-600 hover:text-white">
                        {{ __('Студенты') }}
                    </x-jet-nav-link>
                </div>


                @if(Auth::user()->isAdmin())
                    <div class="hidden sm:flex">
                        <x-jet-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')" class="hover:bg-green-600 hover:text-white">
                            {{ __('Пользователи') }}
                        </x-jet-nav-link>
                    </div>

                    <div class="hidden sm:flex">
                        <x-jet-nav-link href="{{ route('logs') }}" :active="request()->routeIs('logs')" class="hover:bg-green-600 hover:text-white">
                            {{ __('Логи Laravel') }}
                        </x-jet-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-jet-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex p-1 text-sm border-2 border-transparent rounded-md focus:outline-none focus:border-gray-300 hover:border-gray-300 hover:bg-gray-200 transition duration-150 ease-in-out">
                                <div class="text-right mr-3 pl-2 text-black">
                                    {{ Auth::user()->name }}
                                    <div class="text-gray-500">
                                        {{ Auth::user()->email }} - {{ Auth::user()->getPosition() }}
                                    </div>
                                </div>

                                <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ Auth::user()->profile_photo_url }}" alt="user_avatar" />
                            </button>
                        @else
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-1 text-xs text-gray-400">
                            {{ __('Управление аккаунтом') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}" class="pl-5">
                            <i class="fa fa-head-side-mask mr-1"></i> {{ __('Профиль') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Токены') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="flex px-4 py-2 text-xs text-gray-400">
                                {{ __('Кафедра') }}

                            @if(!is_null(Auth::user()->current_team_id))
                                @foreach (Auth::user()->allTeams() as $team)
                                    <div class="pl-1 text-sm text-black">
                                        {{ $team->name }}
                                    </div>
                                @endforeach
                            </div>
                                    <div class="border-t border-gray-100"></div>
                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="pl-5">
                                        <i class="fa fa-head-side-mask mr-1"></i> {{ __('Настройки') }}
                                    </x-jet-dropdown-link>



                                    <div class="border-t border-gray-100"></div>

                            @else
                                <div class="p-2 text-center text-red-500">
                                    отсутствует
                                </div>
                            @endif


                        @endif

                        @can('create-kafedra', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-jet-dropdown-link href="{{ route('teams.create') }}" class="pl-5">
                                <i class="fa fa-head-side-mask mr-1"></i> {{ __('Создать кафедру') }}
                            </x-jet-dropdown-link>
                        @endcan

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="pl-5">
                                <i class="fa fa-sign-in-alt mr-1"></i> {{ __('Выйти') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
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
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Журналы') }}
            </x-jet-responsive-nav-link>

        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Занятия') }}
            </x-jet-responsive-nav-link>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Профиль') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Выйти') }}
                    </x-jet-responsive-nav-link>
                </form>

            @if(!is_null(Auth::user()->current_team_id))
                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>
                    @else
                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
