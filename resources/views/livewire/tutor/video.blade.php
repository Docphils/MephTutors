<div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 text-black">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-cyan-700 mb-4">Upload Tutor Video</h2>

        <!-- Success message -->
        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        <!-- Video Upload Form -->
        <form wire:submit.prevent="store" enctype="multipart/form-data" class="space-y-6">
            
            <!-- Video Input -->
            <div>
                <label for="video" class="block text-sm font-medium text-gray-700 mb-1">Select Video (MP4, max 10MB)</label>
                <input type="file" wire:model="video" id="video" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg shadow-sm p-2">
                @error('video') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Upload Preview -->
            @if ($video)
                <div class="mt-4">
                    <video controls class="w-full rounded-md shadow-md max-h-40">
                        <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md font-semibold hover:bg-indigo-700 transition">
                    Upload Video
                </button>
            </div>
            <!-- Close Button -->
            <div class="mt-6">
                <button type="button" wire:click.prevent="close" class="w-full bg-gray-400 text-white py-2 rounded-md font-semibold hover:bg-gray-500 transition">
                    Close
                </button>
            </div>
        </form>
    </div>
</div>
