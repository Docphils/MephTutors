<!-- Mobile Version -->
<div class="sm:hidden border p-2 mb-1">
    <h2 class="text-xl font-bold mb-2">Booked Lessons</h2>
    <nav class="flex border mb-4 gap-2 overflow-x-auto" x-data="{ activeStatus: @entangle('status') }">
        <button wire:click.prevent="$set('status', 'all')" :class="{ 'active': activeStatus === 'all' }" class="border-r px-2">All</button>
        <button wire:click.prevent="$set('status', 'pending')" :class="{ 'active': activeStatus === 'pending' }" class="border-r px-2">Pending</button>
        <button wire:click.prevent="$set('status', 'adjust')" :class="{ 'active': activeStatus === 'adjust' }" class="border-r px-2">Adjust</button>
        <button wire:click.prevent="$set('status', 'accepted')" :class="{ 'active': activeStatus === 'accepted' }" class="border-r px-2">Accepted</button>
        <button wire:click.prevent="$set('status', 'active')" :class="{ 'active': activeStatus === 'active' }" class="border-r px-2">Active</button>
        <button wire:click.prevent="$set('status', 'completed')" :class="{ 'active': activeStatus === 'completed' }" class="border-r px-2">Completed</button>
        <button wire:click.prevent="$set('status', 'declined')" :class="{ 'active': activeStatus === 'declined' }" class="border-r px-2">Declined</button>
        <button wire:click.prevent="$set('status', 'closed')" :class="{ 'active': activeStatus === 'closed' }" class="border-r px-2">Closed</button>
        <input type="text" wire:click.prevent="$set('status', 'search')" wire:model.live="search" placeholder="Search..." class="rounded-md w-full p-1 border-red-400 text-sm">
    </nav>

    <!-- Booking List for All Status -->
    @if($status === 'all' || $status === null)
        @foreach($bookings as $booking)
            <div wire:key="mobile-all-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Booking List for Pending Status -->
    @if($status === 'pending')
        @foreach($pending as $booking)
            <div wire:key="mobile-pending-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Booking List for Adjust Status -->
    @if($status === 'adjust')
        @foreach($adjust as $booking)
            <div wire:key="mobile-adjust-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Booking List for Accepted Status -->
    @if($status === 'accepted')
        @foreach($accepted as $booking)
            <div wire:key="mobile-accepted-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Booking List for Active Status -->
    @if($status === 'active')
        @foreach($active as $booking)
            <div wire:key="mobile-active-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif

        <!-- Booking List for Completed Status -->
        @if($status === 'completed')
        @foreach($completed as $booking)
            <div wire:key="mobile-completed-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Booking List for Declined Status -->
    @if($status === 'declined')
        @foreach($declined as $booking)
            <div wire:key="mobile-declined-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Booking List for Closed Status -->
    @if($status === 'closed')
        @foreach($closed as $booking)
            <div wire:key="mobile-closed-{{ $booking->id }}" class="border rounded-md p-2 mb-2">
                <div>
                    <span class="font-semibold">Learner:</span> {{$booking->learners}}
                </div>
                <div>
                    <span class="font-semibold">Client:</span> {{$booking->client->userProfile->fullname}}
                </div>
                <div>
                    <span class="font-semibold">Tutor:</span> {{$booking->tutor->name}}
                </div>
                <div>
                    <span class="font-semibold">Status:</span> {{$booking->status}}
                </div>
                <div class="flex justify-between mt-2">
                    <button wire:click.prevent="showBooking({{ $booking->id }})" class="text-blue-500">View</button>
                    <a href="{{ route('bookings.edit', $booking->id) }}" wire:navigate class="text-blue-500">Edit</a>
                    <button wire:click.prevent="openDeleteModal({{ $booking->id }})" class="text-red-500">Delete</button>
                </div>
            </div>
        @endforeach
    @endif
</div>
