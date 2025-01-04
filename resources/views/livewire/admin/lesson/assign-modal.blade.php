<div>
    <button wire:click="modal" wire:navigate class="bg-cyan-100 shadow-sm hover:shadow-lg hover:underline shadow-cyan-50  text-cyan-800 p-2 rounded-sm">Assign New Lesson</button>

    
    @if ($openModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white w-1/2 rounded-lg shadow-lg p-6 relative">
            <!-- Close Button -->
            <button wire:click="$set('openModal', false)" 
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>
    
            <h2 class="text-xl font-bold text-gray-800 mb-4">Select a Tutor Request</h2>
    
            <!-- Dropdown for Tutor Requests -->
            <div class="mb-4">
                <label for="tutorRequestId" class="block font-medium text-sm text-gray-700">Request ID</label>
                <select wire:model.live="tutorRequestId" 
                        id="tutorRequestId" 
                        class="text-gray-700 rounded-md shadow-sm mt-1 block w-full" 
                        required>
                    <option value="" disabled selected>Select a request</option>
                    @foreach($tutorRequests as $request)
                        <option value="{{ $request->id }}">
                            #{{ $request->id }} by {{ $request->user->userProfile->fullname }}
                        </option>
                    @endforeach
                </select>
                @error('tutorRequestId') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>
    
            <!-- Confirm Button -->
            <div class="flex justify-end">
                <button wire:click="modal" 
                        class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                    Confirm
                </button>
            </div>
        </div>
    </div>
    @endif
    
</div>
