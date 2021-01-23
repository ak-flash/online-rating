<x-guest-layout>

    <div class="flex flex-col bg-gray-100 h-screen" style="background-image: url({{ asset('img/home-background.jpg') }}); background-repeat: no-repeat;background-size: 100% 100%;">

        @if (Route::has('login'))
            <header class="w-full flex justify-between p-2 bg-green-600">



                    <h1 class="flex font-bold text-3xl text-green-900 hover:bg-green-500 ml-3 p-2 rounded-lg">
                        <x-application-logo class="h-11 w-auto mr-3" />
                        <a href="https://volgmed.ru" class="hidden md:flex pr-2">ВолгГМУ</a>
                    </h1>

                <div class="flex float-right">
                @auth

                        <a href="{{ route('profile.show') }}" class="flex hover:bg-green-600 rounded-lg px-3 p-1" title="Профиль">
                            <div class="text-right mr-3 text-white">
                                {{ auth()->user()->name }}
                                <div class="text-gray-400">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                            <img class="mr-3 h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="user_avatar" />
                        </a>
                       <a href="{{ url('/dashboard') }}" class="m-2 py-2 bg-red-700 hover:bg-red-800 shadow-xl px-5 text-white rounded">ЖУРНАЛ<i class="fa fa-sign-in-alt ml-2"></i></a>

                @else

                    @isset($student->id)

                        <a href="{{ route('student.dashboard') }}" class="mr-2 bg-red-700 hover:bg-red-800 shadow-xl px-5 my-2 py-2 text-white rounded float-right">
                            <i class="fa fa-sign-in-alt mr-1"></i>
                            {{ $student->last_name }} {{ $student->first_name }}
                        </a>
                    @else

                        <a href="{{ route('student.login') }}" class="m-2 bg-blue-600 hover:bg-blue-800 shadow-xl sm:px-5 p-2  text-white rounded float-right w-30">
                            <i class="fa fa-graduation-cap mr-1"></i>
                            Студент
                        </a>

                        <a href="{{ route('login') }}" class="m-2 bg-indigo-600 hover:bg-indigo-800 shadow-xl sm:px-5 p-2 text-white rounded float-right">
                            <i class="fa fa-head-side-mask mr-1"></i>
                            Сотрудник
                        </a>
                    @endisset



                @endauth
                </div>
            </header>
        @endif


        <div class="text-2xl md:text-5xl py-4 pb-6 mt-6 text-center text-black bg-green-800 w-full bg-opacity-25">
            Онлайн журнал оценок
        </div>


        <div class="w-full flex flex-col items-center">
                <div class="grid gap-1 md:grid-cols-3 sm:grid-cols-1">


                    <div class="p-2 sm:p-10 text-center">
                        <div class="py-8 max-w-sm rounded overflow-hidden shadow-lg bg-gray-100 hover:bg-gray-300 transition duration-500">
                            <div class="space-y-5">
                                <i class="fa fa-head-side-mask" style="font-size:48px;"></i>
                                <div class="px-6 py-3 pb-9">
                                    <div class="space-y-2">
                                        <div class="font-bold text-xl mb-2">Без регистрации</div>
                                        <p class="text-base">
                                            Вход по номеру личного дела <br> (зачётной книжки)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 sm:p-10 text-center translate-x-2 mb-5">
                        <div class="py-8 max-w-sm rounded overflow-hidden shadow-lg transition duration-500 bg-gray-100 hover:bg-gray-300">
                            <div class="space-y-5">
                                <i class="fas fa-graduation-cap" style="font-size:48px;"></i>

                                <div class="px-6 py-3">
                                    <div class="space-y-2">
                                        <div class="font-bold text-xl mb-2">Информация</div>
                                        <p class="text-gray-700 text-base">
                                            Для студентов и сотрудников <b>Волгоградского государственного медицинского университета</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 sm:p-10 text-center">
                        <div class="py-8 max-w-sm rounded overflow-hidden shadow-lg bg-gray-100 hover:bg-gray-300 transition duration-500">
                            <div class="space-y-5">
                                <i class="fa fa-head-side-mask" style="font-size:48px;"></i>
                                <div class="px-6 py-3 pb-7">
                                    <div class="space-y-2">
                                        <div class="font-bold text-xl mb-2">Юридические ограничения</div>
                                        <p class="text-base">
                                            Не является заменой бумажного журнала!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>



    </div>




{{--    <footer class="relative h-full bottom-0 w-full text-center p-2 text-gray-200 bg-green-500">
        Klyausov A.S. @ {{ date('Y') }} v.0.5
    </footer>--}}
</x-guest-layout>
