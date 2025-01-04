<div class="min-h-screen p-6">

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-600 mb-2 rounded-md w-2/3 mx-auto sm:px-6 lg:px-8">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 mb-2 rounded-md w-2/3 mx-auto sm:px-6 lg:px-8">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="w-4/5 mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Assign New Lesson</h2>

        <form wire:submit.prevent="submit" class="text-gray-900">        
            <div class="mb-4 sm:flex justify-between gap-3">
                <div class="w-full">
                    <label for="start_date" class="block font-medium text-sm text-gray-700">Start Date</label>
                    <input wire:model="start_date" type="date" id="start_date" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                </div>
                <div class="w-full">
                    <label for="end_date" class="block font-medium text-sm text-gray-700">End Date</label>
                    <input wire:model="end_date" type="date" id="end_date" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                </div>
            </div>
        
            <div class="mb-4">
                <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
                <input wire:model="location" type="text" id="location" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="days_times" class="block font-medium text-sm text-gray-700">Days & Times</label>
                <input wire:model="days_times" type="text" id="days_times" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="subjects" class="block font-medium text-sm text-gray-700">Subjects</label>
                <input wire:model="subjects" type="text" id="subjects" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="learners" class="block font-medium text-sm text-gray-700">Names of Learners</label>
                <input wire:model="learners" type="text" id="learners" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
        
            <div class="mb-4 flex justify-between gap-3">
                <div class="w-full">
                    <label for="sessions" class="block font-medium text-sm text-gray-700">Sessions</label>
                    <input wire:model="sessions" type="number" id="sessions" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                </div>
                <div class="w-full">
                    <label for="duration" class="block font-medium text-sm text-gray-700">Daily Duration</label>
                    <input wire:model="duration" type="text" id="duration" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                </div>
            </div>
        
            <div class="mb-4 flex justify-between gap-3">
                <div class="w-full">
                    <label for="tutorGender" class="block font-medium text-sm text-gray-700">Tutor Gender</label>
                    <select wire:model="tutorGender" id="tutorGender" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Any">Any</option>
                    </select>
                </div>
                <div class="w-full">
                    <label for="curriculum" class="block font-medium text-sm text-gray-700">Curriculum</label>
                    <select wire:model="curriculum" id="curriculum" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                        <option value="British">British</option>
                        <option value="French">French</option>
                        <option value="Nigerian">Nigerian</option>
                        <option value="Blended">Blended</option>
                    </select>
                </div>
            </div>
        
            <div class="mb-4">
                <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                <select wire:model="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                    <option value="Pending">Pending</option>
                    <option value="Adjust">For Adjustment</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Active">Active</option>
                    <option value="Completed">Completed</option>
                    <option value="Declined">Declined</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
        
            <div class="mb-4">
                <label for="classes" class="block font-medium text-sm text-gray-700">Learners Class or Age Range</label>
                <input wire:model="classes" type="text" id="classes" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
        
            <div class="mb-4">
                <label for="amount" class="block font-medium text-sm text-gray-700">Amount</label>
                <input wire:model="amount" type="number" id="amount" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>
        
            <div class="mb-4 flex justify-between gap-3">
                <div class="w-full">
                    <label for="client_id" class="block font-medium text-sm text-gray-700">Client</label>
                    <select wire:model="client_id" id="client_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full">
                    <label for="tutor_id" class="block font-medium text-sm text-gray-700">Tutor</label>
                    <select wire:model="tutor_id" id="tutor_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                        <option value="" disabled selected>Select a Tutor</option>
                        @foreach($tutors as $tutor)
                            <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        
            <div class="mb-4">
                <label for="paymentStatus" class="block font-medium text-sm text-gray-700">Payment Status</label>
                <select wire:model="paymentStatus" id="paymentStatus" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                    <option value="Pending">Pending</option>
                    <option value="Paid">Paid</option>
                    <option value="Confirmed">Confirmed</option>
                </select>
            </div>
        
            <div class="mb-4">
                <label for="paymentEvidence" class="block font-medium text-sm text-gray-700">Proof of Payment</label>
                <input wire:model="paymentEvidence" type="file" id="paymentEvidence" class="form-input rounded-md shadow-sm mt-1 block w-full">
            </div>
        
            <div class="flex justify-between">
                <a href="{{ route('lessons.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Cancel</a>
                <button wire:loading class="bg-cyan-200 text-cyan-900 px-3 py-1 font-semibold">Assigning Lesson ....</button>
                <button type="submit" class="bg-cyan-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Assign Lesson</button>
            </div>
        </form>
        
    </div>
</div>

