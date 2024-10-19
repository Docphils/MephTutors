<div class=" w-full mx-auto">
    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-2 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div>
        @if ($editMode)
            <!-- Edit Form -->
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto">
                <!-- Modal Container -->
                <form wire:submit.prevent="save" enctype="multipart/form-data" class="relative w-4/5 bg-white text-gray-900 rounded-lg shadow-lg p-6 z-30 h-auto max-h-[90vh] overflow-y-auto">
                    <!-- Fullname Field -->
                    <div class="mb-4">
                        <label for="fullname" class="block text-md font-medium text-gray-900">Your Full Name</label>
                        <input type="text" wire:model="fullname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @error('fullname') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
            
                    <!-- Phone Field -->
                    <div class="mb-4">
                        <label for="phone" class="block text-md font-medium text-gray-900">Phone</label>
                        <input type="tel" wire:model="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
            
                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="block text-md font-medium text-gray-900">Address</label>
                        <input type="text" wire:model="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @error('address') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
            
                    <!-- Date of Birth Field -->
                    <div class="mb-4">
                        <label for="DOB" class="block text-md font-medium text-gray-900">Date of Birth</label>
                        <input type="date" wire:model="DOB" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @error('DOB') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
            
                    <!-- Gender Field -->
                    <div class="mb-4">
                        <label for="gender" class="block text-md font-medium text-gray-900">Gender</label>
                        <select wire:model="gender" class="mt-1 block w-full text-gray-900 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
            
                    <!-- Profile Image Field -->
                    <div class="mb-4">
                        <label for="image" class="block text-md font-medium text-gray-900">Profile Image</label>
                        <input type="file" wire:model="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            
                        @if ($image)
                            <div class="mt-2">
                                <img src="{{ $image->temporaryUrl() }}" alt="Profile Preview" class="h-14 w-14 rounded-full">
                            </div>
                        @elseif ($userProfile && $userProfile->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $userProfile->image) }}" alt="Profile Image" class="h-14 w-14 rounded-full">
                            </div>
                        @endif
                    </div>
            
                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-800 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                        <button wire:click="closeModal" type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
        @else
            <!-- Profile Display -->
            @if ($userProfile)
                <div class="sm:text-center mb-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $userProfile->image) }}" alt="Profile image" class="h-14 w-14 rounded-full">
                    </div>
                    <div class="hidden sm:block mb-2">
                        <p class="">{{ $fullname }}</p>
                        <p class="text-xs text-green-400">{{ strToUpper($userProfile->user->role) }}</p>
                    </div>
                    <button wire:click="edit" class="bg-cyan-600 hover:bg-cyan-800 text-white px-2 sm:px-4 py-1 sm:py-2 rounded-md text-xs sm:text-sm">Update</button>
                </div>
                @else
                Click the button to update your profile<button wire:click="edit" class="bg-cyan-600 hover:bg-cyan-800 text-white px-2 sm:px-4 py-1 sm:py-2 rounded-md text-xs sm:text-sm">Update</button>
            @endif
        @endif
    </div>
</div>
