@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Create Schedule</h1>
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('schedules.store') }}" method="POST" class="space-y-6 bg-white shadow sm:rounded-lg p-6">
            @csrf
            <div>
                <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
                <select name="bus_id" id="bus_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Select a bus</option>
                    @foreach ($buses as $bus)
                        <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                    @endforeach
                </select>
                @error('bus_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="start_location" class="block text-sm font-medium text-gray-700">Start Location</label>
                <input type="text" name="start_location" id="start_location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('start_location') }}" required>
                @error('start_location')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="end_location" class="block text-sm font-medium text-gray-700">End Location</label>
                <input type="text" name="end_location" id="end_location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('end_location') }}" required>
                @error('end_location')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure Time</label>
                <input type="datetime-local" name="departure_time" id="departure_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('departure_time') }}" required>
                @error('departure_time')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="arrival_time" class="block text-sm font-medium text-gray-700">Arrival Time</label>
                <input type="datetime-local" name="arrival_time" id="arrival_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('arrival_time') }}" required>
                @error('arrival_time')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('price') }}" step="0.01" required>
                @error('price')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create Schedule</button>
            </div>
        </form>
    </div>
@endsection