<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
                    Edit Booking
                </h2>

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="update">
                    <div class="mb-4">
                        <label for="tutorRequest_id" class="block font-medium text-sm">Request ID</label>
                        <input type="text" wire:model="tutorRequest_id" id="tutorRequest_id" class="form-input rounded-md shadow-sm w-full">
                        @error('tutorRequest_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block font-medium text-sm">Start Date</label>
                        <input type="date" wire:model="start_date" id="start_date" class="form-input rounded-md shadow-sm w-full">
                        @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block font-medium text-sm">Location</label>
                        <input type="text" wire:model="location" id="location" class="form-input rounded-md shadow-sm w-full">
                        @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="days_times" class="block font-medium text-sm">Days & Times</label>
                        <input type="text" wire:model="days_times" id="days_times" class="form-input rounded-md shadow-sm w-full">
                        @error('days_times') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="subjects" class="block font-medium text-sm">Subjects</label>
                        <input type="text" wire:model="subjects" id="subjects" class="form-input rounded-md shadow-sm w-full">
                        @error('subjects') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="learners" class="block font-medium text-sm">Learners</label>
                        <input type="text" wire:model="learners" id="learners" class="form-input rounded-md shadow-sm w-full">
                        @error('learners') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="sessions" class="block font-medium text-sm">Sessions</label>
                        <input type="number" wire:model="sessions" id="sessions" class="form-input rounded-md shadow-sm w-full">
                        @error('sessions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="duration" class="block font-medium text-sm">Duration</label>
                        <input type="text" wire:model="duration" id="duration" class="form-input rounded-md shadow-sm w-full">
                        @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tutorGender" class="block font-medium text-sm">Tutor Gender</label>
                        <select wire:model="tutorGender" id="tutorGender" class="form-select rounded-md shadow-sm w-full">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Any">Any</option>
                        </select>
                        @error('tutorGender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="curriculum" class="block font-medium text-sm">Curriculum</label>
                        <select wire:model="curriculum" id="curriculum" class="form-select rounded-md shadow-sm w-full">
                            <option value="British">British</option>
                            <option value="French">French</option>
                            <option value="Nigerian">Nigerian</option>
                            <option value="Blended">Blended</option>
                        </select>
                        @error('curriculum') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm">Status</label>
                        <select wire:model="status" id="status" class="form-select rounded-md shadow-sm w-full">
                            <option value="Pending">Pending</option>
                            <option value="Adjust">Adjust</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Active">Active</option>
                            <option value="Completed">Completed</option>
                            <option value="Declined">Declined</option>
                            <option value="Closed">Closed</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="classes" class="block font-medium text-sm">Classes</label>
                        <input type="text" wire:model="classes" id="classes" class="form-input rounded-md shadow-sm w-full">
                        @error('classes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="client_id" class="block font-medium text-sm">Client</label>
                        <select wire:model="client_id" id="client_id" class="form-select rounded-md shadow-sm w-full">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tutor_id" class="block font-medium text-sm">Tutor</label>
                        <select wire:model="tutor_id" id="tutor_id" class="form-select rounded-md shadow-sm w-full">
                            @foreach($tutors as $tutor)
                                <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                            @endforeach
                        </select>
                        @error('tutor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="paymentEvidence" class="block font-medium text-sm">Payment Evidence</label>
                        <input type="file" wire:model="paymentEvidence" id="paymentEvidence" class="form-input rounded-md shadow-sm w-full">
                        @error('paymentEvidence') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @if ($paymentEvidence)
                            <p class="text-green-500 text-sm mt-2">File ready for upload.</p>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Booking
                        </button>
                    </div>
                    <div wire:loading class="bg-green-50 text-green-600">Updating...</div>
                    <div wire:loading wire:target="paymentEvidence" class="bg-green-50 text-green-600">Uploading...</div>
                </form>
            </div>
        </div>
    </div>
</div>

