<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Edit Lesson') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('lessons.update', $lesson->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Intended Start Date</label>
                            <input type="date" name="start_date" value="{{ $lesson->start_date }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Expected End Date</label>
                            <input type="date" name="end_date" value="{{ $lesson->end_date }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Lesson Location & Address</label>
                            <input type="text" name="location" value="{{ $lesson->location }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Days & Times</label>
                            <input type="text" name="days_times" value="{{ $lesson->days_times }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Subjects</label>
                            <input type="text" name="subjects" value="{{ $lesson->subjects }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Learners Names</label>
                            <input type="text" name="learners" value="{{ $lesson->learners }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Number of Sessions</label>
                            <input type="text" name="sessions" value="{{ $lesson->sessions }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Duration</label>
                            <input type="text" name="duration" value="{{ $lesson->duration }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Preferred Tutor's Gender</label>
                            <select name="tutor_gender" class="mt-1 block w-full" required>
                                <option value="Male" {{ $lesson->tutor_gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female"  {{ $lesson->tutor_gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Any"  {{ $lesson->tutor_gender == 'Any' ? 'selected' : '' }}>Any Gender</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Curriculum</label>
                            <select name="curriculum" class="mt-1 block w-full" required>
                                <option value="British" {{ $lesson->curriculum == 'British' ? 'selected' : '' }}>British</option>
                                <option value="French" {{ $lesson->curriculum == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Nigerian" {{ $lesson->curriculum == 'Nigerian' ? 'selected' : '' }}>Nigerian</option>
                                <option value="Blended" {{ $lesson->curriculum == 'Blended' ? 'selected' : '' }}>Blended</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                            <select name="status" class="mt-1 block w-full" required>
                                <option value="Active" {{ $lesson->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Completed" {{ $lesson->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Closed" {{ $lesson->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Amount</label>
                            <input type="text" name="amount" value="{{ $lesson->amount }}" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Remarks</label>
                            <textarea name="remarks" class="mt-1 block w-full">{{ $lesson->remarks }}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-cyan-800 text-white px-4 py-2 rounded">
                                Update Lesson
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
