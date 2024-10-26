<div class="fixed inset-0 flex items-center justify-center z-50">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black opacity-50"></div>

    <!-- Modal Content -->
    <div class="relative max-w-xl w-full bg-white border rounded-lg p-8 z-50">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700">Introductory Video</h2>

        <form wire:submit.prevent="store" class="space-y-4">
            <!-- Profile Video -->
            <div class="w-full">
                <label for="video" class="block text-sm font-medium text-gray-700">Upload Video</label>
                <input type="file" wire:model="video" id="video" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('video') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
    
            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    {{ $tutorProfileId ? 'Update Video' : 'Add Video' }}
                </button>
            </div>
    
            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="mt-4 text-green-600">
                    {{ session('message') }}
                </div>
            @endif
        </form>
    </div>
</div>
