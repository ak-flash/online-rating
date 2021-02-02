<div>
    <!-- Component Start -->
    <div class="fixed right-5 top-2 flex items-center h-16 border border-gray-300 pr-2 w-full max-w-md shadow-lg pointer-events-auto {{ $alertTypeClasses[$alertType] }}" x-data="{show:false}"
         @toast-message-show.window="show = true; setTimeout(() => show=false, 5000);"
         x-show="show" x-cloak style="display: none; width: 300px;">
        <div class="flex items-center justify-center bg-gray-300 w-2 h-full">
        </div>
        <div class="px-6">
            <h5 class="font-bold">{{ $title }}</h5>
            <p class="text-sm">{{ $message }}</p>
        </div>
        <button class="ml-auto mr-3">
            <i class="fa fa-times text-2xl hover:text-gray-900"></i>
        </button>
    </div>
    <!-- Component End  -->

</div>
