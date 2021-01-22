<div>

    <div class="pb-2 mt-2 flex items-center justify-between text-gray-600
				dark:text-gray-400 border-b dark:border-gray-600">
        <!-- Header -->
        <h2 class="ml-4 md:ml-0 text-3xl dark:text-gray-400">
            Журнал оценок
        </h2>

        <div class="ml-4 text-lg">
           Занятий: {{ count($lessons) }}
        </div>

        <div class="ml-4 text-lg">
             Рейтинг:
               {{--<div class="flex text-2xl {{ $rating>=3 ? 'text-green-700':'text-red-700' }}">
                   {{ $rating }}
                   <div class="mx-2 text-sm">
                       ( {{ $rating ?
                        \App\Models\Journal::RATING_TABLE[strval($rating)]
                        : 0 }} )
                   </div>
               </div>--}}
        </div>
        <div class="relative">
            <x-select class="">
                <option value="1">Вид: Timeline</option>
                <option value="2">Вид: Простой</option>
            </x-select>
        </div>

        <a href="" class="bg-green-700 hover:bg-green-500 shadow p-2 px-4 float-right rounded-lg text-white">
           Скачать Excel
        </a>
    </div>




    <div class="mt-2 flex justify-between text-gray-600 dark:text-gray-400">





    <!-- component -->
        <div class="container mx-auto px-4 sm:px-0">

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">

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
                    <div class="container bg-gray-200 mx-auto w-full h-full">
                        <div class="relative wrap overflow-hidden p-5 md:p-10 h-full">


                            <div class="border-2-2 absolute border-opacity-20 border-indigo-700 h-full border md:inset-x-1/2"></div>

                            @forelse ($lessons as $lesson)

                            <!-- left timeline -->
                            <div class="mb-8 flex md:justify-between
                            {{ ($loop->index)%2 ? '' : 'md:flex-row-reverse' }} items-center w-full">
                                <div class="md:order-1 md:w-5/12"></div>
                                <div class="z-20 flex md:items-center md:order-1 bg-gray-800 shadow-xl w-8 h-8 rounded-full">
                                    <h1 class="mx-auto text-white font-bold text-lg">
                                        {{ (count($lessons) - $loop->iteration + 1) }}
                                    </h1>
                                </div>
                                <div class="md:order-1 w-full {{ $this->isReclassed($lesson->pivot->attendance, $lesson->pivot->mark1, $lesson->pivot->mark2)  ? 'bg-green-600' : 'bg-red-600' }} text-white rounded-lg shadow-xl md:w-5/12 md:px-6 py-2 {{ in_array($lesson->type, ['ИТОГОВАЯ', 'ЗАЧЕТНОЕ занятие', 'ЭКЗАМЕН']) ? 'border-8 border-green-800' : '' }}">

                                  <div class="mb-4">
                                      {{ Str::ucfirst($lesson->type) }}
                                  </div>

                                    <div class="flex m-2 md:m-0 justify-center">

                                          <div class="rounded-md text-green-900 text-lg {{ $lesson->pivot->attendance  ? 'bg-green-100' : 'bg-red-200' }} items-center px-3 md:p-4 font-bold">
                                                {{ \Carbon\Carbon::parse($lesson->date)->translatedFormat('d F Y') }}
                                          </div>
                                        <div class="ml-5 flex items-center  text-lg">
                                            <x-student-marks for="student"
                                                mark1="{{ $lesson->pivot->mark1 }}"
                                                mark2="{{ $lesson->pivot->mark2 }}"
                                            />
                                        </div>
                                     </div>



                                    <h3 class="m-2 pl-3 text-white text-md">
                                        {{ $lesson->title }}
                                    </h3>
                                    <div class="text-sm mt-3 ml-3 md:text-right text-gray-100">

                                        {{ \Carbon\Carbon::parse($lesson->pivot->updated_at)->format('d/m/Y H:i') }}

                                        {{--@if(isset($lesson->pivot->updated_by))
                                            ({{ Helper::getShortName($lesson->pivot->editedBy->name) }})
                                        @endif--}}
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
