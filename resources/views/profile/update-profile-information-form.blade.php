<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">



        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <a @click="$dispatch('img-modal', {  imgModalSrc: '{{ $this->user->profile_photo_url }}', imgModalDesc: '' })" class="cursor-pointer" x-show="! photoPreview">
                    <img alt="{{ $this->user->name }}" class="rounded-xl h-20 w-20 object-cover" src="{{ $this->user->profile_photo_url }}">
                </a>



                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-1/2" wire:model.defer="state.email" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('PhoneNumber') }}" />
            <div class="flex items-center">
                <x-input type="text" if="phone" class="mt-1 block w-1/2" wire:model.defer="state.phone" data-mask='+# (###) ###-####' />
                <x-input type="checkbox" class="mx-2 ml-6" wire:model.defer="state.show_phone" />
                <p class="text-xs">Показывать студентам</p>
            </div>
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Position -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="position" value="{{ __('Position') }}" />

            <select id="position" class="mt-1 block w-25 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model.defer="state.position_id" />
                @foreach(\App\Models\User::POSITIONS as $key => $value)
                    @if($key<=5)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>

        </div>

    <x-image-popup />

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
