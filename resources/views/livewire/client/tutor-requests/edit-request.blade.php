<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight mb-4">
            {{ __('Edit Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-2/3 sm:w-1/2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form wire:submit.prevent="update">
                        @csrf
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Intended Start Date</label>
                            <input id="start_date" type="date" wire:model="start_date" class="mt-1 block w-full" required>
                            @error('start_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Expected End Date</label>
                            <input id="end_date" type="date" wire:model="end_date" class="mt-1 block w-full" required>
                            @error('end_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Lesson Location & Address</label>
                            <input id="location" type="text" wire:model="location" class="mt-1 block w-full" required>
                            @error('location')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="days_times" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Days & Times</label>
                            <input id="days_times" type="text" wire:model="days_times" class="mt-1 block w-full" required>
                            @error('days_times')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="subjects" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Subjects</label>
                            <input id="subjects" type="text" wire:model="subjects" class="mt-1 block w-full" required>
                            @error('subjects')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="learners" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Learners Names</label>
                            <input id="learners" type="text" wire:model="learners" class="mt-1 block w-full" required>
                            @error('learners')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="sessions" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Number of Sessions</label>
                            <input id="sessions" type="text" wire:model="sessions" class="mt-1 block w-full" required>
                            @error('sessions')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Duration</label>
                            <input id="duration" type="text" wire:model="duration" class="mt-1 block w-full" required>
                            @error('duration')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tutor_gender" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Preferred Tutor's Gender</label>
                            <select id="tutor_gender" wire:model="tutor_gender" class="mt-1 block w-full" required>
                                <option value="Male" {{ $tutor_gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $tutor_gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Any" {{ $tutor_gender == 'Any' ? 'selected' : '' }}>Any Gender</option>
                            </select>
                            @error('tutor_gender')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="curriculum" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Curriculum</label>
                            <select id="curriculum" wire:model="curriculum" class="mt-1 block w-full" required>
                                <option value="British" {{ $curriculum == 'British' ? 'selected' : '' }}>British</option>
                                <option value="French" {{ $curriculum == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Nigerian" {{ $curriculum == 'Nigerian' ? 'selected' : '' }}>Nigerian</option>
                                <option value="Blended" {{ $curriculum == 'Blended' ? 'selected' : '' }}>Blended</option>
                            </select>
                            @error('curriculum')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                            <select id="status" wire:model="status" class="mt-1 block w-full" required>
                                <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Cancelled" {{ $status == 'Cancelled' ? 'selected' : '' }}>Cancel Request</option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Amount</label>
                            <input id="amount" type="text" wire:model="amount" class="mt-1 block w-full" required>
                            @error('amount')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Remarks</label>
                            <textarea id="remarks" wire:model="remarks" class="mt-1 block w-full"></textarea>
                            @error('remarks')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-center sm:justify-end mt-4">
                            <button type="submit" class="bg-cyan-800 text-white px-4 py-2 rounded-md">
                                Update Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
