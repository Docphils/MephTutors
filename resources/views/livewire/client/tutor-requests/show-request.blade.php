<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Request Details') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="sm:w-2/3 mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 10000)"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" 
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 10000)"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" 
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="mx-auto mb-4  mx-8">
                <a wire:navigate href="{{ route('client.tutorRequests.index') }}" class="text-cyan-100 bg-cyan-800 border p-1 rounded-sm font-semibold shadow-sm hover:shadow-lg hover:shadow-cyan-600">Back to all requests</a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" flex border-b-4 border-b-cyan-600 justify-between mb-4">
                        <h3 class="text-lg text-cyan-800 font-semibold">{{ $tutorRequest->subjects }}</h3>
                        <p><strong>Status:</strong> <span class="text-green-400">{{ $tutorRequest->status }}</span></p>
                    </div>
                    <div class="grid grid-cols-2 border-b-2">
                        <div class="space-y-4">
                            <p class="border-b">Address</p>
                            <p class="border-b">Intended Start Date</p>
                            <p class="border-b">Expected End Date</p>
                            <p class="border-b">Days & Times</p>
                            <p class="border-b">Learners Names</p>
                            <p class="border-b">No. of Sessions</p>
                            <p class="border-b" >Daily duration</p>
                            <p class="border-b">Tutor Gender</p>
                            <p class="border-b">Curriculum</p>
                            <p class="border-b">Proposed Amount</p>
                            <p class="">Remark</p>
                        </div>
                        <div class="border-l-2  space-y-4 px-2 font-bold">
                            <p class="border-b">{{ $tutorRequest->location }}</p>
                            <p class="border-b">{{ $tutorRequest->start_date }}</p>
                            <p class="border-b">{{ $tutorRequest->end_date }}</p>
                            <p class="border-b">{{ $tutorRequest->days_times }}</p>
                            <p class="border-b">{{ $tutorRequest->learners }}</p>
                            <p class="border-b">{{ $tutorRequest->sessions }}</p>
                            <p class="border-b">{{ $tutorRequest->duration }}</p>
                            <p class="border-b">{{ $tutorRequest->tutor_gender }}</p>
                            <p class="border-b">{{ $tutorRequest->curriculum }}</p>
                            <p class="border-b">NGN{{ $tutorRequest->amount }}</p>
                            <p class="border-b">{{ $tutorRequest->remarks }}</p>
                        </div>
                    </div>
                </div>

                @if ($tutorRequest->status)
                    <div class="flex justify-center mb-4 text-md mx-auto gap-4">
                        <a wire:navigate href="{{ route('client.tutorRequests.edit', $tutorRequest->id) }}" class="text-blue-500 ml-4">Edit</a>
                        <!-- Delete -->
                        <button wire:confirm='Are you sure you want to delete this request?' wire:click='destroy({{ $tutorRequest->id }})' class="text-red-500 hover:underline hover:text-red-700 hover:shadow-lg">Delete</button>
                    </div> 
                @endif
            </div>
        </div>
    </div>
</div>
