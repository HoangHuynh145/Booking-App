<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto">
        <div class="flex items-center justify-center h-screen">
            <div class="max-h-fit flex items-center justify-center w-full">
                <div class="basis-2/5">
                    <div class="flex justify-start">
                        <img src="{{ asset('assets/imgs/Logo.png') }}" />
                    </div>
                    <h1 class="text-6xl font-semibold font-epilogue mt-14 mb-2">Login</h1>
                    <span class="text-base text-gray-700">Login to access your Golobe account</span>
                    <form action="{{ route('login') }}" method="POST" class="mt-12">
                        @csrf
                        <div class=" space-y-6">
                            <x-input-primary 
                                title="Email Or Name" 
                                name="username"  
                                error="{{Session::has('error') ? true : false}}"
                            />
                            <x-input-primary 
                                title="Password" 
                                type="password" 
                                name="password" 
                                error="{{Session::has('error') ? true : false}}"
                            />
                            <!-- <p class="text-right text-salmon text-sm font-medium">Forgot Password</p> -->
                        </div>
                        @if(Session::has('error'))
                            <div class="py-3 px-4 bg-red-500/20 rounded-lg mt-3">
                                <strong class="text-red-600">{{ Session::get('error') }}</strong>
                            </div>
                        @endif
                        <div class="my-8">
                            <button type="submit" class="w-full mb-4 h-12 py-3.5 bg-mint-green rounded-lg leading-none">Login</button>
                            <p class="flex justify-center">Don’t have an account? 
                                <a href="{{ route('register') }}" class="text-salmon ml-1 font-medium">Sign up</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="basis-3/5 flex justify-end">
                    <div class="h-[565px] w-[488px] overflow-hidden rounded-3xl">
                        <img src="https://scontent.fdad1-4.fna.fbcdn.net/v/t39.30808-6/394843947_354781037052518_4129313167905106614_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_ohc=qMT7sKY16u8AX8uWmBU&_nc_ht=scontent.fdad1-4.fna&oh=00_AfDkN_u6JXpMrc0UcuXP4sGF1N2vynxzLOzHSODIcG2qzw&oe=653E7885" class="w-full h-full object-cover object-center">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>