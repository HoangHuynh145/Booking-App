<x-profile-layout>
    <h2 class="font-semibold text-3xl font-epilogue">Orders</h2>
    @include('partials.notification')
    <ul class="mt-5 space-y-4">
        @foreach($listOrder as $order)
        <li class="flex items-center rounded-lg px-6 py-8 bg-white shadow-lg">
            <img src="{{ asset($order['image']) }}" alt="" class="w-20 h-20 rounded-lg">

            <div class="flex items-center gap-4 text-lg mx-8 pr-8 border-r-2 border-slate-500/50">
                <div>
                    <p>Check-In</p>
                    <strong class="mt-2">{{ $order['checkInDay'] }}</strong>
                </div>
                <div class="w-8 h-0.5 bg-black"></div>
                <div>
                    <p>Check-Out</p>
                    <strong class="mt-2">{{ $order['checkOutDay'] }}</strong>
                </div>
            </div>

            <ul class="grid grid-cols-2 grid-rows-2 gap-y-2 gap-x-6">
                <li class="flex items-center gap-2 col-span-1 row-span-1">
                    <div class="w-8 h-8 rounded-lg bg-mint-green/20 flex-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                            <path fill="rgb(141, 211, 187)" d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24Zm56 112h-56a8 8 0 0 1-8-8V72a8 8 0 0 1 16 0v48h48a8 8 0 0 1 0 16Z" />
                        </svg>
                    </div>
                    <div class="text-sm">
                        <p class="font-semibold text-gray-400">Check-in Time</p>
                        <span class="font-medium">{{ $order['checkInTime'] }}</span>
                    </div>
                </li>
                <li class="flex items-center gap-2 col-span-1 row-span-1">
                    <div class="w-8 h-8 rounded-lg bg-mint-green/20 flex-center">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="rgb(141, 211, 187)" d="M4 21q-.425 0-.713-.288T3 20q0-.425.288-.713T4 19h1V5q0-.825.588-1.413T7 3h10q.825 0 1.413.588T19 5v14h1q.425 0 .713.288T21 20q0 .425-.288.713T20 21H4Zm13-2V5h-4.5V3.9q1.1.2 1.8 1.025T15 6.85v11.1q0 .725-.475 1.288t-1.2.687V19H17Zm-6-6q.425 0 .713-.288T12 12q0-.425-.288-.713T11 11q-.425 0-.713.288T10 12q0 .425.288.713T11 13Z" />
                        </svg>
                    </div>
                    <div class="text-sm">
                        <p class="font-semibold text-gray-400">Check-out Time</p>
                        <span class="font-medium">On arrival</span>
                    </div>
                </li>
                <li class="flex items-center gap-2 col-span-1 row-span-1">
                    <div class="w-8 h-8 rounded-lg bg-mint-green/20 flex-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                            <path fill="rgb(141, 211, 187)" d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24Zm56 112h-56a8 8 0 0 1-8-8V72a8 8 0 0 1 16 0v48h48a8 8 0 0 1 0 16Z" />
                        </svg>
                    </div>
                    <div class="text-sm">
                        <p class="font-semibold text-gray-400">Check-out Time</p>
                        <span class="font-medium">{{ $order['checkOutTime'] }}</span>
                    </div>
                </li>
            </ul>

            <div class="flex-1 text-right mr-16 flex gap-3 justify-end items-center">
                <button class="px-4 py-2 border border-mint-green rounded leading-tight font-medium text-base text-mint-green">
                    {{ number_format($order['totalPayment'] / 1000, 3) }}đ
                </button>
                <a href="{{ route('hotelsDetail', ['id' => $order['hotelId'], 'acceptReview' => true]) }}">
                    <button class="px-4 py-2 border bg-mint-green rounded leading-tight font-medium text-base text-white">
                        >
                    </button>
                </a>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="mt-4 flex justify-end">
        <div class="demo-inline-spacing">
            <!-- Outline rounded Pagination -->
            <nav aria-label="Page navigation">
                {{ $orders->render('admin.partials.paging') }}
            </nav>
            <!--/ Outline rounded Pagination -->
        </div>
    </div>
</x-profile-layout>