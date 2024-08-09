<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Edit Lesson') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-2/3 sm:w-1/2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tutorRequests.update', $tutorRequest->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Intended Start Date</label>
                            <input id="start_date" type="date" name="start_date" value="{{ $tutorRequest->start_date }}" class="mt-1 block w-full" required>
                            @error('start_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Expected End Date</label>
                            <input id="end_date" type="date" name="end_date" value="{{ $tutorRequest->end_date }}" class="mt-1 block w-full" required>
                            @error('end_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Lesson Location & Address</label>
                            <input id="location" type="text" name="location" value="{{ $tutorRequest->location }}" class="mt-1 block w-full" required>
                            @error('location')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="days" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Days & Times</label>
                            <input id="days" type="text" name="days_times" value="{{ $tutorRequest->days_times }}" class="mt-1 block w-full" required>
                            @error('days_times')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="subjects" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Subjects</label>
                            <input id="subjects" type="text" name="subjects" value="{{ $tutorRequest->subjects }}" class="mt-1 block w-full" required>
                            @error('subjects')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="learners" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Learners Names</label>
                            <input id="learners" type="text" name="learners" value="{{ $tutorRequest->learners }}" class="mt-1 block w-full" required>
                            @error('learners')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="sessions" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Number of Sessions</label>
                            <input id="sessions" type="text" name="sessions" value="{{ $tutorRequest->sessions }}" class="mt-1 block w-full" required>
                            @error('sessions')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Duration</label>
                            <input id="duration" type="text" name="duration" value="{{ $tutorRequest->duration }}" class="mt-1 block w-full" required>
                            @error('duration')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Preferred Tutor's Gender</label>
                            <select id="gender" name="tutor_gender" class="mt-1 block w-full" required>
                                <option value="Male" {{ $tutorRequest->tutor_gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female"  {{ $tutorRequest->tutor_gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Any"  {{ $tutorRequest->tutor_gender == 'Any' ? 'selected' : '' }}>Any Gender</option>
                            </select>
                            @error('tutor_gender')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="curriculum" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Curriculum</label>
                            <select id="curriculum" name="curriculum" class="mt-1 block w-full" required>
                                <option value="British" {{ $tutorRequest->curriculum == 'British' ? 'selected' : '' }}>British</option>
                                <option value="French" {{ $tutorRequest->curriculum == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Nigerian" {{ $tutorRequest->curriculum == 'Nigerian' ? 'selected' : '' }}>Nigerian</option>
                                <option value="Blended" {{ $tutorRequest->curriculum == 'Blended' ? 'selected' : '' }}>Blended</option>
                            </select>
                            @error('curriculum')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="Pending" {{ $tutorRequest->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Cancelled" {{ $tutorRequest->status == 'Cancelled' ? 'selected' : '' }}>Cancel Request</option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Amount</label>
                            <input id="amount" type="text" name="amount" value="{{ $tutorRequest->amount }}" class="mt-1 block w-full" required>
                            @error('amount')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Remarks</label>
                            <textarea id="remarks" name="remarks" class="mt-1 block w-full">{{ $tutorRequest->remarks }}</textarea>
                            @error('remarks')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-center sm:justify-end mt-4">
                            <button type="submit" class="bg-cyan-800 text-white px-4 py-2 rounded-md">
                                Update Lesson
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
