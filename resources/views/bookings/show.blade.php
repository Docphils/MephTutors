<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ $booking->lesson_id }}</h3>
                    <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                    <p><strong>Location:</strong> {{ $booking->location }}</p>
                    <p><strong>Days & Times:</strong> {{ $booking->days_times }}</p>
                    <p><strong>Subjects:</strong> {{ $booking->subjects }}</p>
                    <p><strong>Learners:</strong> {{ $booking->learners }}</p>
                    <p><strong>Sessions:</strong> {{ $booking->sessions }}</p>
                    <p><strong>Duration:</strong> {{ $booking->duration }}</p>
                    <p><strong>Tutor Gender:</strong> {{ $booking->tutorGender }}</p>
                    <p><strong>Curriculum:</strong> {{ $booking->curriculum }}</p>
                    <p><strong>Status:</strong> {{ $booking->status }}</p>
                    <p><strong>Classes:</strong> {{ $booking->classes }}</p>
                    <p><strong>Tutor Remarks:</strong> {{ $booking->tutorRemarks }}</p>
                    <p><strong>Client Remarks:</strong> {{ $booking->clientRemarks }}</p>

                    @if(Auth::user()->role == 'client')
                        <form method="POST" action="{{ route('bookings.updateClientRemarks', $booking->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="clientRemarks" class="block font-medium text-sm text-gray-700">Client Remarks</label>
                                <textarea name="clientRemarks" id="clientRemarks" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ $booking->clientRemarks }}</textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Remarks</button>
                            </div>
                        </form>
                    @elseif(Auth::user()->role == 'tutor')
                        <form method="POST" action="{{ route('bookings.updateTutorRemarks', $booking->id) }}">
                            @csrf
                            @method('PUT')
      
