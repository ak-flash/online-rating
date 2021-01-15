<div class="flex justify-center">

    <button class="bg-green-700 hover:bg-green-500 ml-5 m-2 p-2 px-4 text-white text-sm font-semibold rounded" wire:click="update({{ $value }})">
        <i class="fas fa-edit" style="font-size:12px;"></i>
    </button>
    <button class="bg-red-700 hover:bg-red-500 m-2 p-2 px-4 text-white text-sm font-semibold rounded" wire:click="deleteConfirmation({{ $value }})">
        <i class="fas fa-trash" style="font-size:12px;"></i>
    </button>

</div>
