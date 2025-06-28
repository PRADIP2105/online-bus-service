<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Book a Seat</h2>
    <p><strong>Bus:</strong> {{ $schedule->bus->name }} ({{ $schedule->bus->type }})</p>
    <p><strong>Route:</strong> {{ $schedule->source }} to {{ $schedule->destination }}</p>
    <p><strong>Departure:</strong> {{ $schedule->departure_time->format('d M Y, H:i') }}</p>
    <p><strong>Price:</strong> ${{ $schedule->price }}</p>
    <p><strong>Available Seats:</strong> {{ $schedule->available_seats }}</p>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 text-red-500">{{ session('error') }}</div>
    @endif

    @if ($schedule->available_seats > 0)
        <form wire:submit.prevent="book">
            <div class="mb-4">
                <label for="seatNumber" class="block text-sm font-medium text-gray-700">Seat Number</label>
                <input type="number" wire:model="seatNumber" id="seatNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" min="1" max="{{ $schedule->bus->capacity }}">
                @error('seatNumber') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Book Now</button>
        </form>
    @else
        <p class="text-red-500 mt-4">No seats available.</p>
    @endif
</div>