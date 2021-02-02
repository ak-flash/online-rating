<div>
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
                <div class="flex flex-col justify-center items-center w-full mt-3 border-t border-gray-700">
                    <!-- User info -->
                    <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ $student->profile_photo_url }}', imgModalDesc: '' })" class="cursor-pointer">
                        <img class="mt-3 rounded-lg object-cover mx-auto" src="{{ $student->profile_photo_url }}" alt="student_avatar" style="width: 130px;height: 130px;" />
                    </a>

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
                    <a class="flex items-center w-full h-10 px-3 my-3 rounded hover:bg-green-800 hover:text-gray-300 {{ $showSettings ?: 'text-white bg-green-600' }}" href="#" wire:click.prevent="nav('journals')">
                        <i class="fa fa-book-open text-xl"></i>
                        <span class="ml-3 text-base">
                            {{ __('Journals') }}
                        </span>
                    </a>

                </div>

                <div class="flex flex-col items-center w-full border-t border-gray-700">

                    <a class="flex items-center w-full h-10 px-3 mt-2 rounded hover:bg-green-800 hover:text-gray-300 {{ $showJournal||$showLessons ?: 'text-white bg-green-600' }}" href="#" wire:click.prevent="nav('settings')">
                        <i class="fa fa-sliders-h text-xl"></i>
                        <span class="ml-3 text-sm">
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
            </div>

            <a href="{{ route('student.logout') }}" class="fixed bottom-5 bg-red-500 hover:bg-red-600 shadow p-2 rounded-lg text-white px-10 mx-4">
                <i class="fa fa-sign-in-alt mr-2"></i>
                Выход
            </a>

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
                        Выйти
                    </a>
                </div>
            </div>

            <div class="sm:mx-0 md:mx-10 my-2">

                <nav class="flex flex-row sm:hidden justify-between border-b transition duration-500
				ease-in-out ml-4 md:ml-0">
                    <div class="flex">
                        <!-- Top NavBar -->

                        <button class="py-1 px-4 block border-b-2 focus:outline-none font-medium capitalize focus:text-green-600 focus:border-green-600 transition duration-100 ease-in-out {{ $showSettings ? 'border-transparent' : 'border-green-600 text-green-600' }} " wire:click="nav('journals')">
                            {{ __('Journals') }}
                        </button>

                        <button class="py-1 px-4 block border-b-2 focus:outline-none font-medium capitalize focus:text-green-600 focus:border-green-600 border-transparent transition duration-100 ease-in-out
{{ $showJournal||$showLessons ? 'border-transparent' : 'border-green-600 text-green-600' }} " wire:click="nav('settings')">
                            {{ __('Settings') }}
                        </button>

                    </div>

                </nav>

                <x-app-spinner target="" />



                @if($showLessons)
                    <livewire:student-lessons :lesson="$lesson" />
                @endif

                @if($showJournal)
                    <livewire:student-journals />
                @endif

                @if($showSettings)
                    <livewire:student-settings />
                @endif


            </div>
        </main>

    </div>
</div>
