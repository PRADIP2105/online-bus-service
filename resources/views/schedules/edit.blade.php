@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Schedule</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="bus_id" class="form-label">Bus</label>
                <select name="bus_id" id="bus_id" class="form-control">
                    <option value="">Select a bus</option>
                    @foreach ($buses as $bus)
                        <option value="{{ $bus->id }}" {{ $bus->id == $schedule->bus_id ? 'selected' : '' }}>{{ $bus->name }}</option>
                    @endforeach
                </select>
                @error('bus_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="start_location" class="form-label">Start Location</label>
                <input type="text" name="start_location" id="start_location" class="form-control" value="{{ old('start_location', $schedule->start_location) }}" required>
                @error('start_location')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="end_location" class="form-label">End Location</label>
                <input type="text" name="end_location" id="end_location" class="form-control" value="{{ old('end_location', $schedule->end_location) }}" required>
                @error('end_location')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="departure_time" class="form-label">Departure Time</label>
                <input type="datetime-local" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time', $schedule->departure_time->format('Y-m-d\TH:i')) }}" required>
                @error('departure_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="arrival_time" class="form-label">Arrival Time</label>
                <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control" value="{{ old('arrival_time', $schedule->arrival_time->format('Y-m-d\TH:i')) }}" required>
                @error('arrival_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $schedule->price) }}" step="0.01" required>
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Schedule</button>
        </form>
    </div>
@endsection