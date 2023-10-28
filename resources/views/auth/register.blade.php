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
            <div class="max-h-fit flex items-center justify-center gap-20 w-full">
                <div class="basis-3/6 flex justify-start">
                    <div class="h-[565px] w-[488px] overflow-hidden rounded-3xl">
                        <img src="https://scontent.fdad1-4.fna.fbcdn.net/v/t39.30808-6/394843947_354781037052518_4129313167905106614_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_ohc=qMT7sKY16u8AX8uWmBU&_nc_ht=scontent.fdad1-4.fna&oh=00_AfDkN_u6JXpMrc0UcuXP4sGF1N2vynxzLOzHSODIcG2qzw&oe=653E7885" class="w-full h-full object-cover object-center">
                    </div>
                </div>

                <div class="basis-3/6">
                    <div class="flex justify-start">
                        <img src="{{ asset('assets/imgs/Logo.png') }}" />
                    </div>
                    <h1 class="text-6xl font-semibold font-epilogue mt-14 mb-2">Sign up</h1>
                    <span class="text-base text-gray-700">Let’s get you all st up so you can access your personal account.</span>
                    <form action="#" class="mt-12">
                        <div class="space-y-6">
                            <div class="flex justify-between items-center gap-6">
                                <x-input-primary value="Card Number" />
                                <x-input-primary value="Card Number" />
                            </div>
                            <x-input-primary value="Card Number" />
                            <x-input-primary value="Card Number" type="password" />
                            <x-input-primary value="Card Number" type="password" />
                        </div>
                        <div class="my-8">
                            <button type="submit" class="w-full mb-4 h-12 py-3.5 bg-mint-green rounded-lg leading-none">Create account</button>
                            <p class="flex justify-center">Already have an account? 
                                <a href="{{ route('login') }}" class="text-salmon ml-1 font-medium">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>