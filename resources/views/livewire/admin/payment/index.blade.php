<div>
    <!-- Filter and Search Payments -->
    <div class="flex justify-between mb-4 rounded-sm shadow-lg p-2 text-center">
        <div class="flex w-full items-center justify-between gap-4">
            <nav class="font-semibold w-full sm:flex gap-4 text-cyan-50" x-data="{ activeStatus: @entangle('status') }">
                <button wire:click.prevent="$set('status', '')" :class="{ 'active': activeStatus === ''}" class="border-r w-full">All Payments</button>
                <button wire:click.prevent="$set('status', 'Pending')" :class="{ 'active': activeStatus === 'Pending' }" class="border-r w-full">Pending</button>
                <button wire:click.prevent="$set('status', 'Earned')" :class="{ 'active': activeStatus === 'Earned' }" class="border-r w-full">Earned</button>
                <button wire:click.prevent="$set('status', 'Paid')" :class="{ 'active': activeStatus === 'Paid' }" class="border-r w-full">Paid</button>
            </nav>
            <div class="w-full sm:w-1/2 sm:flex gap-4">
                <input type="text" wire:model.live="search" placeholder="Search payments..." class="input input-bordered w-full max-w-xs rounded-md mb-2 sm:mb-0 text-gray-900"/>
                <button wire:click="create" class="w-full rounded-md shadow-md p-2 text-cyan-50 hover:underline hover:shadow-lg hover:bg-cyan-700">Create New Payment</button>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="w-full rounded-sm shadow-lg p-4 mb-4">
        <div class="rounded-lg shadow-lg shadow-cyan-700 mb-4">
            <div class="w-full flex justify-between p-2 text-cyan-100 font-bold text-lg">
                <div class="w-full">Amount</div>
                <div class="w-full">Tutor</div>
                <div class="w-full">Booking</div>
                <div class="w-full">Status</div>
                <div class="hidden sm:block w-full">Actions</div>
            </div>
        </div>
        <div>
            @foreach ($payments as $payment)
                <div class="w-full flex justify-between p-2 sm:border-b gap-2">
                    <div class="w-full">{{ $payment->amount }}</div>
                    <div class="w-full">{{ $payment->tutor->name }}</div>
                    <div class="w-full">{{ $payment->booking->reference }}</div>
                    <div class="w-full">{{ $payment->status }}</div>
                    <div class="w-full hidden sm:flex gap-4">
                        <button wire:click="edit({{ $payment->id }})" class="px-2 py-1 rounded-md bg-blue-500">Edit</button>
                        <button wire:click="openDelete({{ $payment->id }})" class="px-2 py-1 rounded-md bg-red-500">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination Links -->
    {{ $payments->links() }}

    <!-- Create Modal -->
    @if ($createModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                    <div class="bg-white p-4 text-gray-900">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Create Payment</h3>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="amount" placeholder="Amount" class="rounded-md w-full mb-2" />
                            @error('amount') <span class="text-red-600">{{ $message }}</span> @enderror

                            <input type="file" wire:model.defer="evidence" class="rounded-md w-full mb-2" />
                            @error('evidence') <span class="text-red-600">{{ $message }}</span> @enderror

                            <select wire:model.defer="tutor_id" class="rounded-md w-full mb-2 text-gray-900">
                                <option value="">Select Tutor</option>
                                @foreach ($tutors as $tutor)
                                    <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                                @endforeach
                            </select>
                            @error('tutor_id') <span class="text-red-600">{{ $message }}</span> @enderror

                            <select wire:model.defer="booking_id" class="rounded-md w-full mb-2 text-gray-900">
                                <option value="">Select Booking</option>
                                @foreach ($bookings as $booking)
                                    <option value="{{ $booking->id }}">{{ $booking->id }}</option>
                                @endforeach
                            </select>
                            @error('booking_id') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="store" class="w-full sm:w-auto rounded-md shadow-md px-4 py-2 bg-cyan-500 text-white hover:bg-cyan-700">Create</button>
                        <button wire:click="$set('createModal', false)" class="mt-3 w-full sm:w-auto rounded-md shadow-md px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Modal -->
    @if ($editModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                    <div class="bg-white p-4 text-gray-900">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Payment</h3>
                        <div class="mt-2">
                            <input type="text" wire:model.defer="amount" placeholder="Amount" class="rounded-md w-full mb-2" />
                            @error('amount') <span class="text-red-600">{{ $message }}</span> @enderror

                            <input type="file" wire:model.defer="newEvidence" class="rounded-md w-full mb-2" />
                            @error('newEvidence') <span class="text-red-600">{{ $message }}</span> @enderror

                            <select wire:model.defer="tutor_id" class="rounded-md w-full mb-2 text-gray-900">
                                <option value="">Select Tutor</option>
                                @foreach ($tutors as $tutor)
                                    <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                                @endforeach
                            </select>
                            @error('tutor_id') <span class="text-red-600">{{ $message }}</span> @enderror

                            <select wire:model.defer="booking_id" class="rounded-md w-full mb-2 text-gray-900">
                                <option value="">Select Booking</option>
                                @foreach ($bookings as $booking)
                                    <option value="{{ $booking->id }}">{{ $booking->id }}</option>
                                @endforeach
                            </select>
                            @error('booking_id') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="update" class="w-full sm:w-auto rounded-md shadow-md px-4 py-2 bg-cyan-500 text-white hover:bg-cyan-700">Update</button>
                        <button wire:click="$set('editModal', false)" class="mt-3 w-full sm:w-auto rounded-md shadow-md px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if ($deleteModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                    <div class="bg-white p-4 text-gray-900">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Payment</h3>
                        <div class="mt-2">
                            <p>Are you sure you want to delete this payment?</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="deletePayment" class="w-full sm:w-auto rounded-md shadow-md px-4 py-2 bg-red-500 text-white hover:bg-red-700">Delete</button>
                        <button wire:click="$set('deleteModal', false)" class="mt-3 w-full sm:w-auto rounded-md shadow-md px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
