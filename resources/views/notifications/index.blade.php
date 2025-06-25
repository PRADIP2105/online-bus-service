<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach (auth()->user()->notifications as $notification)
                        <div class="border p-4 rounded-md mb-4 {{ $notification->read_at ? 'bg-gray-100' : 'bg-blue-50' }}">
                            <p>{{ $notification->data['message'] }}</p>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            @if (!$notification->read_at)
                                <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:underline">Mark as Read</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>