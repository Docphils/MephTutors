<div>
        @if(session('success'))
            <div class="bg-green-50 text-green-600 mb-2">
                {{ session('success') }}
            </div>
        @endif
    <div class="hidden sm:block border p-2 mb-1">
        <div class="flex justify-between"> 
            <h2 class="text-2xl font-bold mb-2">Booked Lessons</h2>

        </div>
        <nav class="sm:flex bg-cyan-600 border mb-4 gap-4" x-data="{ activeStatus: @entangle('status') }">
            <button wire:click.prevent="$set('status', 'all')" :class="{ 'active': activeStatus === 'all'}" class="border-r w-full">All</button>
            <button wire:click.prevent="$set('status', 'pending')" :class="{ 'active': activeStatus === 'pending' }" class="border-r w-full" >Pending</button>
            <button wire:click.prevent="$set('status', 'adjust')" :class="{ 'active': activeStatus === 'adjust' }" class="border-r w-full">Adjust</button>
            <button wire:click.prevent="$set('status', 'accepted')" :class="{ 'active': activeStatus === 'accepted' }" class="border-r w-full">Accepted</button>
            <button wire:click.prevent="$set('status', 'active')" :class="{ 'active': activeStatus === 'active' }"class="border-r w-full">Active</button>
            <button wire:click.prevent="$set('status', 'completed')" :class="{ 'active': activeStatus === 'completed' }" class="border-r w-full">Completed</button>
            <button wire:click.prevent="$set('status', 'declined')" :class="{ 'active': activeStatus === 'declined' }" class="border-r w-full">Declined</button>
            <button wire:click.prevent="$set('status', 'closed')" :class="{ 'active': activeStatus === 'closed' }" class="border-r w-full" >Closed</button>        
            <input wire:click.prevent="$set('status', 'search')" type="text" wire:model.live="search" placeholder="Search bookings..." class="rounded-md w-full p-1 border-cyan-500-400 text-sm">
        </nav>
        

        <div class="">
            <div class="flex justify-between text-cyan-900 font-bold mb-2 mx-auto w-full">
                <div class="w-full">Learner's Name</div>
                <div class="w-full"> Client's Name</div>
                <div class="w-full">Tutor's Name</div>
                <div class="w-full">Status</div>
                <div class="w-full">Actions</div>
            </div>
            @if($status === 'all'||$status === null)
            @foreach($bookings as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
            @endforeach
            @elseif($status === 'pending')
                @foreach($pending as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @elseif($status === 'accepted')
                @foreach($accepted as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        @if ($booking->status === 'Accepted')
                        <button wire:click="editActivation({{ $booking->id }})" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        @endif
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @elseif($status === 'active')
                @foreach($active as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @elseif($status === 'adjust')
                @foreach($adjust as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @elseif($status === 'completed')
                @foreach($completed as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @elseif($status === 'declined')
                @foreach($declined as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @elseif($status === 'closed')
                @foreach($closed as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @elseif($status === 'search')
                @foreach($queryBookings as $booking)
                <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$booking->learners}}</div>
                    <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                    <div class="w-full">{{$booking->tutor->name}}</div>
                    <div class="w-full">{{$booking->status}}</div>
                    <div class="flex justify-between w-full">
                        <button wire:click.prevent="showBooking({{ $booking->id }})" class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                        <button wire:navigate onclick="window.location='{{ route('bookings.edit', $booking->id) }}'" class="w-full">
                            <i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i>
                        </button>
                        <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="w-full"><i class="fas fa-trash text-red-500 hover:text-red-700 hover:shadow-lg"></i></button>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    @include('livewire.admin.lesson.mobileIndex')

    {{ $bookings->links() }}

    <!-- Show Modal -->
    @if($showModal)
    <div class="absolute flex items-center justify-center bg-gray-900 bg-opacity-50 top-0 left-0 w-full">
        <div class="bg-gradient-to-r from-cyan-100 to-cyan-400 p-4 sm:p-6 rounded-lg shadow-lg w-3/4 sm:w-2/3">
            <h2 class="text-xl sm:text-2xl font-bold text-cyan-700 my-4 text-center">Booking Details</h2>

            <div class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Client:</strong> {{ $selectedBooking->client->name }}</p>
                    <p><strong class="text-gray-700">Tutor:</strong> {{ $selectedBooking->tutor->name }}</p>
                    <p><strong class="text-gray-700">Status:</strong> <span class="px-2 py-1 rounded-full text-white {{ $selectedBooking->status === 'Completed' ? 'bg-green-500' : 'bg-yellow-500' }}">{{ $selectedBooking->status }}</span></p>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Start Date:</strong> {{ $selectedBooking->start_date }}</p>
                    <p><strong class="text-gray-700">End Date:</strong> {{ $selectedBooking->end_date }}</p>
                    <p><strong class="text-gray-700">Location:</strong> {{ $selectedBooking->location }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Days & Times:</strong> {{ $selectedBooking->days_times }}</p>
                    <p><strong class="text-gray-700">Subjects:</strong> {{ $selectedBooking->subjects }}</p>
                    <p><strong class="text-gray-700">Learners:</strong> {{ $selectedBooking->learners }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Sessions:</strong> {{ $selectedBooking->sessions }}</p>
                    <p><strong class="text-gray-700">Duration:</strong> {{ $selectedBooking->duration }}</p>
                    <p><strong class="text-gray-700">Tutor Gender:</strong> {{ $selectedBooking->tutorGender }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Curriculum:</strong> {{ $selectedBooking->curriculum }}</p>
                    <p><strong class="text-gray-700">Classes:</strong> {{ $selectedBooking->classes }}</p>
                    <p><strong class="text-gray-700">Amount:</strong> NGN {{ $selectedBooking->amount }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Payment Status:</strong> <span class="px-2 py-1 rounded-full text-white {{ $selectedBooking->paymentStatus === 'Confirmed' ? 'bg-green-500' : 'bg-cyan-600' }}">{{ $selectedBooking->paymentStatus }}</span></p>
                    <p><strong class="text-gray-700">Tutor Remarks:</strong> {{ $selectedBooking->tutorRemarks }}</p>
                    <p><strong class="text-gray-700">Client Remarks:</strong> {{ $selectedBooking->clientApprovalRemarks }}</p>
                </div>

                <div class="flex flex-col bg-white gap-2 p-4 rounded-lg shadow">
                    <div>
                        <p><strong class="text-gray-700">Payment Evidence:</strong></p>
                        @if($selectedBooking->paymentEvidence)
                            @if(Str::endsWith($selectedBooking->paymentEvidence, ['.jpg', '.jpeg', '.png', '.gif']))
                                <!-- Display image -->
                                <img src="{{ asset('storage/' . $selectedBooking->paymentEvidence) }}" alt="Payment Evidence" class="max-w-full h-auto max-h-48 rounded-lg">
                            @elseif(Str::endsWith($selectedBooking->paymentEvidence, '.pdf'))
                                <!-- Display PDF with download link -->
                                <a href="{{ asset('storage/' . $selectedBooking->paymentEvidence) }}" class="text-blue-600 underline" target="_blank">View Payment Evidence</a>
                            @endif
                        @else
                            <p>No payment evidence uploaded.</p>
                        @endif
                    </div>
                    <div>
                        <p><strong class="text-gray-700">Acceptance Remarks:</strong> {{ $selectedBooking->clientAcceptanceRemarks }}</p>
                        <p><strong class="text-gray-700">Approval Remarks:</strong> {{ $selectedBooking->clientApprovalRemarks }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-center">
                <button wire:click="closeModal" class="px-6 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-600">Close</button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal for Activation Remarks -->
    @if ($showActivationModal)
    <div class="fixed inset-0 z-10 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md w-96 text-gray-900">
            <h2 class="text-lg font-bold mb-4">Activate Lesson</h2>
            <select wire:model="lessonStatus" class="w-full mb-4 p-2 border">
                <option value="">Select Status</option>
                <option value="Active">Activate lesson</option>
            </select>
            <button wire:click="submitActivation" class="bg-cyan-700 text-white py-2 px-4 rounded">Submit</button>
            <button wire:click="$set('showActivationModal', false)" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancel</button>
            <div wire:loading class="text-green-600 bg-green-50 p-1" wire:target="submitActivation"> Saving ...</div>
        </div>
    </div>
    @endif
    <!-- Delete Modal -->
    @if($deleteModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-red-100 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-red-700 mb-4">Delete Booking</h2>
            <p class="text-gray-700 mb-6">Are you sure you want to delete this booking? This action cannot be undone.</p>
        
            <div class="flex justify-end space-x-4">
                <button wire:click="deleteBooking" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Yes, Delete
                </button>
                <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
