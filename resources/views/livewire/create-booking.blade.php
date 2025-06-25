<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Book a Seat</h2>
    <p><strong>Bus:</strong> {{ $schedule->bus->name }} ({{ $schedule->bus->type }})</p>
    <p><strong>Route:</strong> {{ $schedule->source }} to {{ $schedule->destination }}</p>
    <p><strong>Departure:</strong> {{ $schedule->departure_time->format('d M Y, H:i') }}</p>
    <p><strong>Price:</strong> ${{ $schedule->price }}</p>
    <p><strong>Available Seats:</strong> {{ count($availableSeats) }}</p>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    @if (count($availableSeats) > 0)
        <div class="mt-4">
            <label for="seat_number" class="block text-sm font-medium text-gray-700">Select Seat</label>
            <select wire:model="seatNumber" id="seat_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Choose a seat</option>
                @foreach ($availableSeats as $seat)
                    <option value="{{ $seat }}">{{ $seat }}</option>
                @endforeach
            </select>
            @error('seatNumber') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mt-6">
            <button wire:click="book" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Confirm Booking</button>
        </div>
    @else
        <p class="text-red-500 mt-4">No seats available.</p>
    @endif
</div>