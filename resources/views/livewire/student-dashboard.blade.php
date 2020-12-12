<div>
    <div class="h-screen w-full flex overflow-hidden">
    <nav class="  w-64 px-12 flex flex-col bg-gray-200 dark:bg-gray-900  pt-4 pb-6">
        <!-- SideNavBar -->

        <div class="flex flex-row border-b items-center justify-between pb-2">
            <!-- Hearder -->
            <span class="text-lg font-semibold capitalize dark:text-gray-300">
                    <a href="{{ route('home') }}">ВолгГМУ</a>
			</span>

            <span class="relative ">
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

        <div class="mt-8">
            <!-- User info -->
            <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('img/avatar-placeholder.png') }}" alt="student_avatar" />

            <h2 class="mt-4 text-2xl dark:text-gray-300 font-bold capitalize">
                {{ $student->last_name }}
            </h2>

            <div class="mb-3">
                {{ $student->first_name }} {{ $student->middle_name }}
            </div>

            <span class="text-sm py-2 dark:text-gray-300 border-t border-b">
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

            <div class="text-sm pt-2 dark:text-gray-300">
                    <span class="font-semibold text-green-600 dark:text-green-300">
                        Курс
                    </span>
                {{ $student->course_number }}

                <span class="ml-2 font-semibold text-green-600 dark:text-green-300">
                        Группа
                    </span>
                {{ $student->group_number }}

            </div>
        </div>

    {{--  <x-jet-nav-link href="{{ route('student.dashboard') }}" :active="request()->routeIs('student.dashboard')" class="p-3 pl-5 text-black cursor-pointer mt-10">
        <i class="fas fa-school mr-3" style="font-size:25px;"></i>
        Журналы
    </x-jet-nav-link>

    <x-jet-nav-link href="{{ route('student.logout') }}" :active="request()->routeIs('student.logout')" class="p-3 pl-5 text-black cursor-pointer mt-4">
        <i class="fas fa-graduation-cap mr-3" style="font-size:25px;"></i>
        Настройки
    </x-jet-nav-link> --}}

    {{--<ul class="mt-4 text-gray-600">
            <!-- Links -->

            <li class="mt-4">
                <div class="flex bg-gray-300 shadow p-3 text-black rounded-lg cursor-pointer">
                    <i class="fas fa-school mr-3" style="font-size:25px;"></i>
                    Журналы
                </div>
            </li>

            <li class="mt-4">
                <a href="#home" class="flex bg-white hover:bg-gray-200 shadow p-3 text-black rounded-lg">
                    <i class="fas fa-graduation-cap mr-3" style="font-size:25px;"></i>
                        Настройки
                </a>
            </li>



        </ul>--}}


    <!-- important action -->
        <a href="{{ route('student.logout') }}" class="fixed bottom-5 bg-red-600 hover:bg-red-400 shadow p-2 rounded-lg text-white px-10">
            <i class="fa fa-sign-in-alt mr-2" style="font-size:20px;"></i>
            Выход
        </a>

    </nav>

    <main class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">

    <div class="mx-10 my-2">

        <nav class="flex flex-row justify-between border-b
				dark:border-gray-600 dark:text-gray-400 transition duration-500
				ease-in-out">
            <div class="flex">
                <!-- Top NavBar -->

                <button class="py-2 block border-b-2 focus:outline-none font-medium capitalize focus:text-green-500 focus:border-green-500 dark-focus:text-green-200 dark-focus:border-green-200  transition duration-100 ease-in-out
{{ $showSettings ? 'border-transparent' : 'border-green-500 text-green-500' }}
                " wire:click="nav('journal')">
                    Дисциплины
                </button>

                <button class="ml-6 py-2 block border-b-2 focus:outline-none font-medium capitalize focus:text-green-500 focus:border-green-500 dark-focus:text-green-200 dark-focus:border-green-200 border-transparent transition duration-100 ease-in-out
{{ $showJournal||$showMarks ? 'border-transparent' : 'border-green-500 text-green-500' }}
                    " wire:click="nav('settings')">
                    Настройки
                </button>

            </div>

        </nav>


        @if($showMarks)
            <livewire:student-marks :studyclass="$study_class"/>
        @endif

        @if($showJournal)
            <livewire:student-journal :student="$student"/>
        @endif

        @if($showSettings)
            <livewire:student-settings />
        @endif

    </div>
    </main>

    </div>
</div>
