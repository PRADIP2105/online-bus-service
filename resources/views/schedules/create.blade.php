<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('schedules.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
                                <select id="bus_id" name="bus_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->id }}">{{ $bus->name }} ({{ $bus->type }})</option>
                                    @endforeach
                                </select>
                                @error('bus_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="source" class="block text-sm font-medium text-gray-700">Source</label>
                                <input type="text" name="source" id="source" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('source') }}">
                                @error('source') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                                <input type="text" name="destination" id="destination" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('destination') }}">
                                @error('destination') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure Time</label>
                                <input type="datetime-local" name="departure_time" id="departure_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('departure_time') }}">
                                @error('departure_time') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="arrival_time" class="block text-sm font-medium text-gray-700">Arrival Time</label>
                                <input type="datetime-local" name="arrival_time" id="arrival_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('arrival_time') }}">
                                @error('arrival_time') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('price') }}">
                                @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="available_seats" class="block text-sm font-medium text-gray-700">Available Seats</label>
                                <input type="number" name="available_seats" id="available_seats" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('available_seats') }}">
                                @error('available_seats') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>