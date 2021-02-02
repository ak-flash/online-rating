<div class="mr-1 sm:mr-3 px-2 py-1 shadow-xl rounded-lg border {{ $mark1==0 ? 'hidden' : '' }}
    {{ $for=='student' ? 'text-white bg-' : 'border-' }}{{ App\Helper\Helper::getMarkColor($mark1) }}">

    {{ $mark1 }}

</div>
<div class="px-2 py-1 shadow-xl rounded-lg border {{ $mark2==0 ? 'hidden' : '' }}
    {{ $for=='student' ? 'text-white bg-' : 'border-' }}{{ App\Helper\Helper::getMarkColor($mark2) }}">

    {{ $mark2 }}

</div>
