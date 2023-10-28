<div class="container mx-auto px-1">
    <div class="h-20">
        <ul class="flex h-full w-full items-center my-auto">
            <li class="flex-1">
                <img src="{{ asset('assets/imgs/Logo.png') }}" class="mx-auto" />
            </li>
            <li>
                <x-primary-button additionClass="border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white">
                    <a href="{{ route('login') }}">Login</a>
                </x-primary-button>
                <x-primary-button additionClass="bg-gray-800 text-white border-gray-800 hover:bg-transparent hover:text-gray-800">
                    <a href="{{ route('register') }}">Sign up</a>
                </x-primary-button>
            </li>
        </ul>
    </div>
</div>