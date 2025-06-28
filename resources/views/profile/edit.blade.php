<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required autofocus />
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required />
                                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                                <input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="password" name="password" />
                                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="password" name="password_confirmation" />
                                @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>