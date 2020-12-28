<div>

        <div class="fixed right-8 top-2 p-3 rounded-sm max-w-sm pointer-events-auto text-center {{ $alertTypeClasses[$alertType] }}"
         x-data="{show:false}"
         @toast-message-show.window="show = true; setTimeout(() => show=false, 5000);"
         x-show="show" x-cloak style="display: none; width: 300px;">
            {{ $message }}
        </div>

</div>
