<x-app-layout>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="py-6 font-bold text-xl text-gray-800">
                     Кафедра {{ auth()->user()->department->name ?? 'отсутствует' }}
                </h2>

                @if(auth()->user()->isAdmin())
                    <div class="py-2 flex flex-col order-last text-sm">
                        <div class="flex items-center">
                            Сервер:
                            <div class="text-xl mx-2">
                                Laravel v.{{ Illuminate\Foundation\Application::VERSION }}
                            </div>
                        </div>
                        <div class="text-base">
                            «{{ App::environment() }}» (PHP v{{ PHP_VERSION }})
                        </div>

                    </div>
                @endif


            </div>
        </header>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white text-lg overflow-hidden shadow-xl sm:rounded-lg">


                        <div class="p-5 text-2xl">
                            Статистика за семестр
                        </div>



                    <div class="min-w-screen flex flex-col md:flex-row text-center bg-green-100 flex px-5 py-5">
                        <div class="md:mr-5 text-3xl">
                            {{ now()->translatedFormat('d F Y') }}
                        </div>
                        Текущая неделя:
                        <div class="md:ml-3 text-2xl">
                            {{ App\Helper\Helper::getTypeOfWeek(now()) }}
                        </div>
                    </div>


                    <div class="min-w-screen bg-gray-200 flex px-5 py-5">

                        <!-- Component Start -->
                        <div class="grid md:grid-cols-4 gap-5 w-full max-w-6xl">

                            <!-- Tile 1 -->
                            <div class="flex items-center p-4 bg-white rounded">
                                <div class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">
                                    <i class="fa fa-arrow-up text-2xl text-gray-600"></i>
                                </div>
                                <div class="flex-grow flex flex-col ml-4">
                                    Студентов
                                    <span class="text-xl font-bold">
                                        {{ \App\Models\Student::all()->count() }}
                                    </span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500">last 30 days</span>
                                        <span class="text-green-500 text-sm font-bold ml-2">+12.6%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tile 2 -->
                            <div class="flex items-center p-4 bg-white rounded">
                                <div class="flex flex-shrink-0 items-center justify-center bg-red-200 h-16 w-16 rounded">
                                    <i class="fa fa-arrow-down text-2xl text-gray-600"></i>
                                </div>
                                <div class="flex-grow flex flex-col ml-4">
                                    Групп
                                    <span class="text-xl font-bold">
                                        {{ \App\Models\Journal::whereDepartmentId(auth()->user()->department_id)->count() }}
                                    </span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500">last 30 days</span>
                                        <span class="text-red-500 text-sm font-semibold ml-2">-8.1%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tile 3 -->
                            <div class="flex items-center p-4 bg-white rounded">
                                <div class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">
                                    <i class="fa fa-arrow-up text-2xl text-gray-600"></i>
                                </div>
                                <div class="flex-grow flex flex-col ml-4">
                                    Занятий
                                    <span class="text-xl font-bold">
                                        {{ \App\Models\Lesson::all()->count() }}
                                    </span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500">last 30 days</span>
                                        <span class="text-green-500 text-sm font-bold ml-2">+28.4%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tile 4 -->
                            <div class="flex items-center p-4 bg-white rounded">

                                <div class="flex flex-shrink-0 items-center justify-center text-3xl bg-red-200 h-16 w-16 rounded">
                                    {{ \App\Models\User::whereDepartmentId(auth()->user()->department_id)->count() }}
                                </div>
                                <div class="ml-3 text-xl">
                                    Сотрудников
                                </div>
                            </div>
                        </div>
                        <!-- Component End  -->

                    </div>




                </div>
            </div>


    </div>
</x-app-layout>
