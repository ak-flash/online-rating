<div class="mr-3 px-2 py-1 rounded-md border {{ $mark1==0 ? 'hidden' : '' }}
    {{ $for=='student' ? 'bg-' : 'border-' }}{{ Helper::getMarkColor($mark1) }}">

    {{ $mark1 }}

</div>
<div class="px-2 py-1 rounded-md border {{ $mark2==0 ? 'hidden' : '' }}
    {{ $for=='student' ? 'bg-' : 'border-' }}{{ Helper::getMarkColor($mark2) }}">

    {{ $mark2 }}

</div>