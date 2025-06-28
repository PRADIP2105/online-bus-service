<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('buses.update', $bus) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="text" name="name" value="{{ old('name', $bus->name) }}" required />
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input id="type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="text" name="type" value="{{ old('type', $bus->type) }}" required />
                            @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                            <input id="capacity" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="number" name="capacity" value="{{ old('capacity', $bus->capacity) }}" required />
                            @error('capacity') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Bus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>