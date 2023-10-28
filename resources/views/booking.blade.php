<x-app-layout>
    <div class="container mx-auto pt-20 mb-16">
        <div class="flex justify-between gap-10">
            <div class="basis-3/5 flex flex-col space-y-10">
                <div class="bg-white py-8 px-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-2xl font-medium mr-4 max-w-md">Superior room - 1 double bed or 2 twin beds</p>
                        <h2 class="text-2xl mb-2 font-semibold text-salmon">$240/night</h2>
                    </div>
                    <div class="mb-11 py-4 px-6 rounded-lg border border-mint-green flex gap-6">
                        <img src="https://scontent.fdad1-2.fna.fbcdn.net/v/t39.30808-6/290517103_554115006135388_8961713606418862698_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=5f2048&_nc_ohc=WN-BPSRhhTUAX8sD7lr&_nc_ht=scontent.fdad1-2.fna&oh=00_AfCGUBDRC4b38ZwN2rycjCYX9i1JKlg-cyDKH741aJQoPw&oe=6539656D" alt="" width="63" height="63" class="rounded-lg">
                        <div>
                            <h1 class="text-2xl font-semibold">CVK Park Bosphorus Hotel Istanbul</h1>
                            <div class="flex items-center text-sm ">
                                <i><x-icons.location /></i>
                                <p>Gümüssuyu Mah. Inönü Cad. No:8, Istanbul 34437</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-medium mb-2">Thursday, Dec 8</h3>
                            <span class="text-[#112211]/80 font-medium text-sm">Check-In</span>
                        </div>

                        <div class="relative max-w-fit after:absolute after:cricle-left after:w-2.5 after:h-2.5 after:bg-black after:rounded-full after:top-1/2 after:-translate-y-1/2 before:absolute before:cricle-right before:w-2.5 before:h-2.5 before:bg-black before:rounded-full before:top-1/2 before:-translate-y-1/2">
                            <div class="absolute w-14 h-px bg-black right-full top-1/2 -translate-y-1/2"></div>
                            <i><x-icons.buildings /></i>
                            <div class="absolute w-14 h-px bg-black left-full top-1/2 -translate-y-1/2"></div>
                        </div>

                        <div>
                            <h3 class="text-2xl font-medium mb-2">Friday, Dec 9</h3>
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
                        <input type="radio" name="payment_type" id="" class="w-5 h-5 border-white " />
                    </li>
                    <li class="flex justify-between items-center p-4 rounded-lg  gap-11 ">
                        <div>
                            <p class="text-base font-medium mb-1.5">Pay part now, part later</p>
                            <span class="text-sm">Pay $207.43 now, and the rest ($207.43) will be automatically charged to the same payment method on Nov 14, 2022. No extra fees.</span>
                        </div>
                        <input type="radio" name="payment_type" id="" class="w-5 h-5 border-white " />
                    </li>
                </ul>

                <div class="bg-white py-8 px-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-between gap-8 p-4 rounded-lg bg-mint-green">
                        <i><x-icons.visa /></i>
                        <p class="flex-1 text-left text-sm font-epilogue">
                            <span class="font-medium">***</span>
                            <span class="font-medium">4321</span>
                            <span>02/07</span>
                        </p>
                        <input type="radio" name="card_select" id="" class="w-5 h-5 border-white " />
                    </div>

                    <div class="mt-4 py-4 px-6 h-48 border-2 border-dashed border-mint-green rounded-lg flex-center cursor-pointer" x-data="" @click="$dispatch('open-modal', 'add-card')">
                        <div class="flex-col flex-center">
                            <div class="w-12 h-12 rounded-full border-2 border-mint-green relative after:absolute after:left-1/2 after:-translate-x-1/2 after:w-3/5 after:h-0.5 after:rounded-full after:bg-mint-green after:top-1/2 after:-translate-y-1/2 before:absolute before:left-1/2 before:-translate-x-1/2 before:rounded-full before:w-0.5 before:h-3/5 before:bg-mint-green before:top-1/2 before:-translate-y-1/2">
                            </div>
                            <p class="mt-2.5">Add a new card</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white py-8 px-6 rounded-lg shadow-md space-y-4">
                    <p class="text-3xl font-semibold font-epilogue ">Login or Sign up to book</p>
                    <!-- <input type="text" class="w-full py-2 px-4 border border-[#79747E] rounded-lg h-14" placeholder="Phone number" />
                    <input type="text" class="w-full py-2 px-4 border border-[#79747E] rounded-lg h-14" placeholder="Password" />
                    <p class="text-sm">We’ll call or text you to confirm your number. Standard message and data rates apply. Privacy Policy</p> -->
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
            </div>

            <div class="basis-2/5">
                <div class="p-6 bg-white rounded-lg">
                    <div class="flex gap-6">
                        <img src="https://scontent.fdad1-2.fna.fbcdn.net/v/t39.30808-6/290517103_554115006135388_8961713606418862698_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=5f2048&_nc_ohc=WN-BPSRhhTUAX8sD7lr&_nc_ht=scontent.fdad1-2.fna&oh=00_AfCGUBDRC4b38ZwN2rycjCYX9i1JKlg-cyDKH741aJQoPw&oe=6539656D" alt="" class="w-32 h-32 rounded-lg object-cover object-center" />
                        <div>
                            <p class="text-base line-clamp-1">CVK Park Bosphorus Hotel Istanbul</p>
                            <h3 class="text-xl font-medium">Superior room - 1 double bed or 2 twin beds</h3>
                            <div class="mt-4 flex items-center gap-2">
                                <span class="rounded-lg border border-mint-green flex-center w-10 h-8 text-sm font-medium cursor-pointer">4.2</span>
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
                            <span class="font-medium">$240</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Discount</span>
                            <span class="font-medium">$0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Taxes</span>
                            <span class="font-medium">$20</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Service Fee</span>
                            <span class="font-medium">$5</span>
                        </div>
                        <div class="pt-4 border-t border-slate-800 flex justify-between items-center">
                            <span>Total</span>
                            <span class="font-medium">$265</span>
                        </div>
                    </div>
                </div>
                <button class="mt-5 w-full h-12 py-3.5 bg-mint-green rounded-lg leading-none">
                    Submit
                </button>
            </div>
        </div>
    </div>
    <x-modal name="add-card" :show="false" x-data="">
        <div class="p-8">
            <div 
                class="text-2xl cursor-pointer text-right"
                @click="$dispatch('close-modal')"
            >&times;</div>
            <div class="font-epilogue space-y-6">
                <h3 class="text-4xl font-semibold mb-12">Add a new Card</h3>

                <div class="space-y-7">
                    <x-input-primary value="Card Number" />
                    <div class="flex gap-7">
                        <x-input-primary value="Card Number" />
                        <x-input-primary value="Card Number" />
                    </div>
                    <x-input-primary value="Card Number" />
                    <x-input-primary value="Card Number" />
                </div>

                <button class="w-full h-12 py-3.5 bg-mint-green rounded-lg leading-none">
                    Add Card
                </button>
            </div>
        </div>
        <!-- <span @click="$dispatch('close-modal')" >Close</span> -->
    </x-modal>
</x-app-layout>