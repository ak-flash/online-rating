<div>
        <!-- component -->



        <x-app-spinner target="find_profile" />


        <div class="h-screen w-screen" style="background-image: url({{ asset('img/home-background.jpg') }}); background-repeat: no-repeat;background-size: 100% 100%;">
            <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
                <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white  bg-opacity-90 sm:mx-0" style="height: 350px">


                    <div class="flex flex-col w-full md:w-1/2 p-4">
                        <div class="flex flex-col flex-1 justify-center items-center mb-8">



                            <h1 class="text-3xl text-center">
                                <a href="{{ route('home') }}">
                                    Онлайн журнал
                                </a>
                            </h1>

                            <div class="flex flex-col w-3/4 mt-4">

                                <div class="bg-gray-200 text-sm text-gray-500 leading-none border-2 border-gray-200 rounded-full inline-flex mb-3">

                                    <button class="inline-flex items-center focus:outline-none hover:text-green-400 focus:text-green-600 rounded-l px-4 py-2 {{ $changeAuthMethod ? '' : 'active' }}" wire:click="$set('changeAuthMethod', false)">
                                        Номер зачётки
                                    </button>
                                    <button class="inline-flex items-center focus:outline-none hover:text-green-400 focus:text-green-600 rounded-r px-4 py-2 {{ $changeAuthMethod ? 'active' : '' }}" wire:click="$set('changeAuthMethod', true)">
                                        Email, пароль
                                    </button>

                                    <style>
                                        /*@apply bg-white text-blue-400 rounded-full;*/
                                        .active {background: white; border-radius: 9999px; color: green;}
                                    </style>
                                </div>

                                <form class="w-full flex flex-col justify-center mx-auto" wire:submit.prevent="find_profile">

                                        <x-input type="text" class="h-10 m-1 border rounded border-grey-400 {{ $changeAuthMethod ? 'hidden' : '' }}" wire:model="document_id" id="document_id" placeholder="№ личного дела" autofocus/>
                                        <x-input-error for="document_id" class="rounded bg-red-200 p-1 text-center" />

                                    <x-input type="text" class="h-10 m-1 border rounded border-grey-400 {{ $changeAuthMethod ? '' : 'hidden' }}" wire:model="email" placeholder="{{ __('Email') }}" autofocus/>
                                    <x-input-error for="email" class="rounded bg-red-200 p-1 text-center" />

                                    <x-input type="password" class="h-10 m-1 border rounded border-grey-400 {{ $changeAuthMethod ? '' : 'hidden' }}" wire:model.lazy="password" placeholder="{{ __('Password') }}" />
                                        <x-input-error for="password" class="rounded bg-red-200 p-1 text-center" />


                                        <x-button class="mt-2 w-full">
                                            Войти
                                        </x-button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:flex md:w-1/2 rounded-r-lg items-center" style="background: url({{ asset('img/enter-back.jpg') }}); background-size: cover; background-position: center center;">
                        <x-application-logo class="w-34 my-10 mx-auto bg-white rounded-full" />
                    </div>
                </div>
            </div>
        </div>


        <x-dialog-modal wire:model="showConfirmation" :maxWidth="1">
            <x-slot name="title">

            </x-slot>

            <x-slot name="content">
                <div class="flex flex-col items-center">
                    @isset($student)
                        <p class="pt-2 text-lg font-bold">Это ваш профиль?</p>

                        <img class="h-24 w-24 m-2 rounded-full mx-auto" src="{{ $student->profile_photo_url }}" alt="Avatar" />
                        <p class="pt-2 text-xl font-bold">
                            {{ $student->last_name }}
                        </p>

                        {{ $student->name }}

                        <p class="text-sm text-gray-600 m-2 text-center">
                            Факультет: <b class="text-lg">{{ $student->faculty->name }}</b>
                        </p>
                        <p class="text-sm text-gray-600 mb-2">
                            Курс: <b class="text-lg">{{ $student->course_number }}</b>
                            Группа: <b class="text-lg">{{ $student->group_number }}</b>
                        </p>
                    @else
                        <i class="fa fa-exclamation-triangle text-red-600" style="font-size:48px;"></i>
                        <div class="pt-2 text-lg text-red font-bold mb-3">Ваш профиль не найден!</div>
                    @endisset
                </div>
            </x-slot>

            <x-slot name="footer">

                @isset($student)
                    <x-button class="mr-2 bg-green-500 hover:bg-green-600
                            shadow-xl px-5 py-2 text-white rounded" wire:click="confirm"
                                  wire:loading.attr="disabled">
                        Подтвердить
                    </x-button>
                @endisset

                <x-danger-button class="ml-2" x-on:click="show = false">
                    {{ __('Закрыть') }}
                </x-danger-button>

            </x-slot>
        </x-dialog-modal>
</div>
