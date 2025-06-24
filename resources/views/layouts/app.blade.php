<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Online Bus Service') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-4 sticky top-0">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold">Online Bus Service</a>
            <div class="space-x-4">
                <a href="{{ route('schedules.index') }}" class="hover:underline">Schedules</a>
                @auth
                    <a href="{{ route('bookings.index') }}" class="hover:underline">My Bookings</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="hover:underline">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="container mx-auto py-6">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center">
        © {{ date('Y') }} Online Bus Service. All rights reserved.
    </footer>

    @livewireScripts
</body>
</html>