<div>
    <!-- Session Message -->
    @if (session()->has('error'))
        <div class="my-4 text-red-600 w-full p-2 bg-red-100">
            {{ session('error') }}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="my-4 text-green-600 w-full p-2 bg-green-100">
            {{ session('success') }}
        </div>
    @endif
    <!-- Tabs for Filtering Bookings by Status -->
    <div class="flex justify-around mb-6 border-b text-sm sm:text-base">
        <div class="sm:flex">
            <button wire:click="setTab('Closed Lessons')" class="{{ $activeTab == 'Closed Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950' : '' }} px-1 sm:px-4 py-2">Closed</button>
            <button wire:click="setTab('Completed Lessons')" class="{{ $activeTab == 'Completed Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950' : '' }} px-1 sm:px-4 py-2">Completed</button>
        </div>
        
        <div class="sm:flex">
            <button wire:click="setTab('Active Lessons')" class="{{ $activeTab == 'Active Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950' : '' }} px-1 sm:px-4 py-2">Active</button>
            <button wire:click="setTab('Accepted Lessons')" class="{{ $activeTab == 'Accepted Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950' : '' }} px-1 sm:px-4 py-2">Accepted</button>
        </div>
        
        <div class="sm:flex">
            <button wire:click="setTab('Pending Lessons')" class="{{ $activeTab == 'Pending Lessons' ? 'border-b-2 border-indigo-500 bg-cyan-950' : '' }} px-1 sm:px-4 py-2">Pending</button>
        </div>
        
    </div>

    <!-- Bookings Display -->
    <div>
        <h2 class="font-bold text-lg mb-4">{{ ucfirst($activeTab) }}</h2>
        <div class="font-bold grid grid-cols-4 gap-4 p-4 bg-cyan-100 shadow-md rounded-sm text-gray-900 text-sm sm:text-base border-b-4">
            <div>Tutor</div>
            <div>Start Date</div>
            <div class="hidden sm:block">Subjects</div>
            <div>Status</div>
            <div>Actions</div>
        </div>
        @forelse($lessons as $booking)
        <div class="grid grid-cols-4 gap-4 py-2 px-4 bg-white shadow-md text-gray-900 border-b border-cyan-800 text-sm sm:text-base items-center">
            <div>{{ $booking->tutor->name }}</div>
            <div>{{ $booking->start_date}}</div>
            <div class="hiidden sm:block">{{ $booking->subjects }}</div>
            <div>{{ $booking->status }}</div>
            <div class="flex items-center space-x-1 sm:space-x-4 ml-1 sm:ml-0">
                <button class="bg-blue-500 text-white p-1 px-2 rounded-md" wire:click="showLesson({{ $booking->id }})">
                    <i class="fas fa-eye text-xs sm:text-base"></i>
                </button>
                @if ($booking->status === 'Pending')
                <button class="bg-yellow-500 text-white p-1 px-2 rounded-md" wire:click="editAcceptance({{ $booking->id }})">
                    <i class="fas fa-edit text-xs sm:text-base"></i>
                </button>
                @elseif ($booking->status === 'Completed')
                <button class="bg-yellow-500 text-white p-1 px-2 rounded-md" wire:click="editApproval({{ $booking->id }})">
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
                    <!-- Tutor Information Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold mb-2">Tutor Information</h4>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Tutor Name:</span>
                            <span class="text-gray-700">{{ $selectedLesson->tutor->name }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Tutor Gender:</span>
                            <span class="text-gray-700">{{ $selectedLesson->tutorGender ?? 'N/A' }}</span>
                        </div>
                    </div>

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
                            <span class="font-semibold">Amount:</span>
                            <span class="text-gray-700">{{ number_format($selectedLesson->amount, 2) . ' ' . ($selectedLesson->currency ?? 'NGN') }}</span>
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
                            <span class="font-semibold">Client Remarks:</span>
                            <span class="text-gray-700">{{ $selectedLesson->clientAcceptanceRemarks ?? 'N/A' }}</span>
                        </div>
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

    <!-- Modal for Acceptance Remarks -->
    @if ($showAcceptanceModal)
        <div class="fixed inset-0 z-10 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-md w-96 text-gray-900">
                <h2 class="text-lg font-bold mb-4">Accept lesson schedule for commencement</h2>
                @error('clientAcceptanceRemarks')<span class="text-sm text-red-500">{{ $message }}</span> @enderror
                <textarea wire:model="clientAcceptanceRemarks" class="w-full mb-4 p-2 border" placeholder="Enter remarks"></textarea>
                @error('status')<span class="text-sm text-red-500">{{ $message }}</span> @enderror
                <select wire:model="status" class="w-full mb-4 p-2 border">
                    <option value="">Select Status</option>
                    <option value="Adjust">Request Adjustment</option>
                    <option value="Accepted">Accept Booking</option>
                </select>
                <input type="file" wire:model="paymentEvidence" class="w-full mb-4 p-2 border">
                <button wire:click="submitAcceptance" class="bg-cyan-700 text-white py-2 px-4 rounded">Submit</button>
                <button wire:click="$set('showAcceptanceModal', false)" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancel</button>
                <div wire:loading class="text-green-600 bg-green-50 p-1" wire:target="submitAcceptance"> Saving ...</div>
                <div wire:loading class="text-green-600 bg-green-50 p-1" wire:target="paymentEvidence"> Uploading ...</div>
            </div>
        </div>
    @endif

    <!-- Modal for Approval Remarks -->
    @if ($showApprovalModal)
        <div class="fixed inset-0 z-10 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-md w-96">
                <h2 class="text-lg font-bold mb-4">Approve Completed Lesson</h2>
                @error('clientApprovalRemarks')<span class="text-sm text-red-500">{{ $message }}</span> @enderror
                <textarea wire:model="clientApprovalRemarks" class="w-full mb-4 p-2 border text-gray-900" placeholder="Enter remarks"></textarea>
                @error('status')<span class="text-sm text-red-500">{{ $message }}</span> @enderror
                <select wire:model="status" class="w-full mb-4 p-2 border text-gray-900">
                    <option value="">Select Status</option>
                    <option value="Declined">Decline Approval</option>
                    <option value="Closed">Approve</option>
                </select>
                <button wire:click="submitApproval" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
                <button wire:click="$set('showApprovalModal', false)" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancel</button>
                <div wire:loading wire:target="submitApproval" class="text-cyan-600">Submitting....</div>
            </div>
        </div>
    @endif




</div>
