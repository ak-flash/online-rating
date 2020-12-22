<div>
    <x-guest-layout>
        <!-- component -->



        <x-app-spinner target="find_profile" />


    <div class="h-screen w-screen" style="background-image: url({{ asset('img/home-background.jpg') }}); background-repeat: no-repeat;background-size: 100% 100%;
">
        <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
            <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 350px">
                <div class="flex flex-col w-full md:w-1/2 p-4">
                    <div class="flex flex-col flex-1 justify-center items-center mb-8">

                        <x-jet-application-logo class="w-24 mt-4" />

                        <h1 class="text-3xl text-center mt-2">
                            <a href="{{ route('home') }}">
                                Онлайн журнал
                            </a>
                        </h1>

                        <div class="w-full mt-2">

                            <form class="form-horizontal w-3/4 mx-auto" wire:submit.prevent="find_profile">
                                <div class="flex flex-col">

                                    <x-jet-input type="text" class="flex-grow h-10 px-2 border rounded border-grey-400" wire:model.lazy="document_id" id="document_id" placeholder="№ личного дела (зачётки)" autofocus/>

                                </div>

                                <x-jet-input-error for="document_id" class="rounded bg-red-200 mt-2 p-1 text-center" />

                                <div class="flex flex-col mt-4">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700
                                     text-white text-sm font-semibold py-2 px-4 rounded">
                                        Войти
                                    </button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block md:w-1/2 rounded-r-lg" style="background: url({{ asset('img/enter-back.jpg') }}); background-size: cover; background-position: center center;"></div>
            </div>
        </div>
    </div>


                <x-jet-dialog-modal wire:model="showConfirmation" :maxWidth="1">
                    <x-slot name="title">

                    </x-slot>

                    <x-slot name="content">
                        <div class="flex flex-col items-center">
                            @isset($student)
                                <p class="pt-2 text-lg font-semibold">Это ваш профиль?</p>

                                <img class="h-24 w-24 m-2 rounded-full mx-auto" src="{{ asset('img/avatar-placeholder.png') }}" alt="Avatar" />
                                <p class="pt-2 text-xl font-semibold">
                                    {{ $student->last_name }} {{ $student->first_name }}
                                </p>
                                <p class="text-sm text-gray-600 m-2 text-center">
                                    Факультет: <b class="text-lg">{{ $student->faculty->name }}</b>
                                </p>
                                <p class="text-sm text-gray-600 mb-2">
                                    Курс: <b class="text-lg">{{ $student->course_number }}</b>
                                    Группа: <b class="text-lg">{{ $student->group_number }}</b>
                                </p>
                            @else
                                <i class="fa fa-exclamation-triangle text-red-600" style="font-size:48px;"></i>
                                <div class="pt-2 text-lg text-red font-semibold mb-3">Ваш профиль не найден!</div>
                            @endisset
                        </div>
                    </x-slot>

                    <x-slot name="footer">

                        @isset($student)
                            <x-jet-button class="mr-2 bg-green-500 hover:bg-green-600
                            shadow-xl px-5 py-2 text-white rounded" wire:click="confirm"
                                          wire:loading.attr="disabled">
                                Подтвердить
                            </x-jet-button>
                        @endisset

                            <x-jet-danger-button class="ml-2" wire:click="$toggle('showConfirmation')" wire:loading.attr="disabled">
                                {{ __('Закрыть') }}
                            </x-jet-danger-button>

                    </x-slot>
                </x-jet-dialog-modal>
    </x-guest-layout>
</div>
