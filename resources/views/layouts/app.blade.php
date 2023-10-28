<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins antialiased bg-[#fafafa]">
    <header class="bg-white  border-b border-b-slate-900">
        @include('layouts.navigation')
    </header>

    <main>
        {{ $slot }}
    </main>


    <footer class="bg-mint-green">
        <div class="container mx-auto">
            <div class="grid grid-cols-6 py-14">
                <div class="col-span-1">
                    <img src="{{ asset('assets/imgs/footer-logo.png') }}" class="mb-4" />
                    <ul class="flex items-center gap-2">
                        <li class="w-5 h-5">
                            <img src="{{ asset('assets/icons/OutlineFacebook.svg') }}" />
                        </li>
                        <li class="w-5 h-5">
                            <img src="{{ asset('assets/icons/XTwitter.svg') }}" />
                        </li>
                        <li class="w-5 h-5">
                            <img src="{{ asset('assets/icons/BrandYoutube.svg') }}" />
                        </li>
                        <li class="w-5 h-5">
                            <img src="{{ asset('assets/icons/InstagramLogo.svg') }}" />
                        </li>
                    </ul>
                </div>
                <ul class="col-span-1 space-y-1">
                    <li class="font-semibold mb-3 text-lg">Our Destinations</li>
                    <li class="text-base">Canada</li>
                    <li class="text-base">Alaksa</li>
                    <li class="text-base">France</li>
                    <li class="text-base">Iceland</li>
                </ul>
                <ul class="col-span-1 space-y-1">
                    <li class="font-semibold mb-3 text-lg">Our Activities</li>
                    <li class="text-base">Northern Lights</li>
                    <li class="text-base">Cruising & sailing</li>
                    <li class="text-base">Multi-activities</li>
                    <li class="text-base">Kayaing</li>
                </ul>
                <ul class="col-span-1 space-y-1">
                    <li class="font-semibold mb-3 text-lg">Travel Blogs</li>
                    <li class="text-base">Bali Travel Guide</li>
                    <li class="text-base">Sri Lanks Travel Guide</li>
                    <li class="text-base">Peru Travel Guide</li>
                    <li class="text-base">Bali Travel Guide</li>
                </ul>
                <ul class="col-span-1 space-y-1">
                    <li class="font-semibold mb-3 text-lg">About Us</li>
                    <li class="text-base">Our Story</li>
                    <li class="text-base">Work with us</li>
                </ul>
                <ul class="col-span-1 space-y-1">
                    <li class="font-semibold mb-3 text-lg">Contact Us</li>
                    <li class="text-base">Our Story</li>
                    <li class="text-base">Work with us</li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>