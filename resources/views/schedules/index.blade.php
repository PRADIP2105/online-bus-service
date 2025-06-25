<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('schedules.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-4 inline-block">Add Schedule</a>
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($schedules as $schedule)
                            <div class="border p-4 rounded-md">
                                <p><strong>Bus:</strong> {{ $schedule->bus->name }} ({{ $schedule->bus->type }})</p>
                                <p><strong>Route:</strong> {{ $schedule->source }} to {{ $schedule->destination }}</p>
                                <p><strong>Departure:</strong> {{ $schedule->departure_time->format('d M Y, H:i') }}</p>
                                <p><strong>Arrival:</strong> {{ $schedule->arrival_time->format('d M Y, H:i') }}</p>
                                <p><strong>Price:</strong> ${{ $schedule->price }}</p>
                                <p><strong>Seats:</strong> {{ $schedule->available_seats }}</p>
                                <div class="mt-2">
                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline ml-4" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>