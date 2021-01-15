@foreach($widgets as $widget)
    <div class="flex items-center justify-between p-2 -mx-2 hover:bg-gray-100">
    {{ $widget->name }}
    </div>
@endforeach
