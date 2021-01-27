<div>

    <div class="pb-2 mt-2 flex items-center justify-between text-gray-600
				dark:text-gray-400 border-b dark:border-gray-600">
        <!-- Header -->
        <h2 class="hidden sm:flex ml-4 md:ml-0 text-3xl dark:text-gray-400">
            Журнал оценок
        </h2>

        <div class="text-lg">
           Занятий:

            <div class="flex text-2xl font-bold items-center">
                    {{ count($lessons) }}

                <div class="ml-3 font-normal text-base">
                    (из {{ $allTopicsCount }})
                </div>
            </div>
        </div>

        <div class="ml-2 sm:ml-4 text-lg">
             Рейтинг:
               <div class="flex text-2xl {{ $rating>=3 ? 'text-green-700':'text-red-700' }}">
                    3.4
                   <div class="flex-row mx-2 text-sm">
                       ( {{ \App\Models\Journal::RATING_TABLE['3.4'] }} )
                   </div>
               </div>
        </div>

        <div class="bg-gray-200 text-sm text-gray-500 leading-none border-2 border-gray-200 rounded-full inline-flex mr-5">
            <button class="inline-flex items-center focus:outline-none hover:text-green-400 focus:text-green-600 rounded-l-full px-4 py-2 {{ $changeView ? '' : 'active' }}" wire:click="$set('changeView', false)">
                <i class="fas fa-border-all mr-2"></i>
                <span class="hidden sm:block">Timeline</span>
            </button>
            <button class="inline-flex items-center focus:outline-none hover:text-green-400 focus:text-green-600 rounded-r-full px-4 py-2 {{ $changeView ? 'active' : '' }}" wire:click="$set('changeView', true)">
                <i class="fas fa-list mr-2"></i>
                <span class="hidden sm:block">Таблица</span>
            </button>

            <style>
                /*@apply bg-white text-blue-400 rounded-full;*/
                .active {background: white; border-radius: 9999px; color: green;}
            </style>
        </div>

        <a href="" class="hidden bg-green-700 hover:bg-green-500 shadow p-2 px-4 float-right rounded-lg text-white">
           Скачать Excel
        </a>
    </div>




    <div class="mt-2 flex justify-between text-gray-600 dark:text-gray-400">





    <!-- component -->
        <div class="container mx-auto px-4 sm:px-0">

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 sm:py-4 overflow-x-auto">
                <div class="inline-block min-w-full sm:shadow rounded-lg overflow-hidden">

{{--                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                                №
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                                Дата
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                                Тема
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                                Оценка
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                                Оценка
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase text-center tracking-wider">
                                Выставлено
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                    @if($classes->isNotEmpty())
                        @foreach ($classes as $class)

                            <tr>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                                        {{ ($loop->index + 1) }}
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                                    <p class=" {{ $class->pivot->attendance ? 'bg-green-200 text-gray-900' : 'bg-red-600 text-white' }} py-2 rounded-md whitespace-no-wrap">
                                        {{ $class->date }}
                                    </p>
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $class->title }}
                                    </p>
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $class->pivot->mark1 }}
                                    </p>
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $class->pivot->mark2 }}
                                    </p>
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm text-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-md"></span>
                                        <span class="relative">
                                            {{ $class->pivot->updated_at }}
                                        </span>

                                    </span>
                                    <div class="text-xs text-gray-500">
                                        @if(isset($edited_by))
                                            {{ $this->getShortName($edited_by[$class->pivot->user_id]) }}
                                        @endif
                                    </div>
                                </td>
                            </tr>

                        @endforeach

                    @else
                        <tr> <td class="px-5 py-5 border-b border-gray-200 bg-white" colspan="6">
                            <p class="text-red-700 text-md text-center">
                                Занятия не найдены...
                            </p>
                        </td></tr>
                    @endif

                        </tbody>
                    </table>--}}



                    <!-- component -->
                    <div class="container sm:bg-gray-300 mx-auto w-full h-full">
                        <div class="relative wrap overflow-hidden p-1 md:p-10 h-full">


                            <div class="hidden md:block border-2-2 absolute border-opacity-20 border-indigo-700 h-full border md:inset-x-1/2"></div>

                            @forelse($lessons as $lesson)

                                <!-- left timeline -->
                                <div class="mb-5 md:mt-0 md:mb-8 flex md:justify-between
                                {{ ($loop->index)%2 ? '' : 'md:flex-row-reverse' }} items-center w-full">
                                    <div class="md:order-1 md:w-5/12"></div>
                                    <div class="z-20 flex md:items-center md:order-1 {{ in_array($lesson->type, ['ИТОГОВАЯ', 'ЗАЧЕТНОЕ занятие', 'ЭКЗАМЕН']) ? 'bg-red-600' : 'bg-gray-600' }} shadow-xl w-8 h-8 rounded-full mr-2 sm:mr-0">
                                        <h1 class="mx-auto text-white font-bold text-lg">
                                            {{ (count($lessons) - $loop->iteration + 1) }}
                                        </h1>
                                    </div>
                                    <div class="md:order-1 w-full {{ ($this->isReclassed($lesson->pivot->attendance, $lesson->pivot->mark1, $lesson->pivot->mark2)||$lesson->pivot->attendance)  ? 'bg-gray-300 sm:bg-gray-100' : 'bg-red-600' }} text-black rounded-lg shadow-xl md:w-5/12 md:px-6 py-2 {{ in_array($lesson->type, ['ИТОГОВАЯ', 'ЗАЧЕТНОЕ занятие', 'ЭКЗАМЕН']) ? 'border-8' : 'border-2' }} border-green-800 ">



                                        <div class="flex m-2 items-center justify-start" x-data="{ tooltip: false }" {!! $this->isReclassed($lesson->pivot->attendance, $lesson->pivot->mark1, $lesson->pivot->mark2)  ? 'x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"' : '' !!}>

                                              <div class="rounded-md text-green-900 text-lg {{ $lesson->pivot->attendance  ? 'bg-green-100' : 'bg-red-200' }} shadow-lg items-center ml-4 p-2  font-bold">
                                                    {{ \Carbon\Carbon::parse($lesson->date)->translatedFormat('d F Y') }}
                                              </div>



                                            <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                <div class="absolute -top-4 z-5 w-auto p-2 -mt-1 text-sm leading-tight text-white text-center transform -translate-x-1/2 -translate-y-full bg-green-900 rounded-lg shadow-lg">
                                                    Отработано
                                                </div>
                                            </div>


                                            <div class="ml-5 flex justify-center items-center text-lg">
                                                <x-student-marks for="student"
                                                    mark1="{{ $lesson->pivot->mark1 }}"
                                                    mark2="{{ $lesson->pivot->mark2 }}"
                                                />
                                            </div>
                                         </div>

                                        <div class="md:mb-4 sm:mt-2 px-3 sm:px-1 text-justify">
                                            {{ $lesson->topic->title }}
                                        </div>

                                        <div class="text-sm mt-3 ml-3 md:text-right text-gray-700">

                                            {{ \Carbon\Carbon::parse($lesson->pivot->updated_at)->format('d/m/Y H:i') }}

                                            @if(isset($lesson->pivot->updated_by))
                                                ({{ $lesson->pivot->editedBy }})
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                @empty
                                    <div class="px-5 py-5 border-b border-gray-200 bg-white" colspan="6">
                                        <p class="text-red-700 text-md text-center">
                                            Занятия не найдены...
                                        </p>
                                    </div>
                                @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
