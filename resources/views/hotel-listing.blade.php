<x-app-layout>
    <form action="{{ route('listHotel') }}" method="GET" class="container mx-auto mb-16 " id="form-filter">
        @csrf
        <div class="my-10">
            <div class="bg-white rounded-2xl py-8 px-5 shadow-black/10 shadow-lg flex items-center gap-3">
                <ul class="grid grid-cols-4 gap-3 flex-1">
                    <li class="col-span-1">
                        <x-input-primary 
                            iconLink="assets/icons/bed-fill.svg" 
                            position="left" 
                            title="Enter Destination" 
                            placeholder="Đà Nẵng" 
                            name="location"
                            value="{{ $location }}"
                        />
                    </li>
                    <li class="col-span-1">
                        <x-input-primary 
                            type="datetime-local" 
                            position="right" 
                            title="Check In" 
                            name="dateCheckin" 
                            value="{{ $dateCheckin ?? '' }}"
                        />
                    </li>
                    <li class="col-span-1">
                        <x-input-primary 
                            type="datetime-local" 
                            position="right" 
                            title="Check Out" 
                            name="dateCheckout" 
                            value="{{ $dateCheckout ?? '' }}"
                        />
                    </li>
                    <li class="col-span-1">
                        <x-input-primary 
                            iconLink="assets/icons/user.svg" 
                            position="left" 
                            title="Guests" 
                            placeholder="2" 
                            name="guests"
                            value="{{ $guests }}"
                        />
                    </li>
                </ul>
                <button type="submit" class="bg-mint-green rounded-lg h-14 w-14 flex-center">
                    <img src="{{ asset('assets/icons/search.svg') }}" width="24px" height="24px" />
                </button>
            </div>
        </div>

        <div class="grid grid-cols-4">
            <div class="col-span-1">
                @include('partials.filter-hotel')
            </div>
            <div class="col-span-3 pl-6 ml-6 border-l border-slate-800 ">
                @include('partials.list-hotel')
            </div>
        </div>
    </form>
</x-app-layout>