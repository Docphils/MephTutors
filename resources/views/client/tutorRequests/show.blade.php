<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Lesson Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mb-4  mx-8">
            <a href="{{ route('client.tutorRequests.index') }}" class="mx-8 text-cyan-900 bg-cyan-300 p-1 rounded-lg font-semibold shadow-lg shadow-cyan-600">Back to all requests</a>
        </div>
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 10000)"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" 
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" flex border-b-4 border-b-cyan-600 justify-between mb-4">
                        <h3 class="text-lg text-cyan-800 font-semibold">{{ $tutorRequest->subjects }}</h3>
                        <p><strong>Status:</strong> <span class="text-green-400">{{ $tutorRequest->status }}</span></p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Address:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->location }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Intended Start Date:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->start_date }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Expected End Date:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->end_date }}</p>
                    </div>

                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Days & Times:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->days_times }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Learners Names:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->learners }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Number of Sessions:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->sessions }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Duration per Session:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->duration }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Preferred Tutor Gender:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->tutor_gender }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Curriculum:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->curriculum }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Proposed Amount:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">NGN{{ $tutorRequest->amount }}</p>
                    </div>
                    <div class="grid grid-cols-3 items-center border-b-2">
                        <p><strong class="p-2">Remark:</strong></p>
                        <p class="border-l-2 p-2 col-span-2">{{ $tutorRequest->remarks }}</p>
                    </div>
                </div>

                @if ($tutorRequest->status === 'Pending')
                    <div class="flex justify-center mb-4 text-md mx-auto">
                        <a href="{{ route('client.tutorRequests.edit', $tutorRequest->id) }}" class="text-blue-500 ml-4">Edit</a>
                        <form action="{{ route('admin.tutorRequests.destroy', $tutorRequest->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div> 
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>
