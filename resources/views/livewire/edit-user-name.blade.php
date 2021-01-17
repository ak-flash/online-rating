<div x-data="
        {
            isEditing: false,
            focus: function() {
                const textInput = this.$refs.textInput;
                textInput.focus();
                textInput.select();
            }
        }
    " x-cloak>

    <div class="" x-show=!isEditing >
        <span class="sm:underline" x-on:click="isEditing = true; $nextTick(() => focus());
                                                $refs.editor.classList.remove('hidden')" >
            {{ $userName }}
        </span>
    </div>
    <div x-show=isEditing x-transition:enter="transition ease-out duration-300">
        <form class="hidden flex items-center" wire:submit.prevent="save"
              x-ref="editor">

            <x-input
                type="text"
                class=""
                x-ref="textInput"
                wire:model.lazy="userName"
                x-on:keydown.enter="isEditing = false"
                x-on:keydown.escape="isEditing = false"
            />
            <button type="button" class="px-1 ml-2 text-2xl text-red-600" title="Cancel"
                    x-on:click="isEditing = false">x</button>
            <button
                type="submit"
                class="px-1 ml-2 text-2xl font-bold text-green-600"
                title="Cохранить"
                x-on:click="isEditing = false"
            >✓ Enter</button>
        </form>

    </div>
</div>
