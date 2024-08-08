<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($bookings as $user => $userBookings)
                        <h3 class="text-xl font-semibold">{{ $user }}</h3>
                        @foreach ($userBookings as $booking)
                            <div class="mb-4 border-b border-gray-300 pb-4">
                                <h4 class="text-lg font-semibold">{{ $booking->lesson_id }}</h4>
                                <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                                <p><strong>Location:</strong> {{ $booking->location }}</p>
                                <p><strong>Status:</strong> {{ $booking->status }}</p>
                                <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-500 hover:underline">View Details</a>
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="text-blue-500 hover:underline ml-4">Edit</a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
