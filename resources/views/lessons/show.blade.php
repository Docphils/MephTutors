<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lesson Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ $lesson->subjects }}</h3>
                    <p><strong>Location:</strong> {{ $lesson->location }}</p>
                    <p><strong>Status:</strong> {{ $lesson->status }}</p>
                    <p><strong>Start Date:</strong> {{ $lesson->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $lesson->end_date }}</p>
                    <p><strong>Days & Times:</strong> {{ $lesson->days_times }}</p>
                    <p><strong>Learners:</strong> {{ $lesson->learners }}</p>
                    <p><strong>Sessions:</strong> {{ $lesson->sessions }}</p>
                    <p><strong>Duration:</strong> {{ $lesson->duration }}</p>
                    <p><strong>Tutor:</strong> {{ $lesson->tutor }}</p>
                    <p><strong>Curriculum:</strong> {{ $lesson->curriculum }}</p>
                    <p><strong>Amount:</strong> {{ $lesson->amount }}</p>
                    <p><strong>Remarks:</strong> {{ $lesson->remarks }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
