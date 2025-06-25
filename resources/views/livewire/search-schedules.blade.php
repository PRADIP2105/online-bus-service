<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Search Bus Schedules</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div>
            <label for="source" class="block text-sm font-medium text-gray-700">Source</label>
            <input wire:model.debounce.500ms="source" type="text" id="source" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <div>
            <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
            <input wire:model.debounce.500ms="destination" type="text" id="destination" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input wire:model="date" type="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
    </div>
    <button wire:click="search" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Search</button>

    <div class="mt-6">
        @if ($schedules->isEmpty())
            <p class="text-gray-500">No schedules found.</p>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach ($schedules as $schedule)
                    <div class="border p-4 rounded-md">
                        <p><strong>Bus:</strong> {{ $schedule->bus->name }} ({{ $schedule->bus->type }})</p>
                        <p><strong>Route:</strong> {{ $schedule->source }} to {{ $schedule->destination }}</p>
                        <p><strong>Departure:</strong> {{ $schedule->departure_time->format('d M Y, H:i') }}</p>
                        <p><strong>Arrival:</strong> {{ $schedule->arrival_time->format('d M Y, H:i') }}</p>
                        <p><strong>Price:</strong> ${{ $schedule->price }}</p>
                        <p><strong>Seats Available:</strong> {{ $schedule->available_seats }}</p>
                        @auth
                            <a href="{{ route('bookings.create', $schedule->id) }}" class="text-blue-500 hover:underline">Book Now</a>
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>