<div>
    <div class="h-screen w-full flex overflow-hidden">
        <nav class="hidden md:flex w-56 px-4 flex-col bg-gray-200 dark:bg-gray-900 pt-4 pb-6">
            {{--<!-- SideNavBar -->

            <div class="flex flex-row border-b pb-2 justify-between">
                <!-- Hearder -->
                <span class="pl-4 text-2xl font-bold capitalize dark:text-gray-300">
                    <a href="{{ route('home') }}">ВолгГМУ</a>
			    </span>

                <span class="relative">
                    <a class="hover:text-green-500 dark-hover:text-green-300 text-gray-600 dark:text-gray-300" href="#">
                        <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </a>
                    <div class="absolute w-2 h-2 rounded-full bg-green-500
                        dark-hover:bg-green-300 right-0 mb-5 bottom-0"></div>
			    </span>

            </div>

            <span class="mt-8 text-center">
                <!-- User info -->
                <img class="h-15 w-15 rounded-lg object-cover mx-auto" src="{{ $student->profile_photo_url }}" alt="student_avatar" />

                <div class="mt-4 text-2xl dark:text-gray-300 capitalize">
                    {{ $student->last_name }}
                </div>

                {{ $student->name }}

                <div class="my-5 border-t border-gray-400"></div>

                <span class="text-sm py-2  dark:text-gray-300 border-t border-b">
                     №
                    <span class="font-semibold text-green-600 dark:text-green-300">
                       {{ $student->document_id }}
                    </span>
			    </span>

                <div class="text-sm pt-2 dark:text-gray-300 mt-2">
                    <span class="font-semibold text-green-600 dark:text-green-300">
                        Факультет
                    </span>
                    {{ $student->faculty->name }}
                </div>

                <span class="text-sm pt-2 dark:text-gray-300">
                    <span class="font-bold text-green-600 dark:text-green-300">
                        Курс
                    </span>
                    <span class="text-lg font-bold">
                        {{ $student->course_number }}
                    </span>

                    <span class="ml-2 font-bold text-green-600 dark:text-green-300">
                        Группа
                    </span>
                    <span class="text-lg font-bold">
                        {{ $student->group_number }}
                    </span>
                </span>
            </span>


            <a href="{{ route('student.logout') }}" class="fixed bottom-5 bg-red-500 hover:bg-red-600 shadow p-2 rounded-lg text-white px-10 mx-4">
                <i class="fa fa-sign-in-alt mr-2" style="font-size:20px;"></i>
                Выход
            </a>--}}


            <!-- Component Start -->

                    <a class="flex items-center text-xl w-full px-3 mt-3" href="{{ route('home') }}">
                        <i class="fa fa-graduation-cap text-2xl"></i>
                        <span class="ml-2 font-bold">
                            ВолгГМУ
                        </span>
                    </a>
                    <div class="w-full px-2">
                        <div class="flex flex-col items-center w-full mt-3 border-t border-gray-700">
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
                            <a class="relative flex items-center w-full h-10 px-3 rounded hover:bg-green-800 hover:text-gray-300" href="#">
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


                <!-- Component End  -->

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

                <x-app-spinner target="" />

                @if($showLessons)
                    <livewire:student-lessons :lesson="$lesson"/>
                @endif

                @if($showJournal)
                    <livewire:student-journals :student="$student"/>
                @endif

                @if($showSettings)
                    <livewire:student-settings />
                @endif


            </div>
        </main>

    </div>
</div>
