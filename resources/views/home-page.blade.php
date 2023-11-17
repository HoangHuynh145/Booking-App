<x-app-layout>

    <div class="w-full relative min-h-[510px]">
        <img src="{{asset('assets/imgs/HeroBanner.png')}}" class="w-full absolute inset-0" />
        <div class="absolute inset-0 z-10 w-full h-full bg-gradient-to-r from-[rgba(0,35,77,0.63)] to-transparent"></div>
        <div class="absolute z-10 text-white font-epilogue left-20 top-[20%]">
            <h1 class="text-5xl max-w-lg tracking-wide font-medium leading-tight">
                Make your travel whishlist, we’ll do the rest
            </h1>
            <p class=" font-poppins text-lg">Special offers to suit your plan</p>
        </div>
    </div>

    <div class="container mx-auto relative -top-20 z-20 bg-white border border-black rounded-2xl">
        <h2 class="pb-4 pt-6 px-4 text-lg font-medium font-epilogue">Where are you going?</h2>
        <form action="{{ route('listHotel') }}" method="GET" class="pt-2.5 pb-5 px-4">
            @csrf
            <ul class="grid grid-cols-4 gap-3">
                <li class="col-span-1">
                    <x-input-primary iconLink="assets/icons/bed-fill.svg" position="left" title="Enter Destination" placeholder="Đà Nẵng" name="location" />
                </li>
                <li class="col-span-1">
                    <x-input-primary type="datetime-local" position="right" title="Check In" name="dateCheckin" />
                </li>
                <li class="col-span-1">
                    <x-input-primary type="datetime-local" position="right" title="Check Out" name="dateCheckout" />
                </li>
                <li class="col-span-1">
                    <x-input-primary iconLink="assets/icons/user.svg" position="left" title="Guests" placeholder="2" name="guests" />
                </li>
            </ul>
            <div class="flex justify-end">
                <button class="mt-3 py-3 px-4 bg-mint-green rounded-md flex items-center gap-1.5 font-medium max-w-fit">
                    <img src="{{asset('assets/icons/building-line.svg')}}" alt="" class="w-6 h-7">
                    Show Places
                </button>
            </div>
        </form>
    </div>

    @auth
        @if(isset($searchHistories) && count($searchHistories) > 0)
            <x-block 
                title="Your recent searches" 
                blocks="{{ json_encode($searchHistories) }}"
            >
                <div class="grid grid-cols-4 gap-4">
                    @foreach($searchHistories as $hotel)
                        @if($loop->index <= 3) 
                            <div class="col-span-1" >
                                <div class="flex bg-slate-200 rounded-lg p-2 items-center gap-2.5">
                                    <img src="{{ asset($hotel['image']) }}" alt="" class="object-center object-cover rounded-lg w-20 h-20">
                                    <div>
                                        <p class="font-medium line-clamp-2">{{ $hotel['name'] }}</p>
                                        <p class="text-sm line-clamp-1">{{ $hotel['location'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </x-block>
        @endif
    @endauth

    @foreach ($listBlockRender as $block)
        <x-block 
            title="{{ $block['blockName'] }}" 
            desc="{{ $block['blockDesc'] }}"
            blocks="{{ json_encode($block) }}"
        >
            <div class="grid grid-cols-4 gap-4">
                @foreach($block['hotels'] as $hotel)
                    @if($loop->index <=3)
                    <div 
                        class="relative h-[420px] col-span-1 bg-no-repeat bg-cover bg-center rounded-xl" 
                        style="background-image: url('{{ asset($hotel['image']) }}')"
                    >
                        <div class="absolute bottom-0 py-4 text-white font-poppins w-full px-3 bg-detail-block">
                            <div class="flex flex-wrap items-center justify-between w-full">
                                <div class="basis-full">
                                    <h3 class="text-2xl leading-tight font-medium line-clamp-1">{{ $hotel['hotelName'] }}</h3>
                                    <span class="text-sm">{{ $hotel['location'] }}</span>
                                </div>
                                <p class="text-2xl w-full text-right font-semibold">{{ $hotel['price'] }} VND</p>
                            </div>
                            <button class="mt-3 w-full bg-mint-green py-2.5 text-gray-800 rounded-lg font-medium">
                                <a href="{{ route('hotelsDetail', ['id' => $hotel['hotelId']]) }}">
                                    Book a hotel
                                </a>        
                            </button>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </x-block>
    @endforeach

    @if(isset($hotelTop))
        <x-block title="Fall into travel" desc="Going somewhere to celebrate this season? Whether you’re going home or somewhere to roam, we’ve got the travel tools to get you to your destination.">
            <div class="grid grid-cols-4 grid-rows-2 gap-5 h-[550px] rounded-lg overflow-hidden">
                <div class="col-start-1 col-end-3 bg-mint-green row-span-2 p-5 rounded-xl flex flex-col">
                    <div class="flex items-start justify-between">
                        <h2 class="text-5xl text-gray-800 basis-2/5 leading-tight font-semibold flex-1">{{ $hotelTop->name }}</h2>
                        <p class="max-h-fit bg-white rounded-lg py-1 px-4">From <br /> <strong>{{$hotelTop->cast}} VND</strong> </p>
                    </div>
                    <div class="flex-1 mt-1.5">
                        <p class="line-clamp-[8]">{{ $hotelTop->description }}</p>
                    </div>
                    <button class="w-full bg-white py-2.5 rounded-md">
                        <a href="{{ route('hotelsDetail', ['id' => $hotelTop->id]) }}">
                            Book now
                        </a>
                    </button>
                </div>
                @foreach($hotelTop->imgs as $img)
                    @if($loop->index < 4)
                        <div class="col-span-1 row-span-1">
                            <img src="{{ asset($img) }}" alt="" class="w-full h-full">
                        </div>
                    @endif
                @endforeach
            </div>
        </x-block>
    @endif

    
</x-app-layout>
