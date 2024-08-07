<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Your Bookings') }}
        </h2>
    </x-slot>        
    
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Your Bookings</h2>

        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-2">Active Bookings</h3>
            <div class="max-w-7xl grid sm:grid-cols-2 gap-8 mx-auto sm:px-6 lg:px-8 my-6">
            @forelse($activeBookings as $booking)
                <div class="mb-4 p-4 bg-cyan-100 text-cyan-800 rounded grid sm:grid-cols-3">
                    <div class="col-span-2">
                        <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                        <p><strong>Tutor Name:</strong> Mrs {{ $booking->tutor->name }}</p>
                        <p><strong>Subjects:</strong> {{ $booking->subjects }}</p>
                        <p><strong>Learners:</strong> {{ $booking->learners }}</p>
                    </div>
                    <div class="">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-500">View Details</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
              
                </div>
            @empty
                <p>No active bookings.</p>
            @endforelse
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-2">Pending Bookings</h3>
            @forelse($completedBookings as $booking)
                <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded">
                    <p><strong>Lesson ID:</strong> {{ $booking->lesson_id }}</p>
                    <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                    <p><strong>Location:</strong> {{ $booking->location }}</p>
                    <p><strong>Days & Times:</strong> {{ $booking->days_times }}</p>
                    <p><strong>Subjects:</strong> {{ $booking->subjects }}</p>
                    <p><strong>Learners:</strong> {{ $booking->learners }}</p>
                    <p><strong>Sessions:</strong> {{ $booking->sessions }}</p>
                    <p><strong>Duration:</strong> {{ $booking->duration }}</p>
                    <p><strong>Tutor Gender:</strong> {{ $booking->tutorGender }}</p>
                    <p><strong>Curriculum:</strong> {{ $booking->curriculum }}</p>
                    <p><strong>Classes:</strong> {{ $booking->classes }}</p>
                </div>
            @empty
                <p>No pending bookings.</p>
            @endforelse
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-2">Closed Bookings</h3>
            @forelse($closedBookings as $booking)
                <div class="mb-4 p-4 bg-gray-100 text-gray-800 rounded">
                    <p><strong>Lesson ID:</strong> {{ $booking->lesson_id }}</p>
                    <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                    <p><strong>Location:</strong> {{ $booking->location }}</p>
                    <p><strong>Days & Times:</strong> {{ $booking->days_times }}</p>
                    <p><strong>Subjects:</strong> {{ $booking->subjects }}</p>
                    <p><strong>Learners:</strong> {{ $booking->learners }}</p>
                    <p><strong>Sessions:</strong> {{ $booking->sessions }}</p>
                    <p><strong>Duration:</strong> {{ $booking->duration }}</p>
                    <p><strong>Tutor Gender:</strong> {{ $booking->tutorGender }}</p>
                    <p><strong>Curriculum:</strong> {{ $booking->curriculum }}</p>
                    <p><strong>Classes:</strong> {{ $booking->classes }}</p>
                </div>
            @empty
                <p>No closed bookings.</p>
            @endforelse
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>
