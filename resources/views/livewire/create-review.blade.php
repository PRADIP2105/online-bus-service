<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Review {{ $bus->name }}</h2>
    <p><strong>Type:</strong> {{ $bus->type }}</p>
    <p><strong>Capacity:</strong> {{ $bus->capacity }} seats</p>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    @auth
        <form wire:submit.prevent="save" class="mb-6">
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select wire:model="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                @error('rating') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea wire:model="comment" id="comment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" rows="4"></textarea>
                @error('comment') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Submit Review</button>
        </form>
    @endauth

    <h3 class="text-xl font-semibold mb-4">Reviews</h3>
    @if ($reviews->isEmpty())
        <p class="text-gray-500">No reviews yet.</p>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach ($reviews as $review)
                <div class="border p-4 rounded-md">
                    <p><strong>{{ $review->user->name }}</strong> rated {{ $review->rating }} star{{ $review->rating > 1 ? 's' : '' }}</p>
                    @if ($review->comment)
                        <p class="mt-2">{{ $review->comment }}</p>
                    @endif
                    <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>