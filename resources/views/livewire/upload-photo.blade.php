<div>
    <form wire:submit.prevent="save">
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4" x-on:livewire-upload-finish="$wire.save()"> 
        <input type="file" class="hidden" wire:model="photo" x-ref="photo" @change="photoName = $refs.photo.files[0].name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreview = e.target.result;
                };
                reader.readAsDataURL($refs.photo.files[0]);" >
    
        @error('photo') <span class="error">{{ $message }}</span> @enderror
    

        <!-- New Profile Photo Preview -->
        <div class="mt-2" x-show="photoPreview">
            <span class="block rounded-full w-20 h-20"
                  x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" >
            </span>
        </div>
        
        <button class="m-2 p-2 bg-red-800" x-on:click.prevent="$refs.photo.click()">
        {{ __('Select A New Photo') }}
    </button>

    <button wire:click="save">Archive</button>
    </form>
    
        
    
</div>
    
</div>
