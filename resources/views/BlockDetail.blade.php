<x-app-layout>
    <a href="/" class="flex-center justify-start cursor-pointer mx-10 mt-4 gap-2">
        <span><</span>
        <span class="text-base">Back</span>
    </a>
    <div class="container mx-auto">
        <div class="mt-10 mb-20">
            <h3 class="text-2xl font-semibold mb-6">{{ $blocks['blockName'] ?? 'Your recent searches' }}</h3>
            <ul class="grid grid-cols-3 gap-6">
                @if(isset($blocks['blockName'])) 
                    @foreach($blocks['hotels'] as $hotel)
                        <li class="relative col-span-1">
                            <img src="{{ asset($hotel['image']) }}" alt="" class="w-full h-full" />
                            <div class="absolute bottom-0 flex-center w-full text-center text-white bg-detail-block py-4">
                                <div class="max-w-sm">
                                    <h3 class="text-xl font-medium">{{ $hotel['hotelName'] }}</h3>
                                    <p class="text-sm mt-2">{{ $hotel['location'] }}</p>
                                    <a href="{{ route('hotelsDetail', ['id' => $hotel['hotelId']]) }}">
                                        <button class="px-4 py-2 bg-mint-green rounded leading-tight font-medium text-sm mt-4 text-black">
                                            Show Hotel
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    @foreach($blocks as $hotel)
                        <li class="relative col-span-1">
                            <img src="{{ asset($hotel['image']) }}" alt="" class="w-full h-full" />
                            <div class="absolute bottom-0 flex-center w-full text-center text-white bg-detail-block py-4">
                                <div class="max-w-sm">
                                    <h3 class="text-xl font-medium">{{ $hotel['name'] }}</h3>
                                    <p class="text-sm mt-2">{{ $hotel['location'] }}</p>
                                    <a href="{{ route('hotelsDetail', ['id' => $hotel['hotelId']]) }}">
                                        <button class="px-4 py-2 bg-mint-green rounded leading-tight font-medium text-sm mt-4 text-black">
                                            Show Hotel
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</x-app-layout>