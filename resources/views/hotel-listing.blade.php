<x-app-layout>
    <div class="container mx-auto mb-16">
        <div class="my-10">
            <div class="bg-white rounded-2xl py-8 px-5 shadow-black/10 shadow-lg flex items-center gap-3">
                <ul class="grid grid-cols-4 gap-3 flex-1">
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
                <button class="bg-mint-green rounded-lg h-14 w-14 flex-center">
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
    </div>
</x-app-layout>