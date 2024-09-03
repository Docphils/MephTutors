<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200  leading-tight">
            {{ __('Assign New Lesson') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 mb-2 rounded-md w-2/3 mx-auto sm:px-6 lg:px-8">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <form method="POST" action="{{ route('lessons.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="tutorRequest_id" class="block font-medium text-sm text-gray-700">Request ID</label>
                            <select name="tutorRequest_id" id="tutorRequest_id" class="text-gray-700 rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($tutorRequests as $request)
                                    <option value="{{ $request->id }}" {{ old('tutorRequest_id')}}>{{ $request->learners }}</option>
                                @endforeach
                            </select>
                            @error('tutorRequest_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="start_date" class="block font-medium text-sm text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('start_date') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block font-medium text-sm text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('end__date') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
                            <input type="text" name="location" id="location" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('location') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="days_times" class="block font-medium text-sm text-gray-700">Days & Times</label>
                            <input type="text" name="days_times" id="days_times" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('days_times') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="subjects" class="block font-medium text-sm text-gray-700">Subjects</label>
                            <input type="text" name="subjects" id="subjects" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('subjects') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="learners" class="block font-medium text-sm text-gray-700">Names of learners</label>
                            <input type="text" name="learners" id="learners" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('learners') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="sessions" class="block font-medium text-sm text-gray-700">Sessions</label>
                            <input type="number" name="sessions" id="sessions" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('sessions') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="duration" class="block font-medium text-sm text-gray-700">Duration</label>
                            <input type="text" name="duration" id="duration" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('duration') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="tutorGender" class="block font-medium text-sm text-gray-700">Tutor Gender</label>
                            <select name="tutorGender" id="tutorGender" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="Male" {{ old('tutorGender') }}>Male</option>
                                <option value="Female" {{ old('tutorGender')}}>Female</option>
                                <option value="Any" {{ old('tutorGender')}}>Any</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="curriculum" class="block font-medium text-sm text-gray-700">Curriculum</label>
                            <select name="curriculum" id="curriculum" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="British" {{ old('curriculum') }}>British</option>
                                <option value="French" {{ old('curriculum') }}>French</option>
                                <option value="Nigerian" {{ old('curriculum') }}>Nigerian</option>
                                <option value="Blended" {{ old('curriculum') }}>Blended</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="Pending" {{ old('status') }}>Pending</option>
                                <option value="Adjust" {{ old('status') }}>For Adjustment</option>
                                <option value="Accepted" {{ old('status') }}>Accepted</option>
                                <option value="Active" {{ old('status') }}>Active</option>
                                <option value="Completed" {{ old('status') }}>Completed</option>
                                <option value="Declined" {{ old('status') }}>Declined</option>
                                <option value="Closed" {{ old('status') }}>Closed</option>

                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="classes" class="block font-medium text-sm text-gray-700">Learners Class or Age Range</label>
                            <input type="text" name="classes" id="classes" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('classes') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block font-medium text-sm text-gray-700">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('amount') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="client_id" class="block font-medium text-sm text-gray-700">Client</label>
                            <select name="client_id" id="client_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id')}}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="tutor_id" class="block font-medium text-sm text-gray-700">Tutor</label>
                            <select name="tutor_id" id="tutor_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($tutors as $tutor)
                                    <option value="{{ $tutor->id }}" {{ old('tutor_id')}}>{{ $tutor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="paymentStatus" class="block font-medium text-sm text-gray-700">Payment Status</label>
                            <select name="paymentStatus" id="paymentStatus" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="Pending" {{ old('paymentStatus')}}>Pending</option>
                                <option value="Paid" {{ old('paymentStatus') }}>Paid</option>
                                <option value="Confirmed" {{ old('paymentStatus') }}>Confirmed</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="paymentEvidence" class="block font-medium text-sm text-gray-700">Proof of Payment</label>
                            <input type="file" value="{{ old('paymentEvidence') }}" class="rounded-md shadow-sm mt-1 block w-full">
                        </div>
                        <div class="flex justify-between">
                            <a href="{{route('lessons.index')}}" wire:navigate type="cancel" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Cancel</a>
                            <button type="submit" class="bg-cyan-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Assign Lesson</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
