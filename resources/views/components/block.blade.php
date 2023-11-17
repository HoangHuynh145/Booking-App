@props([
    'title',
    'desc',
    'blocks'
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
            @if(isset($blocks))
                <form action="{{ route('listBlocks') }}" method="POST">
                    @csrf
                    <input type="hidden" name="value" value="{{ $blocks }}">
                    <button class="px-4 py-2 border border-mint-green rounded leading-tight font-medium text-base">See all</button>
                </form>
            @endif
        </div>
    </div>
    {{ $slot }}
</div>