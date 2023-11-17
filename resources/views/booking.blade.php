<x-app-layout>
    <form action="{{ route('orders.store') }}" method="post" class="container mx-auto pt-20 mb-16">
        @csrf
        <div class="flex justify-between gap-10">
            <div class="basis-3/5 flex flex-col space-y-10">
                <div class="bg-white py-8 px-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-2xl font-medium mr-4 max-w-md">
                            {{ $typeRoom->name }}
                        </p>
                        <h2 class="text-2xl font-semibold text-salmon">
                            {{ number_format($typeRoom->price / 1000, 3) }}đ/night
                        </h2>
                    </div>
                    <div class="mb-11 py-4 px-6 rounded-lg border border-mint-green flex gap-6">
                        <img src="{{ asset($typeRoom->image) }}" alt="" width="63" height="63" class="rounded-lg">
                        <div>
                            <h1 class="text-2xl font-semibold">{{ $hotel->name }}</h1>
                            <div class="flex items-center text-sm ">
                                <i><x-icons.location /></i>
                                <p>{{ $hotel->location }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-medium mb-2">{{ $orderInfo['checkin'] }}</h3>
                            <span class="text-[#112211]/80 font-medium text-sm">Check-In</span>
                        </div>
                        <div class="relative max-w-fit after:absolute after:cricle-left after:w-2.5 after:h-2.5 after:bg-black after:rounded-full after:top-1/2 after:-translate-y-1/2 before:absolute before:cricle-right before:w-2.5 before:h-2.5 before:bg-black before:rounded-full before:top-1/2 before:-translate-y-1/2">
                            <div class="absolute w-14 h-px bg-black right-full top-1/2 -translate-y-1/2"></div>
                            <i><x-icons.buildings /></i>
                            <div class="absolute w-14 h-px bg-black left-full top-1/2 -translate-y-1/2"></div>
                        </div>

                        <div>
                            <h3 class="text-2xl font-medium mb-2">{{ $orderInfo['checkout'] }}</h3>
                            <span class="text-[#112211]/80 font-medium text-sm">Check-Out</span>
                        </div>
                    </div>
                </div>

                <ul class="bg-white py-8 px-6 rounded-lg shadow-md">
                    <li class="flex justify-between items-center p-4 rounded-lg bg-mint-green gap-11 ">
                        <div>
                            <p class="text-base font-medium mb-1.5">Pay in Full</p>
                            <span class="text-sm">Pay the total and you are all set</span>
                        </div>
                        <input type="radio" name="payment_type" value="payFull" class="w-5 h-5 border-white " checked="checked" />
                    </li>
                </ul>

                @auth
                    <div class="bg-white py-8 px-6 rounded-lg shadow-md">
                        <div class="space-y-3">
                            @foreach($cardInfo as $item)
                            <div class="flex items-center justify-between gap-5 p-4 rounded-lg bg-mint-green">
                                <i><x-icons.visa /></i>
                                <div class="flex-1 flex items-center text-left font-epilogue">
                                    <p class="font-medium mr-3">{{ $item['cardNumber'] }}</p>
                                    <p>{{ $item['expDate'] }}</p>
                                </div>
                                <input type="radio" name="card_select" value="{{ $item['id'] }}" class="w-5 h-5 border-white" {{ $loop->index == 0 ? 'checked' : '' }} />
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4 py-4 px-6 h-48 border-2 border-dashed border-mint-green rounded-lg flex-center cursor-pointer" x-data="" @click="$dispatch('open-modal', 'add-card')">
                            <div class="flex-col flex-center">
                                <div class="w-12 h-12 rounded-full border-2 border-mint-green relative after:absolute after:left-1/2 after:-translate-x-1/2 after:w-3/5 after:h-0.5 after:rounded-full after:bg-mint-green after:top-1/2 after:-translate-y-1/2 before:absolute before:left-1/2 before:-translate-x-1/2 before:rounded-full before:w-0.5 before:h-3/5 before:bg-mint-green before:top-1/2 before:-translate-y-1/2">
                                </div>
                                <p class="mt-2.5">Add a new card</p>
                            </div>
                        </div>
                    </div>
                @endauth

                @guest
                <div class="bg-white py-8 px-6 rounded-lg shadow-md space-y-4">
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

            <div class="basis-2/5">
                <div class="p-6 bg-white rounded-lg">
                    <div class="flex gap-6">
                        <img src="{{ asset($typeRoom->image) }}" alt="" class="w-32 h-32 rounded-lg object-cover object-center" />
                        <div>
                            <p class="text-base line-clamp-1">{{ $hotel->name }}</p>
                            <h3 class="text-xl font-medium">{{ $typeRoom->name }}</h3>
                            <div class="mt-4 flex items-center gap-2">
                                <span class="rounded-lg border border-mint-green flex-center w-10 h-8 text-sm font-medium cursor-pointer">
                                    {{ $hotel->stars }}
                                </span>
                                <p class="font-semibold">Very good</p>
                            </div>
                        </div>
                    </div>
                    <p class="py-4 my-4 border-y border-slate-800">
                        Your booking is protected by <strong>golobe</strong>
                    </p>
                    <div class="space-y-4">
                        <h3 class="text-base font-medium">Price Details</h3>
                        <div class="flex justify-between items-center">
                            <span>Base Fare</span>
                            <span class="font-medium">{{ number_format($orderInfo['payment'] / 1000, 3) }}đ</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Discount</span>
                            <span class="font-medium">0đ</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Taxes</span>
                            <span class="font-medium">{{ number_format(20000 / 1000, 3) }}đ</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Service Fee</span>
                            <span class="font-medium">{{ number_format(5000 / 1000, 3) }}đ</span>
                        </div>
                        <div class="pt-4 border-t border-slate-800 flex justify-between items-center">
                            <span>Total</span>
                            <span class="font-medium">{{ number_format(($orderInfo['payment'] + 25000) / 1000, 3) }}đ</span>
                        </div>
                    </div>
                </div>
                <button class="mt-5 w-full h-12 py-3.5 bg-mint-green rounded-lg leading-none">
                    Book Now
                </button>
            </div>

            <input type="hidden" name="hotel" value="{{ $typeRoom->id }}" >
            <input type="hidden" name="hotelName" value="{{ $hotel->name }}" >
            <input type="hidden" name="price" value="{{ $typeRoom->price }}" >
            <input type="hidden" name="tax" value="20" >
            <input type="hidden" name="totalPayment" value="{{ $orderInfo['payment'] + 20 + 5 }}" >
            <input type="hidden" name="checkInTime" value="{{ $orderInfo['rawCheckin'] }}" >
            <input type="hidden" name="checkOutTime" value="{{ $orderInfo['rawCheckout'] }}" >
        </div>
    </form>

    @include('partials.notification')

    <x-modal name="add-card" :show="false" x-data="">
        <div class="p-8">
            <div class="text-2xl cursor-pointer text-right" @click="$dispatch('close-modal')">&times;</div>
            <div class="font-epilogue space-y-6">
                <h3 class="text-4xl font-semibold mb-12">Add a new Card</h3>
                <form action="{{ route('paymentInformation.store') }}" method="POST">
                    @csrf
                    <div class="space-y-7">
                        <x-input-primary title="Card Number" name="cardNumber" />
                        <div class="flex gap-7">
                            <x-input-primary title="Exp. Date" name="expDate" type="date" />
                            <x-input-primary title="CVC" name="CVC" />
                        </div>
                        <x-input-primary title="Name on Card" name="nameOnCard" />
                        <x-input-primary title="Country or Region" name="country" />
                        <input type="hidden" name="hotelId" value="{{ $hotel->id }}" />
                        <input type="hidden" name="typeRoomId" value="{{ $typeRoom->id }}" />
                    </div>

                    <button type="submit" class="w-full mt-4 h-12 py-3.5 bg-mint-green rounded-lg leading-none">
                        Add Card
                    </button>
                </form>
            </div>
        </div>
        <!-- <span @click="$dispatch('close-modal')" >Close</span> -->
    </x-modal>
</x-app-layout>
