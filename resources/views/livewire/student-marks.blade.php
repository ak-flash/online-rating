<div>

    <div class="pb-2 mt-2 flex items-center justify-between text-gray-600
				dark:text-gray-400 border-b dark:border-gray-600">
        <!-- Header -->
        <h2 class="text-3xl font-semibold dark:text-gray-400">
            Журнал оценок
        </h2>

    </div>
    <div class="mt-2 flex justify-between text-gray-600 dark:text-gray-400">





    <!-- component -->
        <div class="container mx-auto px-4 sm:px-0">

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
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
                    </table>
                    <div class="px-5 py-2 bg-white border-t flex xs:flex-row items-center xs:justify-between">



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
