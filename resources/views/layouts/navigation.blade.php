@php
$user = session('user');
@endphp

<div class="container mx-auto px-1">
    <div class="h-20">
        <ul class="flex h-full w-full items-center my-auto">
            <li class="flex-1">
                <img src="{{ asset('assets/imgs/Logo.png') }}" class="mx-auto" />
            </li>
            @guest()
            <li>
                <x-primary-button additionClass="border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white">
                    <a href="{{ route('login') }}">Login</a>
                </x-primary-button>
                <x-primary-button additionClass="bg-gray-800 text-white border-gray-800 hover:bg-transparent hover:text-gray-800">
                    <a href="{{ route('register') }}">Sign up</a>
                </x-primary-button>
            </li>
            @endguest

            @auth()
            <li class="group relative">
                <div class="py-2 px-5 border border-slate-500 text-sm font-medium leading-none flex items-center cursor-pointer">
                    Xin chào, {{ $user->fullName }}
                    <x-icons.angle-down />
                </div>
                <div class="absolute pt-4 opacity-0 group-hover:opacity-100 top-full right-1/2 translate-x-1/2 z-40 transition-opacity duration-500">
                    <ul class="w-64 bg-white shadow-lg shadow-black/20 border border-black/50 ">
                        <li class="py-2 px-6 text-sm mt-2.5 h-10">
                            <a href="#" class="cursor-pointer">Truy Cập Admin Dashboard</a>
                        </li>
                        <li class="py-2 px-6 text-sm h-10">
                            <a href="{{ route('logout') }}" class="cursor-pointer">Đăng xuất</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endauth
        </ul>
    </div>
</div>