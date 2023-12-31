<div>
    <ul class="bg-white shadow-md rounded-xl px-6 py-4  w-full grid grid-cols-5">
        @for($i = 5; $i > 0; $i--)
            <li class="col-span-1 {{ $i !== 1 ? 'border-r' : '' }} border-slate-700 ml-12">
                <h3 class="text-base font-medium">{{ $i }} Stars</h3>
                <span class="text-sm text-slate-400/80"> {{ $countStar[$i] }} Places</span>
            </li>
        @endfor
    </ul>

    <div class="my-8 flex justify-between items-center">
        <p class="text-black text-base font-medium">Showing {{ count($hotels) }} of <span class="text-[#FF8682]">{{ $countHotels }} places</span></p>
        <div
            x-data="{
                show: false
            }"
        >
            Sort by
            <div class="relative inline-block text-left">
                <div>
                    <button type="button" class="inline-flex w-full justify-center capitalize gap-x-1.5 rounded-md py-2 text-base font-semibold text-gray-900" id="menu-button" aria-expanded="true" aria-haspopup="true" x-on:click="show = !show">
                    {{ $sortType }}
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" x-show="show">
                    <ul class="py-1" role="none">
                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                        <li 
                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" 
                            role="menuitem" 
                            tabindex="-1"
                            id="menu-item-0"
                            data-value="latest"
                            onclick="handleSelectSort('latest')"
                        >
                            Latest
                        </li>
                        <li 
                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" 
                            role="menuitem" 
                            tabindex="-1" 
                            id="menu-item-1"
                            data-value="cheapest"
                            onclick="handleSelectSort('cheapest')"
                        >
                            Cheapest
                        </li>
                        <li 
                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" 
                            role="menuitem" 
                            tabindex="-1" 
                            id="menu-item-2"
                            data-value="reviews"
                            onclick="handleSelectSort('reviews')"
                        >
                            Number of reviews
                        </li>
                    </ul>
                </div>
                <input type="text" name="sortType" hidden />
            </div>
        </div>
    </div>

    <ul>
        @foreach($hotels as $hotel)
            <li>
                <x-hotel-card :hotel="$hotel" :dateCheckin="$dateCheckin" :dateCheckout="$dateCheckout" />
            </li>
        @endforeach
        <!-- <li class="w-full bg-black text-white h-12 flex-center rounded-lg">
            Show more results
        </li> -->
    </ul>
</div>


<script>
    const formFilter = document.getElementById('form-filter')
    
    const handleSelectSort = (typeSort) =>{
        const inputElement = document.querySelector('input[name="sortType"]');
        inputElement.value = typeSort
        formFilter.submit()
    }

</script>