<x-guest-layout>

    <div class="flex flex-col h-screen bg-green-500" style="background-image: url({{ asset('img/home-background.jpg') }}); background-repeat: no-repeat;background-size: 100% 100%;">

        @if (Route::has('login'))
            <header class="w-full flex justify-between p-2 bg-green-600">

                    <h1 class="flex text-xl md:text-3xl text-white hover:text-gray-200 hover:bg-green-500 ml-3 p-1 rounded-lg">
                        <x-application-logo class="h-12 w-auto mr-3 bg-white rounded-lg p-1 " />
                        <a href="https://volgmed.ru" class="pt-2 md:pt-1 pr-2">ВолгГМУ</a>
                    </h1>

                <div class="flex float-right">
                @auth

                        <a href="{{ route('profile.show') }}" class="flex hover:bg-green-600 rounded-lg md:px-3 p-1" title="Профиль">
                            <div class="text-right md:mr-3 hidden sm:flex sm:flex-col text-white">
                                {{ auth()->user()->name }}
                                <div class="text-gray-300 justify-end hidden sm:flex">
                                    {{ auth()->user()->position }}
                                </div>
                            </div>
                            <img class="mr-3 h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="user_avatar" />
                        </a>
                       <a href="{{ url('/dashboard') }}" class="m-2 py-2 bg-green-700 hover:bg-green-800 shadow-xl px-5 text-white rounded">ЛК<i class="fa fa-sign-in-alt ml-2"></i></a>

                @else

                    @isset($student->id)

                        <a href="{{ route('student.dashboard') }}" class="mr-2 bg-red-700 hover:bg-red-800 shadow-xl px-5 my-2 py-2 text-white rounded float-right">
                            <i class="fa fa-sign-in-alt mr-1"></i>
                            {{ $student->last_name }} {{ $student->first_name }}
                        </a>
                    @else

                        <a href="{{ route('student.login') }}" class="flex my-2 mr-1 sm:m-2 bg-blue-600 hover:bg-blue-800 shadow-xl sm:px-5 p-2 items-center text-white rounded float-right w-30">
                            <div class="hidden sm:flex mr-3">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            Студент
                        </a>

                        <a href="{{ route('login') }}" class="flex my-2 mr-1 sm:m-2 bg-indigo-600 hover:bg-indigo-800 shadow-xl sm:px-5 p-2 items-center text-white rounded float-right">
                            <div class="hidden sm:flex mr-3">
                                <i class="fa fa-head-side-mask"></i>
                            </div>
                            Сотрудник
                        </a>
                    @endisset



                @endauth
                </div>
            </header>
        @endif


        <div class="text-2xl md:text-5xl py-4 pb-6 text-center  bg-green-800 w-full bg-opacity-70 text-white sm:bg-opacity-25 sm:text-black">
            Онлайн журнал оценок
        </div>


        <div class="h-full w-full flex flex-col items-center bg-green-500 bg-opacity-25">
                <div class="grid gap-1 md:grid-cols-3 sm:grid-cols-1">


                    <div class="p-2 sm:p-10 text-center mx-5 sm:mx-0 mt-4 sm:mt-0">
                        <div class="py-8 max-w-sm rounded overflow-hidden shadow-lg bg-gray-100 hover:bg-gray-300 transition duration-500">
                            <div class="md:space-y-5">
                                <i class="fa fa-head-side-mask" style="font-size:48px;"></i>
                                <div class="px-6 py-3 md:pb-9">
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

                    <div class="p-2 sm:p-10 text-center mx-5 sm:mx-0">
                        <div class="py-8 max-w-sm rounded overflow-hidden shadow-lg transition duration-500 bg-gray-100 hover:bg-gray-300">
                            <div class="md:space-y-5">
                                <i class="fa fa-graduation-cap" style="font-size:48px;"></i>

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

                    <div class="p-2 sm:p-10 text-center mx-5 sm:mx-0">
                        <div class="md:py-8 max-w-sm rounded overflow-hidden shadow-lg bg-red-200 md:bg-gray-100 hover:bg-red-200 transition duration-500">
                            <div class="md:space-y-5">
                                <div class="hidden sm:flex justify-center">
                                    <i class="fa fa-head-side-mask" style="font-size:48px;"></i>
                                </div>
                                <div class="px-6 py-3 md:pb-9">
                                    <div class="space-y-2">
                                        <div class="font-bold text-xl mb-2">Юридические ограничения</div>
                                        <p class="text-base pb-10 sm:pb-0">
                                            Не является заменой бумажного журнала!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

            <footer class="fixed bottom-0 flex w-full justify-center p-2 text-green-400 bg-green-500">
                Klyausov A.S. &copy {{ date('Y') }} <p class="ml-3 text-green-600 text-xs">ver 0.5.1</p>
            </footer>

    </div>





</x-guest-layout>
