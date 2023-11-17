@php
    use Illuminate\Support\Str;
    $currentUrl = request()->url();
    $user = session('user');
@endphp

<style>
    .pagination {
        --bs-pagination-padding-x: 0.3125rem;
        --bs-pagination-padding-y: 0.469rem;
        --bs-pagination-font-size: 0.9375rem;
        --bs-pagination-color: #636578;
        --bs-pagination-bg: transparent;
        --bs-pagination-border-width: 1px;
        --bs-pagination-border-color: #d8d8dd;
        --bs-pagination-border-radius: 50%;
        --bs-pagination-hover-color: #636578;
        --bs-pagination-hover-bg: #f6f6f7;
        --bs-pagination-hover-border-color: #d8d8dd;
        --bs-pagination-focus-color: #636578;
        --bs-pagination-focus-bg: #f6f6f7;
        --bs-pagination-focus-box-shadow: none;
        --bs-pagination-active-color: #fff;
        --bs-pagination-active-bg: rgb(141, 211, 187);
        --bs-pagination-active-border-color: rgb(141, 211, 187);
        --bs-pagination-disabled-color: #bbbcc4;
        --bs-pagination-disabled-bg: #f6f6f7;
        --bs-pagination-disabled-border-color: #eaeaec;
        display: flex;
        padding-left: 0;
        list-style: none;
    }


    .page-link {
        position: relative;
        display: block;
        padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
        font-size: var(--bs-pagination-font-size);
        color: var(--bs-pagination-color);
        background-color: var(--bs-pagination-bg);
        border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    @media (prefers-reduced-motion: reduce) {
        .page-link {
            transition: none;
        }
    }

    .page-link:hover {
        z-index: 2;
        color: var(--bs-pagination-hover-color);
        background-color: var(--bs-pagination-hover-bg);
        border-color: var(--bs-pagination-hover-border-color);
    }

    .page-link:focus {
        z-index: 3;
        color: var(--bs-pagination-focus-color);
        background-color: var(--bs-pagination-focus-bg);
        outline: 0;
        box-shadow: var(--bs-pagination-focus-box-shadow);
    }

    .page-link.active,
    .active>.page-link {
        z-index: 3;
        color: var(--bs-pagination-active-color);
        background-color: var(--bs-pagination-active-bg);
        border-color: var(--bs-pagination-active-border-color);
    }

    .page-link.disabled,
    .disabled>.page-link {
        color: var(--bs-pagination-disabled-color);
        pointer-events: none;
        background-color: var(--bs-pagination-disabled-bg);
        border-color: var(--bs-pagination-disabled-border-color);
    }

    .page-item:not(:first-child) .page-link {
        margin-left: 0.344rem;
    }

    .page-item .page-link {
        border-radius: var(--bs-pagination-border-radius);
    }

    .pagination-lg {
        --bs-pagination-padding-x: 0.5rem;
        --bs-pagination-padding-y: 0.657rem;
        --bs-pagination-font-size: 1.0625rem;
        --bs-pagination-border-radius: 50%;
    }

    .pagination-sm {
        --bs-pagination-padding-x: 0.25rem;
        --bs-pagination-padding-y: 0.344rem;
        --bs-pagination-font-size: 0.8125rem;
        --bs-pagination-border-radius: 50%;
    }


    .pagination-secondary .page-item.active .page-link,
    .pagination-secondary .page-item.active .page-link:hover,
    .pagination-secondary .page-item.active .page-link:focus,
    .pagination-secondary.pagination li.active>a:not(.page-link),
    .pagination-secondary.pagination li.active>a:not(.page-link):hover,
    .pagination-secondary.pagination li.active>a:not(.page-link):focus {
        border-color: #6d788d;
        background-color: #6d788d;
        color: #fff;
    }

    .pagination-secondary .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-secondary.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0) 70%);
    }

    .pagination-outline-secondary .page-item.active .page-link,
    .pagination-outline-secondary .page-item.active .page-link:hover,
    .pagination-outline-secondary .page-item.active .page-link:focus,
    .pagination-outline-secondary.pagination li.active>a:not(.page-link),
    .pagination-outline-secondary.pagination li.active>a:not(.page-link):hover,
    .pagination-outline-secondary.pagination li.active>a:not(.page-link):focus {
        border-color: #b6bcc6;
        color: #6d788d;
        background-color: #f8f8f9;
    }

    .pagination-outline-secondary .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-outline-secondary.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(109, 120, 141, 0.2) 0, rgba(109, 120, 141, 0.3) 40%, rgba(109, 120, 141, 0.4) 50%, rgba(109, 120, 141, 0.5) 60%, rgba(76, 78, 100, 0) 70%);
    }

    .pagination-success .page-item.active .page-link,
    .pagination-success .page-item.active .page-link:hover,
    .pagination-success .page-item.active .page-link:focus,
    .pagination-success.pagination li.active>a:not(.page-link),
    .pagination-success.pagination li.active>a:not(.page-link):hover,
    .pagination-success.pagination li.active>a:not(.page-link):focus {
        border-color: #72e128;
        background-color: #72e128;
        color: #fff;
    }

    .pagination-success .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-success.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0) 70%);
    }

    .pagination-outline-success .page-item.active .page-link,
    .pagination-outline-success .page-item.active .page-link:hover,
    .pagination-outline-success .page-item.active .page-link:focus,
    .pagination-outline-success.pagination li.active>a:not(.page-link),
    .pagination-outline-success.pagination li.active>a:not(.page-link):hover,
    .pagination-outline-success.pagination li.active>a:not(.page-link):focus {
        border-color: #b9f094;
        color: #72e128;
        background-color: #f8fef4;
    }

    .pagination-outline-success .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-outline-success.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(114, 225, 40, 0.2) 0, rgba(114, 225, 40, 0.3) 40%, rgba(114, 225, 40, 0.4) 50%, rgba(114, 225, 40, 0.5) 60%, rgba(76, 78, 100, 0) 70%);
    }

    .pagination-info .page-item.active .page-link,
    .pagination-info .page-item.active .page-link:hover,
    .pagination-info .page-item.active .page-link:focus,
    .pagination-info.pagination li.active>a:not(.page-link),
    .pagination-info.pagination li.active>a:not(.page-link):hover,
    .pagination-info.pagination li.active>a:not(.page-link):focus {
        border-color: #26c6f9;
        background-color: #26c6f9;
        color: #fff;
    }

    .pagination-info .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-info.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0) 70%);
    }

    .pagination-outline-info .page-item.active .page-link,
    .pagination-outline-info .page-item.active .page-link:hover,
    .pagination-outline-info .page-item.active .page-link:focus,
    .pagination-outline-info.pagination li.active>a:not(.page-link),
    .pagination-outline-info.pagination li.active>a:not(.page-link):hover,
    .pagination-outline-info.pagination li.active>a:not(.page-link):focus {
        border-color: #93e3fc;
        color: #26c6f9;
        background-color: #f4fcff;
    }

    .pagination-outline-info .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-outline-info.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(38, 198, 249, 0.2) 0, rgba(38, 198, 249, 0.3) 40%, rgba(38, 198, 249, 0.4) 50%, rgba(38, 198, 249, 0.5) 60%, rgba(76, 78, 100, 0) 70%);
    }

    .pagination-warning .page-item.active .page-link,
    .pagination-warning .page-item.active .page-link:hover,
    .pagination-warning .page-item.active .page-link:focus,
    .pagination-warning.pagination li.active>a:not(.page-link),
    .pagination-warning.pagination li.active>a:not(.page-link):hover,
    .pagination-warning.pagination li.active>a:not(.page-link):focus {
        border-color: #fdb528;
        background-color: #fdb528;
        color: #fff;
    }

    .pagination-warning .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-warning.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0) 70%);
    }

    .pagination-outline-warning .page-item.active .page-link,
    .pagination-outline-warning .page-item.active .page-link:hover,
    .pagination-outline-warning .page-item.active .page-link:focus,
    .pagination-outline-warning.pagination li.active>a:not(.page-link),
    .pagination-outline-warning.pagination li.active>a:not(.page-link):hover,
    .pagination-outline-warning.pagination li.active>a:not(.page-link):focus {
        border-color: #feda94;
        color: #fdb528;
        background-color: #fffbf4;
    }

    .pagination-outline-warning .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-outline-warning.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(253, 181, 40, 0.2) 0, rgba(253, 181, 40, 0.3) 40%, rgba(253, 181, 40, 0.4) 50%, rgba(253, 181, 40, 0.5) 60%, rgba(76, 78, 100, 0) 70%);
    }

    .pagination-danger .page-item.active .page-link,
    .pagination-danger .page-item.active .page-link:hover,
    .pagination-danger .page-item.active .page-link:focus,
    .pagination-danger.pagination li.active>a:not(.page-link),
    .pagination-danger.pagination li.active>a:not(.page-link):hover,
    .pagination-danger.pagination li.active>a:not(.page-link):focus {
        border-color: #ff4d49;
        background-color: #ff4d49;
        color: #fff;
    }

    .pagination-danger .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-danger.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0) 70%);
    }

    .pagination-outline-danger .page-item.active .page-link,
    .pagination-outline-danger .page-item.active .page-link:hover,
    .pagination-outline-danger .page-item.active .page-link:focus,
    .pagination-outline-danger.pagination li.active>a:not(.page-link),
    .pagination-outline-danger.pagination li.active>a:not(.page-link):hover,
    .pagination-outline-danger.pagination li.active>a:not(.page-link):focus {
        border-color: #ffa6a4;
        color: #ff4d49;
        background-color: #fff6f6;
    }

    .pagination-outline-danger .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-outline-danger.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 77, 73, 0.2) 0, rgba(255, 77, 73, 0.3) 40%, rgba(255, 77, 73, 0.4) 50%, rgba(255, 77, 73, 0.5) 60%, rgba(76, 78, 100, 0) 70%);
    }

    .pagination-dark .page-item.active .page-link,
    .pagination-dark .page-item.active .page-link:hover,
    .pagination-dark .page-item.active .page-link:focus,
    .pagination-dark.pagination li.active>a:not(.page-link),
    .pagination-dark.pagination li.active>a:not(.page-link):hover,
    .pagination-dark.pagination li.active>a:not(.page-link):focus {
        border-color: #4b4b4b;
        background-color: #4b4b4b;
        color: #fff;
    }

    .pagination-dark .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-dark.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0) 70%);
    }

    .pagination-outline-dark .page-item.active .page-link,
    .pagination-outline-dark .page-item.active .page-link:hover,
    .pagination-outline-dark .page-item.active .page-link:focus,
    .pagination-outline-dark.pagination li.active>a:not(.page-link),
    .pagination-outline-dark.pagination li.active>a:not(.page-link):hover,
    .pagination-outline-dark.pagination li.active>a:not(.page-link):focus {
        border-color: #a5a5a5;
        color: #4b4b4b;
        background-color: #f6f6f6;
    }

    .pagination-outline-dark .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-outline-dark.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(75, 75, 75, 0.2) 0, rgba(75, 75, 75, 0.3) 40%, rgba(75, 75, 75, 0.4) 50%, rgba(75, 75, 75, 0.5) 60%, rgba(76, 78, 100, 0) 70%);
    }

    .pagination-gray .page-item.active .page-link,
    .pagination-gray .page-item.active .page-link:hover,
    .pagination-gray .page-item.active .page-link:focus,
    .pagination-gray.pagination li.active>a:not(.page-link),
    .pagination-gray.pagination li.active>a:not(.page-link):hover,
    .pagination-gray.pagination li.active>a:not(.page-link):focus {
        border-color: rgba(76, 78, 100, 0.06);
        background-color: rgba(76, 78, 100, 0.06);
        color: #fff;
    }

    .pagination-gray .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-gray.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0) 70%);
    }

    .pagination-outline-gray .page-item.active .page-link,
    .pagination-outline-gray .page-item.active .page-link:hover,
    .pagination-outline-gray .page-item.active .page-link:focus,
    .pagination-outline-gray.pagination li.active>a:not(.page-link),
    .pagination-outline-gray.pagination li.active>a:not(.page-link):hover,
    .pagination-outline-gray.pagination li.active>a:not(.page-link):focus {
        border-color: #a6a7b2;
        color: rgba(76, 78, 100, 0.06);
        background-color: #f6f6f7;
    }

    .pagination-outline-gray .page-item.active .page-link.waves-effect .waves-ripple,
    .pagination-outline-gray.pagination li.active>a:not(.page-link).waves-effect .waves-ripple {
        background: radial-gradient(rgba(76, 78, 100, 0.2) 0, rgba(76, 78, 100, 0.3) 40%, rgba(76, 78, 100, 0.4) 50%, rgba(76, 78, 100, 0.5) 60%, rgba(76, 78, 100, 0) 70%);
    }

    .page-item.first .page-link,
    .page-item.last .page-link,
    .page-item.next .page-link,
    .page-item.prev .page-link,
    .page-item.previous .page-link {
        padding-top: 0.321rem;
        padding-bottom: 0.321rem;
    }

    .page-item.disabled .page-link {
        border-color: #d8d8dd;
    }

    .page-link,
    .page-link>a {
        border-radius: 0.5rem;
        line-height: 1;
        text-align: center;
        min-width: calc(1.8755rem + 2px);
    }

    .page-link:focus,
    .page-link>a:focus {
        color: #636578;
    }

    .pagination:not([class*=pagination-outline-]) .page-link {
        border-color: transparent;
    }

    .page-link.btn-primary {
        box-shadow: none !important;
    }

    .pagination.pagination-rounded .page-item a {
        border-radius: 0.5rem;
    }
</style>


<x-app-layout>
    <div class="container mx-auto">
        <div class="mt-10 relative mb-36">
            <img src="{{asset('assets/imgs/Rectangle.png')}}" alt="">
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 flex flex-col items-center">
                <div class="w-40 h-40 rounded-full border-4 border-salmon" onclick="handleClickInput()">
                @if(isset($user->imageProfile) && $user->imageProfile !== '')
                    <img src="{{ asset($user->imageProfile) }}"  class="w-full h-full rounded-full z-10">
                @else
                    <img src="{{ asset('assets/imgs/male-avt.png') }}"  class="w-full h-full rounded-full z-10">
                @endif
                </div>
                <div class="text-center mt-4">
                    <p class="font-semibold">{{ $user->fullName }}</p>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="border-b border-gray-300">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500">
                <li class="mr-2 flex-1">
                    <a href="{{ route('user.index') }}" class="font-semibold text-base w-full inline-flex items-center justify-center p-4 border-b-px border-transparent rounded-t-lg group @if(Str::contains($currentUrl, 'user')) text-mint-green border-b-2 border-b-mint-green @endif hover:text-mint-green">
                        <p class="mt-1">
                            Profile
                        </p>
                    </a>
                </li>
                <li class="mr-2 flex-1">
                    <a 
                        href="{{ route('profile.orders') }}" 
                        class="font-semibold text-base w-full inline-flex items-center justify-center p-4 border-b-px border-transparent rounded-t-lg hover:text-mint-green group @if(Str::contains($currentUrl, 'orders')) text-mint-green border-b-2 border-b-mint-green @endif"
                    >
                        <p class="mt-1">
                            Orders
                        </p>
                    </a>
                </li>
                <li class="mr-2 flex-1">
                    <a 
                        href="{{ route('wishlist.index') }}" 
                        class="font-semibold text-base w-full inline-flex items-center justify-center p-4 hover:text-mint-green border-b-px border-transparent rounded-t-lg group @if(Str::contains($currentUrl, 'wishlist')) text-mint-green border-b-2 border-b-mint-green @endif"
                    >
                        <p class="mt-1">
                            Favorite
                        </p>
                    </a>
                </li>
            </ul>
        </div>

        <form action="{{ route('user.update', [$user]) }}" enctype="multipart/form-data" method="POST" id="formAvatar">
            @csrf
            @method('PATCH')
            <input type="file" hidden name="avatar" onchange="handleChangeAvt()" />
        </form>

        <div class="mt-7 mb-24">
            {{ $slot }}
        </div>
    </div>
</x-app-layout>

<script>
    const inputAvt = document.querySelector('input[type="file"]')
    const formAvtar = document.getElementById('formAvatar')


    const handleChangeAvt = () => {
        formAvtar.submit()
    }

    const handleClickInput = () => {
        inputAvt.click()
    }
</script>