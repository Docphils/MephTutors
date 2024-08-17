<div>
<div>
    <h2 class="text-2xl font-bold mb-2">Booked Lessons</h2>
    <nav class="flex mb-4 gap-4" x-data="{ activeStatus: @entangle('status') }">
        <button wire:click.prevent="$set('status', 'all')" :class="{ 'active': activeStatus === 'all' }">All</button>
        <button wire:click.prevent="$set('status', 'pending')" :class="{ 'active': activeStatus === 'pending' }">Pending</button>
        <button wire:click.prevent="$set('status', 'adjust')" :class="{ 'active': activeStatus === 'adjust' }">Adjust</button>
        <button wire:click.prevent="$set('status', 'accepted')" :class="{ 'active': activeStatus === 'accepted' }">Accepted</button>
        <button wire:click.prevent="$set('status', 'active')" :class="{ 'active': activeStatus === 'active' }">Active</button>
        <button wire:click.prevent="$set('status', 'completed')" :class="{ 'active': activeStatus === 'completed' }">Completed</button>
        <button wire:click.prevent="$set('status', 'declined')" :class="{ 'active': activeStatus === 'declined' }">Declined</button>
        <button wire:click.prevent="$set('status', 'closed')" :class="{ 'active': activeStatus === 'closed' }">Closed</button>
    </nav>
    

    <div class="">
        <div class="flex justify-between text-cyan-900 font-bold mb-2 mx-auto w-full">
            <div class="w-full">Learner's Name</div>
            <div class="w-full"> Client's Name</div>
            <div class="w-full">Tutor's Name</div>
            <div class="w-full">Status</div>
            <div class="w-full">Actions</div>
        </div>
        @if($status === 'all' || $status === null)
        @foreach($bookings as $booking)
            <div wire:key="$booking->id" class="flex justify-between mx-auto w-full">
                <div class="w-full">{{$booking->learners}}</div>
                <div class="w-full">{{$booking->client->userProfile->fullname}}</div>
                <div class="w-full">{{$booking->tutor->name}}</div>
                <div class="w-full">{{$booking->status}}</div>
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})">Delete</button>
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
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="deleteModal({{ $booking->id }})">Delete</button>
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
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="deleteModal({{ $booking->id }})">Delete</button>
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
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="deleteModal({{ $booking->id }})">Delete</button>
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
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="deleteModal({{ $booking->id }})">Delete</button>
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
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="deleteModal({{ $booking->id }})">Delete</button>
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
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="deleteModal({{ $booking->id }})">Delete</button>
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
                <div class="w-full  justify-between">
                    <button wire:click.prevent="showBooking({{ $booking->id }})">View</button>
                    <button wire:click.prevent="editBooking({{ $booking->id }})">Edit</button>
                    <button wire:click.prevent="deleteModal({{ $booking->id }})">Delete</button>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>


    {{ $bookings->links() }}

    <!-- Show Modal -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg">
            <h2>Booking Details</h2>
            <p><strong>Client:</strong> {{ $selectedBooking->client->name }}</p>
            <p><strong>Tutor:</strong> {{ $selectedBooking->tutor->name }}</p>
            <p><strong>Status:</strong> {{ $selectedBooking->status }}</p>
            <!-- Add other booking details here -->
            <button wire:click="closeModal">Close</button>
        </div>
    </div>
    @endif

    <!-- Delete Modal -->
    @if($deleteModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg">
            <h2>Delete Booking</h2>
            <p>Are you sure you want to delete this booking?</p>
            <button wire:click="deleteBooking">Yes, Delete</button>
            <button wire:click="closeModal">Cancel</button>
        </div>
    </div>
    @endif
</div>
