<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased">
        <div class="">
        <div class="bg-gray-white shadow-lg p-5">
            <div class="flex justify-between container mx-auto">
            <a href="/" class="font-semibold text-black">Sneaker MVC</a>
                <div class="flex space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="">Login</a>
                        <a href="{{ route('register') }}" class="">Register</a>
                    @endguest
                    @auth
                    <form class="space-x-2" method="POST" action="{{ route('logout') }}" >
                        <a href="{{ route('dashboard') }}" class="bg-black text-white p-2 rounded-lg">
                            Dashboard
                        </a>
                        <a href="{{ route('sneaker.create') }}" class="bg-black text-white p-2 rounded-lg">
                            Add sneaker
                        </a>
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="bg-black text-white p-2 rounded-lg">Logout</a>
                        </form>
                    @endauth
                </div>
            </div>
            </div>
        </div>
            @yield('content')
        </div>
    </body>
</html>
