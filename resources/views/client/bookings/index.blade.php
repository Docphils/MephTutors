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
            @forelse($activeBookings as $booking)
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
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
                    <!-- Form to add client remarks -->
                    <form action="{{ route('bookings.addClientRemarks', $booking->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="clientRemarks" class="block text-sm font-medium text-gray-700">Client Remarks</label>
                            <textarea id="clientRemarks" name="clientRemarks" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
                            Submit Remark
                        </button>
                    </form>                
                </div>
            @empty
                <p>No active bookings.</p>
            @endforelse
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-2">Pending Bookings</h3>
            @forelse($pendingBookings as $booking)
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
