<div>
    <div class="hidden w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50" wire:loading.delay {{ empty($target) ? '' : 'wire:target='.$target }}>
          <span class="text-green-500 opacity-75 top-1/2 my-0 mx-5/12 md:mx-auto block relative w-0 h-0">
                <i class="fas fa-circle-notch fa-spin fa-4x"></i>
          </span>
    </div>
</div>
