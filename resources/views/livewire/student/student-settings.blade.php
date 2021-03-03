<div>
    <x-app-spinner target="photo" />

    <!-- Header -->
    <div class="my-3 ml-4 md:ml-0 text-3xl">
        Настройки профиля
    </div>


    <div class="md:grid md:grid-cols-2 md:gap-3">

        <div class="mt-5 md:mt-0 bg-white rounded-lg p-3 px-5">

            <form wire:submit.prevent="save">

                <div x-data="{photoName: null, photoPreview: null}" class="">

                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                           wire:model="photo"
                           x-ref="photo"
                           x-on:change="photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);" />

                    <x-label for="photo" value="{{ __('Photo') }}" class="mb-2" />

                    <!-- Current Profile Photo -->
                    <img alt="{{ $student->last_name }} {{ $student->name }}" class="rounded-xl" src="{{ $student->profile_photo_url }}" style="width: 130px;height: 130px;" x-show="! photoPreview">


                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="width: 130px;height: 130px;">
                        <span class="block rounded-full h-full w-full"
                              x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-secondary-button>

                    @if ($student->profile_photo_path)
                        <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-secondary-button>
                    @endif

                    <x-input-error for="photo" class="mt-2" />
                </div>

                <x-section-border class="w-full" />

                <div class="md:grid md:grid-cols-3 gap-6 items-center mt-3">
                    <div class="p-2 font-bold">
                        {{ __('Email') }}
                    </div>
                    <div class="col-span-2">
                        <x-input type="text" class="" wire:model.lazy="email"></x-input>
                        <x-input-error for="email" class="mt-2" />
                    </div>

                    <div class="p-2 font-bold">
                        {{ __('Phone') }}
                    </div>
                    <div class="col-span-2">
                        <x-input type="text" class="" wire:model.lazy="phone"></x-input>
                        <x-input-error for="phone" class="mt-2" />
                    </div>

                    <div class="p-2 font-bold">
                        {{ __('Password') }}
                    </div>
                    <div class="col-span-2">
                        <x-input type="password" class="" wire:model.lazy="password"></x-input>
                        <x-input-error for="password" class="mt-2" />
                    </div>
                </div>

                <div class="border-t border-gray-200 mb-3 mt-7"></div>

                <div class="flex items-center justify-end">
                    <x-action-message class="mr-8" on="saved">
                        {{ __('Saved') }}
                    </x-action-message>

                    <x-button class="">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>


</div>
