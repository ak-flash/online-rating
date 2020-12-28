<div>
    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-5 bg-white overflow-hidden shadow-xl sm:rounded-lg">

    <!-- Profile Photo -->

        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4" x-on:livewire-upload-finish="$wire.uploadPhoto()">
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

            <x-label for="photo" value="{{ __('Фотография') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
            </div>

            <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Выбрать новое фото') }}
            </x-secondary-button>

            @if ($user->profile_photo_path)
                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                    {{ __('Remove Photo') }}
                </x-secondary-button>
            @endif

            <x-input-error for="photo" class="mt-2" />
        </div>


<!-- Name -->
    <div class="col-span-6 sm:col-span-4">
        <x-label for="name" value="{{ __('Name') }}" />
        <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
        <x-input-error for="name" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="col-span-6 sm:col-span-4">
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
        <x-input-error for="email" class="mt-2" />
    </div>

    <!-- Position -->
    <div class="col-span-6 sm:col-span-4">
        <x-label for="position" value="{{ __('Position') }}" />

        <select id="position" class="mt-1 block w-25 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model.defer="position_id" />
        @foreach(\App\Models\User::POSITIONS as $key => $value)
            @if($key<=5)
                <option value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
        </select>

    </div>



            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-button>

        </div>
    </div>
</div>
