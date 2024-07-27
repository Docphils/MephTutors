<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Lesson Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" flex border-b-4 border-b-cyan-600 justify-between mb-4">
                        <h3 class="text-lg text-cyan-800 font-semibold">{{ $lesson->subjects }}</h3>
                        <p><strong>Status:</strong> <span class="text-green-400">{{ $lesson->status }}</span></p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Address:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->location }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Intended Start Date:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->start_date }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Expected End Date:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->end_date }}</p>
                    </div>

                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Days & Times:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->days_times }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Learners Names:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->learners }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Number of Sessions:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->sessions }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Duration per Session:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->duration }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Preferred Tutor Gender:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->tutor_gender }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Curriculum:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->curriculum }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Proposed Amount:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->amount }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Remark:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $lesson->remarks }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
