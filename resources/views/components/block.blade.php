@props([
    'title',
    'desc'
])

<div class="container mx-auto font-epilogue mb-16">
    <div class="flex items-center justify-between mr-10 mb-8">
        <div class="basis-3/4">
            <h1 class="text-3xl font-semibold mb-2.5">{{ $title }}</h1>
            @if(isset($desc))
                <span>{{ $desc }}</span>
            @endif
        </div>
        <div class="basis-1/5 flex justify-end">
            <button class="px-4 py-2 border border-mint-green rounded leading-tight font-medium text-base">See all</button>
        </div>
    </div>
    {{ $slot }}
</div>