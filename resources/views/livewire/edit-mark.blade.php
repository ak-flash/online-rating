<div x-data=" { isEditing: false } " x-cloak>
    <div class="" x-show=!isEditing >
        <span class="cursor-pointer" x-on:click="isEditing = true; $refs.editor.classList.remove('hidden')" >
            <div class="px-2 py-1 rounded-lg shadow-xl border
                {{ $studentMark==0 ? 'text-black' : 'text-white' }}
                bg-{{ App\Helper\Helper::getMarkColor($studentMark) }}">
                {{ $studentMark }}
            </div>
        </span>
    </div>
    <div x-show=isEditing x-transition:enter="transition ease-out duration-300">
        <div class="hidden flex items-center"
              x-ref="editor">

            <x-select class="w-20"
            wire:model.lazy="studentMark"
            @change="isEditing = false"
            x-on:keydown.enter="isEditing = false"
            x-on:keydown.escape="isEditing = false">
                <option value="0">нет</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </x-select>
            <button type="button" class="px-1 ml-2 text-2xl text-red-600" title="Отмена"
                    x-on:click="isEditing = false">
                <i class="fa fa-times text-lg hover:text-gray-900"></i>
            </button>
        </div>

    </div>
</div>
