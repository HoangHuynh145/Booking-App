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
        <h2 class="pb-4 pt-6 px-4 text-lg font-medium font-epilogue">Where are you flyings?</h2>
        <form action="" class="pt-2.5 pb-5 px-4">
            <ul class="grid grid-cols-4 gap-3">
                <li class="col-span-1">
                    <x-input-primary iconLink="assets/icons/bed-fill.svg" position="left" value="Isanbul, Turkey" />
                </li>
                <li class="col-span-1">
                    <x-input-primary iconLink="assets/icons/stack-money.svg" position="right" value="Isanbul, Turkey" />
                </li>
                <li class="col-span-1">
                    <x-input-primary iconLink="assets/icons/stack-money.svg" position="right" value="Isanbul, Turkey" />
                </li>
                <li class="col-span-1">
                    <x-input-primary iconLink="assets/icons/user.svg" position="left" value="Isanbul, Turkey" />
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

    <x-block 
        title="Fall into travel" 
    >
        <div class="grid grid-cols-4 gap-4">
            @foreach([1, 2, 3, 4] as $item)
                <div class="col-span-1">
                    <div class="flex bg-slate-100 rounded-md p-2 items-center gap-2">
                        <img src="{{ asset('assets/imgs/small-test-img-2.png') }}" alt="">
                        <div>
                            <p class="font-medium">Istanbul, Turkey</p>
                            <p class="text-sm">325 places</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-block>

    <x-block 
        title="Fall into travel" 
        desc="Going somewhere to celebrate this season? Whether you’re going home or somewhere to roam, we’ve got the travel tools to get you to your destination."
    >
        <div class="grid grid-cols-4 gap-4">
            @foreach([1,2,3,4] as $step)
            <div class="relative h-[420px] col-span-1 bg-no-repeat bg-cover bg-center rounded-xl" style="background-image: url(assets/imgs/test-img.png)">
                <div class="absolute bottom-3 text-white font-poppins w-full px-3">
                    <div class="flex items-center justify-between w-full">
                        <div>
                            <h3 class="text-2xl leading-tight font-medium">Melbourne</h3>
                            <span class="text-sm">An amazing journey</span>
                        </div>
                        <p class="text-2xl font-semibold">$ 700</p>
                    </div>
                    <button class="mt-3 w-full bg-mint-green py-2.5 text-gray-800 rounded-lg font-medium">Book a hotel</button>
                </div>
            </div>
            @endforeach
        </div>
    </x-block>

    <x-block 
        title="Fall into travel" 
        desc="Going somewhere to celebrate this season? Whether you’re going home or somewhere to roam, we’ve got the travel tools to get you to your destination."
    >
        <div class="grid grid-cols-4 grid-rows-2 gap-5">
            <div class="col-start-1 col-end-3 bg-mint-green row-span-2 p-5 rounded-xl flex flex-col">
                <div class="flex items-start justify-between">
                    <h2 class="text-5xl text-gray-800 basis-2/5 leading-tight font-semibold" >Backpacking Sri Lanka</h2>
                    <p class="max-h-fit bg-white rounded-lg py-1 px-4">From <br /> <strong>$700</strong> </p>
                </div>
                <p class="flex-1">Traveling is a unique experience as it's the best way to unplug from the pushes and pulls of daily life. It helps us to forget about our problems, frustrations, and fears at home. During our journey, we experience life in different ways. We explore new places, cultures, cuisines, traditions, and ways of living.</p>
                <button class="w-full bg-white py-2.5 rounded-md">Book flight</button>
            </div>
            <div class="col-span-1 row-span-1">
                <img src="{{ asset('assets/imgs/small-test-img.png') }}" alt="" class="w-full h-full">
            </div>
            <div class="col-span-1 row-span-1">
                <img src="{{ asset('assets/imgs/small-test-img.png') }}" alt="" class="w-full h-full">
            </div>
            <div class="col-span-1 row-span-1">
                <img src="{{ asset('assets/imgs/small-test-img.png') }}" alt="" class="w-full h-full">
            </div>
            <div class="col-span-1 row-span-1">
                <img src="{{ asset('assets/imgs/small-test-img.png') }}" alt="" class="w-full h-full">
            </div>
        </div>
    </x-block>
</x-app-layout>