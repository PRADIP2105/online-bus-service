<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @php
                        $bookings = auth()->user()->bookings()->with('schedule.bus')->get();
                    @endphp
                    @if ($bookings->isEmpty())
                        <p class="text-gray-500">No bookings found.</p>
                    @else
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($bookings as $booking)
                                <div class="border p-4 rounded-md">
                                    <p><strong>Bus:</strong> {{ $booking->schedule->bus->name }} ({{ $booking->schedule->bus->type }})</p>
                                    <p><strong>Route:</strong> {{ $booking->schedule->source }} to {{ $booking->schedule->destination }}</p>
                                    <p><strong>Departure:</strong> {{ $booking->schedule->departure_time->format('d M Y, H:i') }}</p>
                                    <p><strong>Seat:</strong> {{ $booking->seat_number }}</p>
                                    <p><strong>Price:</strong> ${{ $booking->total_price }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>