@props(['hotel', 'dateCheckin', 'dateCheckout'])

<div class="flex items-center pl-3 bg-white rounded-lg mb-6 shadow-sm max-h-80">
    <img src="{{ asset($hotel->image) }}" alt="" class="w-72 h-72 object-cover object-center rounded-lg" />
    <div class="p-6 flex-1">
        <div class="font-epilogue">
            <div class="flex items-start justify-between gap-3.5">
                <!-- <h2 class="text-4xl font-semibold mb-4">CVK Park Bosphorus Hotel Istanbul</h2> -->
                <h2 class="text-4xl font-semibold mb-4 line-clamp-2">{{ $hotel->name }}</h2>
                <div>
                    <p class="text-sm text-gray-600/80">starting from</p>
                    <strong class="text-salmon text-2xl">{{ number_format($hotel->price / 1000, 3) }}đ/night</strong>
                    <p class="text-sm text-gray-600/80 text-right">excl. tax</p>
                </div>
            </div>
            <p class="flex text-sm"><x-icons.location /> {{ $hotel->location }}</p>
            <ul class="flex items-center font-poppins my-2">
                @for ($i = 1; $i <= 5; $i++) <li class="{{ $hotel->level >= $i ? '' : 'invisible' }}">
                    <x-icons.star-fill color="#FF8682" />
                    </li>
                    @endfor
                    <li class="leading-none mt-1 ml-1">
                        {{ $hotel->level }} star hotel
                    </li>
            </ul>
            @if($hotel->stars > 0)
                <div class="flex items-center mt-3 gap-1 font-poppins" >
                    <span class="rounded-lg border border-mint-green flex-center w-10 h-8 text-sm font-medium cursor-pointer">{{ $hotel->stars }}</span>
                    <p class="font-semibold">
                        @if($hotel->stars >= 1 && $hotel->stars < 2)
                            Awful
                        @elseif($hotel->stars < 3)
                            Mediocre
                        @elseif($hotel->stars < 4)
                            Good
                        @elseif($hotel->stars <= 5)
                            Very Good
                        @elseif($hotel->stars === 5)
                            Excellent
                        @endif
                    </p>
                </div>
            @endif

        </div>
        <div class="flex pt-6 mt-6 border-t border-slate-800">
            <button class="w-full bg-mint-green rounded-lg font-medium h-12">
                <a href="{{ route('hotelsDetail', ['id' => $hotel->id, 'dateCheckin'=> $dateCheckin ?? '', 'dateCheckout'=> $dateCheckout ?? '']) }}">
                    View Place
                </a>
            </button>
        </div>
    </div>
</div>