@php
    $nav_links = [
        ['name' => 'Home', 'route' => 'home', 'auth' => false],
        ['name' => 'Search Bus', 'route' => 'search.bus', 'auth' => false],
        ['name' => 'Schedules', 'route' => 'schedules.index', 'auth' => true],
        ['name' => 'Bookings', 'route' => 'bookings.index', 'auth' => true],
        ['name' => 'Notifications', 'route' => 'notifications.index', 'auth' => true],
        ['name' => 'Manage Buses', 'route' => 'buses.index', 'auth' => true, 'roles' => [1, 2]],
        ['name' => 'Manage Schedules', 'route' => 'schedules.manage', 'auth' => true, 'roles' => [1, 2]],
    ];
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed top-0 w-full z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        {{ config('app.name', 'Online Bus Service') }}
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @foreach ($nav_links as $link)
                        @if (! $link['auth'] || Auth::check())
                            @if (!isset($link['roles']) || (Auth::check() && in_array(Auth::user()->role_id, $link['roles'] ?? [])))
                                <a href="{{ route($link['route']) }}" class="{{ Route::is($link['route']) ? 'border-b-2 border-indigo-400' : '' }} inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    {{ $link['name'] }}
                                </a>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }}
                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                    <a href="{{ route('register') }}" class="ms-4 text-sm text-gray-700 underline">Register</a>
                @endauth
            </div>
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($nav_links as $link)
                @if (! $link['auth'] || Auth::check())
                    @if (!isset($link['roles']) || (Auth::check() && in_array(Auth::user()->role_id, $link['roles'] ?? [])))
                        <x-responsive-nav-link :href="route($link['route'])" :active="Route::is($link['route'])">
                            {{ $link['name'] }}
                        </x-responsive-nav-link>
                    @endif
                @endif
            @endforeach
        </div>
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>