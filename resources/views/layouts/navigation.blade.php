<nav class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-4 sticky top-0">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold">Online Bus Service</a>
        <div class="space-x-4">
            <a href="{{ route('schedules.index') }}" class="{{ request()->routeIs('schedules.index') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Schedules') }}</a>
            @auth
                <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.index') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('My Bookings') }}</a>
                <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.index') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Notifications') }}</a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Profile') }}</a>
                @if (auth()->user()->isOperator())
                    <a href="{{ route('buses.index') }}" class="{{ request()->routeIs('buses.index') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Manage Buses') }}</a>
                @endif
                @if (auth()->user()->isAdmin() || auth()->user()->isOperator())
                    <a href="{{ route('schedules.manage') }}" class="{{ request()->routeIs('schedules.manage') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Manage Schedules') }}</a>
                @endif
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Admin') }}</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:underline">{{ __('Logout') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'text-blue-200' : 'text-white' }} hover:underline">{{ __('Register') }}</a>
            @endauth
        </div>
    </div>
</nav>