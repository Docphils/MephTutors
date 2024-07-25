<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="lesson_id" class="block font-medium text-sm text-gray-700">Lesson ID</label>
                            <input type="text" name="lesson_id" id="lesson_id" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="start_date" class="block font-medium text-sm text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
                            <input type="text" name="location" id="location" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="days_times" class="block font-medium text-sm text-gray-700">Days & Times</label>
                            <input type="text" name="days_times" id="days_times" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="subjects" class="block font-medium text-sm text-gray-700">Subjects</label>
                            <input type="text" name="subjects" id="subjects" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="learners" class="block font-medium text-sm text-gray-700">Learners</label>
                            <input type="text" name="learners" id="learners" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="sessions" class="block font-medium text-sm text-gray-700">Sessions</label>
                            <input type="number" name="sessions" id="sessions" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="duration" class="block font-medium text-sm text-gray-700">Duration</label>
                            <input type="text" name="duration" id="duration" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="tutorGender" class="block font-medium text-sm text-gray-700">Tutor Gender</label>
                            <select name="tutorGender" id="tutorGender" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Any">Any</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="curriculum" class="block font-medium text-sm text-gray-700">Curriculum</label>
                            <select name="curriculum" id="curriculum" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="British">British</option>
                                <option value="French">French</option>
                                <option value="Nigerian">Nigerian</option>
                                <option value="Blended">Blended</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="Assigned">Assigned</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="classes" class="block font-medium text-sm text-gray-700">Classes</label>
                            <input type="text" name="classes" id="classes" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="client_id" class="block font-medium text-sm text-gray-700">Client</label>
                            <select name="client_id" id="client_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="tutor_id" class="block font-medium text-sm text-gray-700">Tutor</label>
                            <select name="tutor_id" id="tutor_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($tutors as $tutor)
                                    <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
