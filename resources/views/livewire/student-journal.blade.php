<div>
            <h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
                Дисциплины
            </h2>
            <div
                class="pb-2 flex items-center justify-between text-gray-600
				dark:text-gray-400 border-b dark:border-gray-600">
                <!-- Header -->

                <div>
					<span>
						<span class="text-green-500 dark:text-green-200">
							4
						</span>
						кафедры;
					</span>
                    <span>
						<span class="text-green-500 dark:text-green-200">
							22
						</span>
						занятия;
					</span>

                </div>


            </div>
            <div class="mt-6 flex justify-between text-gray-600 dark:text-gray-400">
                <!-- List sorting -->


                <div class="ml-10 mr-12 flex capitalize">
                    <!-- Right side -->

                    <span class="mr-16 pr-1 flex items-center">
						Кафедра
						<svg
                            class="ml-1 h-5 w-5 fill-current"
                            viewBox="0 0 24 24">
							<path
                                d="M18 21l-4-4h3V7h-3l4-4 4 4h-3v10h3M2
								19v-2h10v2M2 13v-2h7v2M2 7V5h4v2H2z"></path>
						</svg>
					</span>

                    <span class="mr-16 pr-2 flex items-center">
						Преподаватель
						<svg
                            class="ml-1 h-5 w-5 fill-current"
                            viewBox="0 0 24 24">
							<path
                                d="M18 21l-4-4h3V7h-3l4-4 4 4h-3v10h3M2
								19v-2h10v2M2 13v-2h7v2M2 7V5h4v2H2z"></path>
						</svg>
					</span>


                    <span class="mr-16 flex items-center">
						Дата изменений
						<svg
                            class="ml-1 h-5 w-5 fill-current"
                            viewBox="0 0 24 24">
							<path
                                d="M18 21l-4-4h3V7h-3l4-4 4 4h-3v10h3M2
								19v-2h10v2M2 13v-2h7v2M2 7V5h4v2H2z"></path>
						</svg>
					</span>
                </div>

            </div>

            <div class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                <!-- Card -->

               {{-- @foreach ($disciplinesas as $discipline)
                    <div class="text-sm p-2 text-center">
                        {{ $discipline->faculty->name }}
                    </div>
                @endforeach--}}

            </div>
        </div>

</div>
