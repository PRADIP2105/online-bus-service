<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Buses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    <a href="{{ route('buses.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add New Bus</a>
                    @if ($buses->isEmpty())
                        <p class="text-gray-500">No buses found.</p>
                    @else
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($buses as $bus)
                                <div class="border p-4 rounded-md">
                                    <p><strong>Name:</strong> {{ $bus->name }}</p>
                                    <p><strong>Type:</strong> {{ $bus->type }}</p>
                                    <p><strong>Capacity:</strong> {{ $bus->capacity }} seats</p>
                                    <p><strong>Average Rating:</strong> {{ $bus->reviews->avg('rating') ?: 'N/A' }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('buses.edit', $bus) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('buses.destroy', $bus) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        <a href="{{ route('reviews.index', ['bus' => $bus->id]) }}" class="text-blue-500 hover:underline">View Reviews</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>