<div class="mr-1 sm:mr-3 px-2 py-1 rounded-md border {{ $mark1==0 ? 'hidden' : '' }}
    {{ $for=='student' ? 'text-white bg-' : 'border-' }}{{ Helper::getMarkColor($mark1) }}">

    {{ $mark1 }}

</div>
<div class="px-2 py-1 rounded-md border {{ $mark2==0 ? 'hidden' : '' }}
    {{ $for=='student' ? 'text-white bg-' : 'border-' }}{{ Helper::getMarkColor($mark2) }}">

    {{ $mark2 }}

</div>
