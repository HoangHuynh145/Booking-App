@php
$user = session('user');
@endphp

<x-app-layout>
    <a href="/" class="flex-center justify-start cursor-pointer mx-10 mt-4 gap-2">
        <span><</span>
        <span class="text-base">Home</span>
    </a>
    <div class="container mx-auto pt-20 mb-16">
        <div class="flex justify-between items-end mb-8">
            <div>
                <div class="flex items-center mb-4">
                    <p class="text-xl font-medium mr-4">{{ $hotel->name }}</p>
                    <ul class="flex items-center font-poppins my-1.5">
                        @for ($i = 1; $i <= 5; $i++) <li class="{{ $hotel->level >= $i ? '' : 'invisible' }}">
                            <x-icons.star-fill color="#FF8682" />
                            </li>
                            @endfor
                            <li class="leading-none mt-1 ml-1">
                                {{ $hotel->level }} star hotel
                            </li>
                    </ul>
                </div>
                <p class="flex text-sm"><x-icons.location /> {{ $hotel->location }}</p>
                <div class="flex items-center mt-1.5 gap-1 font-poppins">
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
            </div>
            <div>
                @auth
                    <div class="flex items-center justify-between gap-4">
                        @if(isset($wishListId))
                            <form action="{{ route('wishlist.destroy', ['wishlist' => $wishListId]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg border bg-mint-green flex-center w-20 h-12 text-sm font-medium cursor-pointer">
                                    <x-icons.heart color="#fff" />
                                </button>
                                <input type="hidden" name="hotelId" value="{{ $hotel->id }}" />
                            </form>
                        @else
                            <form action="{{ route('wishlist.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-lg border border-mint-green flex-center w-20 h-12 text-sm font-medium cursor-pointer">
                                    <x-icons.heart-outline />
                                </button>
                                <input type="hidden" name="hotelId" value="{{ $hotel->id }}" />
                            </form>
                        @endif
                    </div>
                @endauth
            </div>
        </div>

        <ul class="grid grid-cols-4 h-[550px] gap-2 rounded-xl overflow-hidden">
            @foreach($rooms as $room)
            <li class="first:col-span-2 first:row-span-2 col-auto row-auto overflow-hidden">
                <img src="{{ asset($room->image) }}" alt="" class="w-full h-full object-cover object-center">
            </li>
            @endforeach
        </ul>

        <div class="mt-6 py-10 border-t border-slate-800">
            <h3 class="text-base font-medium">Overview</h3>
            <p class="my-6">{{ $hotel->description }}</p>
            <div class="border border-mint-green rounded-lg bg-mint-green text-black font-epilogue p-4 pr-10 max-w-fit min-w-[144px]">
                <h3 class="text-2xl font-semibold mb-8">{{ $hotel->stars }}</h3>
                <span>
                    @if($hotel->stars == 0)
                        Waiting for reviews
                    @elseif($hotel->stars >= 1 && $hotel->stars < 2)
                        Awful
                    @elseif($hotel->stars < 3)
                        Mediocre
                    @elseif($hotel->stars < 4)
                        Good
                    @elseif($hotel->stars <= 5)
                        Very Good
                    @elseif($hotel->stars == 5)
                        Excellent
                    @endif
                </span>
            </div>
        </div>

        @auth()
            @if(isset($acceptReview) && $acceptReview == true)
                <div class=" py-10 border-t border-slate-800">
                    <form action="{{ route('rating', ['id' => $hotel->id])}}" method="POST">
                        @csrf
                        <ul class="flex items-center justify-start gap-4">
                            <li class="group-rating border {{ $ratingValue == 1 ? 'active' : '' }} border-mint-green rounded-lg text-black font-epilogue p-4 w-36 cursor-pointer hover:bg-mint-green" onclick="handleRating(event, 1)">
                                <img src="{{asset('assets/icons/Stars.png')}}" alt="" class="mb-8">
                                <span>Awful</span>
                                <input type="radio" name="rating" value="1" hidden id="rating1" {{ $ratingValue == 1 ? 'checked' : '' }} />
                            </li>
                            <li class="group-rating border {{ $ratingValue == 2 ? 'active' : '' }} border-mint-green rounded-lg text-black font-epilogue p-4 w-36 cursor-pointer hover:bg-mint-green" onclick="handleRating(event, 3)">
                                <img src="{{asset('assets/icons/Stars.png')}}" alt="" class="mb-8">
                                <span>Mediocre</span>
                                <input type="radio" name="rating" value="2" hidden id="rating2" {{ $ratingValue == 2 ? 'checked' : '' }} />
                            </li>
                            <li class="group-rating border {{ $ratingValue == 3 ? 'active' : '' }} border-mint-green rounded-lg text-black font-epilogue p-4 w-36 cursor-pointer hover:bg-mint-green" onclick="handleRating(event, 3)">
                                <img src="{{asset('assets/icons/Stars.png')}}" alt="" class="mb-8">
                                <span>Good</span>
                                <input type="radio" name="rating" value="3" hidden id="rating3" {{ $ratingValue == 3 ? 'checked' : '' }} />
                            </li>
                            <li class="group-rating border border-mint-green rounded-lg text-black font-epilogue p-4 w-36 cursor-pointer hover:bg-mint-green {{ $ratingValue == 4 ? 'active' : '' }}" onclick="handleRating(event, 4)">
                                <img src="{{asset('assets/icons/Stars.png')}}" alt="" class="mb-8">
                                <span>Very Good</span>
                                <input type="radio" name="rating" value="4" hidden id="rating4" {{ $ratingValue == 4 ? 'checked' : '' }} />
                            </li>
                            <li class="group-rating {{ $ratingValue == 5 ? 'active' : '' }} border border-mint-green rounded-lg text-black font-epilogue p-4 w-36 cursor-pointer hover:bg-mint-green" onclick="handleRating(event, 5)">
                                <img src="{{asset('assets/icons/Stars.png')}}" alt="" class="mb-8">
                                <span>Excellent</span>
                                <input type="radio" name="rating" value="5" hidden id="rating5" {{ $ratingValue == 5 ? 'checked' : '' }} />
                            </li>
                        </ul>
                        <div class="flex justify-between items-center mt-10">
                            <div></div>
                            <button type="submit" class="text-center font-medium border border-mint-green rounded-lg bg-mint-green text-black font-epilogue p-3.5 max-w-fit">
                                Send your review
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        @endauth

        <div class="py-10 border-t border-slate-800">
            <h3 class="text-base font-medium mb-8">Available Rooms</h3>
            <ul class="grid grid-cols-1 gap-x-[300px]">
                <form action="{{ route('orders.create') }}" method="GET" id="formBooking" x-data="">
                    @foreach($rooms as $room)
                        <li class="col-span-1 flex items-center gap-4 border-b border-slate-700/30 py-4">
                            <img src="{{ asset($room->image) }}" class="w-14 h-14 rounded-lg" />
                            <p class="flex-1">{{$room->name}}</p>
                            <span class="font-medium {{ $room->available === 0 ? 'line-through' : ''}}">
                                {{ number_format($room->price / 1000, 3) }}đ/night
                            </span>
                            @if($room->available === 0)
                                <p class="text-base text-red-500 font-semibold">Sold Out</p>
                            @else
                                <button type="button" class="w-36 h-12 bg-mint-green rounded-lg font-medium" @click="$dispatch('open-modal', 'add-time-info')" onclick="handleSetBookingInfo('{{ $room->id }}', '{{ $hotel->id }}')">
                                    Book now
                                </button>
                            @endif
                        </li>
                    @endforeach
                    <input type="text" name="typeRoomId" hidden />
                    <input type="text" name="hotelId" id="bookingHotelId" hidden />
                    <input type="datetime-local" name="checkin" hidden value="{{ $dateCheckin ?? '' }}" />
                    <input type="datetime-local" name="checkout" hidden value="{{ $dateCheckout ?? '' }}" />
                </form>
            </ul>
        </div>
    </div>

    <x-modal name="add-time-info" :show="false" x-data="">
        <div class="p-8">
            <div class="text-2xl cursor-pointer text-right" @click="$dispatch('close-modal')">&times;</div>
            @auth()
                <div class="font-epilogue space-y-6">
                    <h3 class="text-4xl font-semibold mb-12">Choose how long you stay with us</h3>

                    <x-input-primary title="Check in" id="modal-checkin-input" type="datetime-local" value="{{ $dateCheckin ?? '' }}" />
                    <x-input-primary title="Check out" id="modal-checkout-input" type="datetime-local" value="{{ $dateCheckout ?? '' }}" />

                    <p id="message-error" class="text-red-500 font-medium hidden">Vui lòng kiểm tra lại thông tin ngày giờ Checkin/Checkout</p>

                    <button class="w-full h-12 py-3.5 bg-mint-green rounded-lg leading-none" onclick="handleBooking()">
                        Let's pay
                    </button>
                </div>
            @endauth
            @guest()
                <div class="py-8 px-6 space-y-4">
                    <p class="text-3xl font-semibold font-epilogue ">Login or Sign up to book</p>
                    <p class="text-sm">We need your information, so please log in or register to continue booking</p>
                    <div class="flex items-center gap-5">
                        <button class="w-full h-12 py-3.5 bg-mint-green rounded-lg leading-none">
                            Login
                        </button>
                        <span class="text-xl ">Or</span>
                        <button class="w-full h-12 py-3.5 bg-mint-green rounded-lg leading-none">
                            Sign up
                        </button>
                    </div>
                    <p class="text-sm">We’ll call or text you to confirm your number. Standard message and data rates apply. Privacy Policy</p>
                </div>
            @endguest
        </div>
    </x-modal>
</x-app-layout>

<script>
    const handleRating = (e, id) => {
        const groupActive = document.querySelector('.group-rating.active')
        const inputElement = document.getElementById(`rating${id}`)
        e.target.classList.add('active')
        groupActive.classList.remove('active')
        inputElement.checked = true
    }

    const handleBooking = () => {
        const formBooking = document.getElementById("formBooking")
        const dateCheckin = document.getElementById('modal-checkin-input').value
        const dateCheckout = document.getElementById('modal-checkout-input').value
        const messageError = document.getElementById('message-error')
        const checkInDate = new Date(dateCheckin);
        const checkOutDate = new Date(dateCheckout);

        if (checkOutDate > checkInDate) {
            // const dayDiff = Math.ceil((checkOutDate-checkInDate) / 86400000);
            // console.log({checkOutDate})
            const inputCheckin = document.querySelector('input[name="checkin"]')
            const inputCheckout = document.querySelector('input[name="checkout"]')
            inputCheckin.value = dateCheckin
            inputCheckout.value = dateCheckout
            formBooking.submit()
        } else {
            console.log('Ngày không hợp lệ');
            messageError.classList.remove('hidden')
        }

    }

    const handleSetBookingInfo = (roomId, hotelId) => {
        const inputRoom = document.querySelector('input[name="typeRoomId"]')
        const inputHotel = document.getElementById('bookingHotelId')
        inputRoom.value = roomId
        inputHotel.value = hotelId
    }
</script>