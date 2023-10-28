@props([
'iconLink',
'position',
])

<!-- assets/icons/bed-fill.svg -->

<div class="flex items-center border border-black rounded relative h-14 px-2 w-full">
    @if(isset($position) && $position == 'left' && isset($iconLink))
        <img src="{{asset($iconLink)}}" alt="" class="w-6 h-7 mt-0.5" />
    @endif
    <input {{ $attributes->merge(['class' => 'flex-1 bg-transparent h-full px-1.5']) }} />
    @if(isset($position) && $position == 'right' && isset($iconLink))
        <img src="{{asset($iconLink)}}" alt="" class="w-6 h-7 mt-0.5" />
    @endif
    <span class="absolute -top-1/2 mt-0.5 translate-y-1/2 bg-white px-1">Enter Destination</span>
</div>