<x-app-layout>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-bold text-xl text-gray-800">
                     Кафедра {{ auth()->user()->department->name ?? 'отсутствует' }}

                    @if(auth()->user()->isAdmin())
                        <div class="flex items-center md:float-right text-sm mt-3 md:mt-0">
                        Сервер:
                            <div class="text-2xl mx-2">
                                Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                            </div>
                            (PHP v{{ PHP_VERSION }})
                        </div>
                    @endif
                </h2>
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
                            {{ Helper::getTypeOfWeek(now()) }}
                        </div>
                    </div>


                    <div class="min-w-screen bg-gray-200 flex px-5 py-5">

                        <!-- Component Start -->
                        <div class="grid md:grid-cols-4 gap-5 w-full max-w-6xl">

                            <!-- Tile 1 -->
                            <div class="flex items-center p-4 bg-white rounded">
                                <div class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">
                                    <i class="fa fa-arrow-up text-2xl text-gray-600 hover:text-green-500 shadow-lg"></i>
                                </div>
                                <div class="flex-grow flex flex-col ml-4">
                                    Студентов <span class="text-xl font-bold">8,430</span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500">last 30 days</span>
                                        <span class="text-green-500 text-sm font-bold ml-2">+12.6%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tile 2 -->
                            <div class="flex items-center p-4 bg-white rounded">
                                <div class="flex flex-shrink-0 items-center justify-center bg-red-200 h-16 w-16 rounded">
                                    <i class="fa fa-arrow-down text-2xl text-gray-600 hover:text-green-500 shadow-lg"></i>
                                </div>
                                <div class="flex-grow flex flex-col ml-4">
                                    Журналов <span class="text-xl font-bold">211</span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500">last 30 days</span>
                                        <span class="text-red-500 text-sm font-semibold ml-2">-8.1%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tile 3 -->
                            <div class="flex items-center p-4 bg-white rounded">
                                <div class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">
                                    <i class="fa fa-arrow-up text-2xl text-gray-600 hover:text-green-500 shadow-lg"></i>
                                </div>
                                <div class="flex-grow flex flex-col ml-4">
                                    Занятий <span class="text-xl font-bold">140</span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500">last 30 days</span>
                                        <span class="text-green-500 text-sm font-bold ml-2">+28.4%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tile 4 -->
                            <div class="flex items-center p-4 bg-white rounded">
                                <div class="flex flex-shrink-0 items-center justify-center bg-red-200 h-16 w-16 rounded">
                                    <i class="fa fa-arrow-down text-2xl text-gray-600 hover:text-green-500 shadow-lg"></i>
                                </div>
                                <div class="flex-grow flex flex-col ml-4">
                                    Пользователей <span class="text-xl font-bold">211</span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500">last 30 days</span>
                                        <span class="text-red-500 text-sm font-semibold ml-2">-8.1%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Component End  -->

                    </div>




                </div>
            </div>


    </div>
</x-app-layout>
