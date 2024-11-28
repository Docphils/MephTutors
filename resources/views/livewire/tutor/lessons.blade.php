<div class="bg-white">
    <!-- Tabs for Filtering Bookings by Status -->
    <div class="flex justify-around mb-6 border-b text-sm sm:text-base">
        <button wire:click="setTab('Closed Lessons')" class="{{ $activeTab == 'Closed Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950 text-cyan-50' : '' }} px-1 sm:px-4 py-2">Closed</button>
        <button wire:click="setTab('Completed Lessons')" class="{{ $activeTab == 'Completed Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950 text-cyan-50' : '' }} px-1 sm:px-4 py-2">Completed</button>
        <button wire:click="setTab('Active Lessons')" class="{{ $activeTab == 'Active Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950 text-cyan-50' : '' }} px-1 sm:px-4 py-2">Active</button>
    </div>

    <!-- Bookings Display -->
    <div>
        <h2 class="font-bold text-lg mb-4">{{ ucfirst($activeTab) }}</h2>
        <div class="font-bold grid grid-cols-5 gap-4 p-4 bg-white shadow-md rounded-md text-gray-900 text-sm sm:text-base">
            <div>Tutor</div>
            <div>Start Date</div>
            <div>Subjects</div>
            <div>Status</div>
            <div>Actions</div>
        </div>
        @forelse($lessons as $booking)
        <div class="grid grid-cols-5 gap-4 p-4 bg-white shadow-md text-gray-900 border-b border-cyan-800 text-sm sm:text-base items-center">
            <div>{{ $booking->tutor->name }}</div>
            <div>{{ $booking->start_date}}</div>
            <div>{{ $booking->subjects }}</div>
            <div>{{ $booking->status }}</div>
            <div class="flex items-center space-x-1 sm:space-x-4 ml-1 sm:ml-0">
                <button class="bg-blue-500 text-white p-1 px-2 rounded-md" wire:click="showLesson({{ $booking->id }})">
                    <i class="fas fa-eye text-xs sm:text-base"></i>
                </button>
                @if ($booking->status === 'Active')
                <button class="bg-yellow-500 text-white p-1 px-2 rounded-md" wire:click="editCompleted({{ $booking->id }})">
                    <i class="fas fa-edit text-xs sm:text-base"></i>
                </button>
                @endif
            </div>
        </div>
        @empty
        <div class="p-4 bg-gray-100 text-center text-cyan-800 rounded-lg">
            <strong>No Lessons found in this category.</strong>
        </div>
        @endforelse
        {{ $lessons->links() }} 

    </div>

    <!-- Lesson Show Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full text-gray-900 overflow-y-auto" style="max-height: 80vh;">
            <h3 class="text-lg font-bold mb-4 border-b-2 border-gray-300 pb-1 text-cyan-100 w-full bg-cyan-800">Lesson Details</h3>
            <div class="grid grid-cols-1 gap-4">

                @if($selectedLesson)
                   
                    <!-- Lesson Schedule Card -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold mb-2">Lesson Schedule</h4>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Start Date:</span>
                            <span class="text-gray-700">{{ \Carbon\Carbon::parse($selectedLesson->start_date)->format('l, F j, Y') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">End Date:</span>
                            <span class="text-gray-700">{{ $selectedLesson->end_date ? \Carbon\Carbon::parse($selectedLesson->end_date)->format('l, F j, Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Days/Times:</span>
                            <span class="text-gray-700">{{ $selectedLesson->days_times ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Lesson Details Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold mb-2">Lesson Details</h4>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Address:</span>
                            <span class="text-gray-700">{{ $selectedLesson->location ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Subjects:</span>
                            <span class="text-gray-700">{{ $selectedLesson->subjects }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Duration per day:</span>
                            <span class="text-gray-700">{{ $selectedLesson->duration ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Learners:</span>
                            <span class="text-gray-700">{{ $selectedLesson->learners ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Sessions:</span>
                            <span class="text-gray-700">{{ $selectedLesson->sessions ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Financial Details Card -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold mb-2">Financial Details</h4>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Expected Earning:</span>
                            <span class="text-gray-700">{{ number_format($selectedLesson->payments->amount, 2) . ' ' . ($selectedLesson->currency ?? 'NGN') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Payment Status:</span>
                            <span class="text-gray-700">{{ $selectedLesson->paymentStatus ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Remarks Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold mb-2">Remarks</h4>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Tutor Remarks:</span>
                            <span class="text-gray-700">{{ $selectedLesson->tutorRemarks ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Curriculum and Status Card -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold mb-2">Curriculum & Status</h4>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Curriculum:</span>
                            <span class="text-gray-700">{{ $selectedLesson->curriculum ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Status:</span>
                            <span class="text-gray-700">{{ $selectedLesson->status }}</span>
                        </div>
                    </div>

                @else
                    <div class="p-4 text-center text-red-500">
                        <strong>No lesson details available.</strong>
                    </div>
                @endif
            </div>
            <button class="mt-6 bg-red-500 text-white px-4 py-2 rounded-md w-full hover:bg-red-600 transition duration-200" @click="open = false">Close</button>
        </div>
    </div>

   
    <!-- Modal for Completed Remarks -->
    @if ($showCompletedModal)
        <div class="fixed inset-0 z-10 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-md w-96">
                <h2 class="text-lg font-bold mb-4">Mark lesson as completed</h2>
                <textarea wire:model="tutorRemarks" class="w-full mb-4 p-2 border" placeholder="Enter remarks"></textarea>
                <select wire:model="status" class="w-full mb-4 p-2 border">
                    <option value="">Select Status</option>
                    <option value="Completed">Lesson completed</option>
                </select>
                <button wire:click="submitCompleted" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
                <button wire:click="$set('showCompletedModal', false)" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancel</button>
            </div>
        </div>
    @endif

</div>
