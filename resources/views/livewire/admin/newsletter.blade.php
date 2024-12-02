<div class="p-6 bg-white shadow-sm rounded-md max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-semibold mb-4 text-cyan-700">Compose Newsletter</h2>

    <form wire:submit.prevent="sendNewsletter" class="space-y-4 text-gray-900">
        <div>
            <label class="block text-sm font-medium text-gray-700">Subject</label>
            <input type="text" wire:model="subject"
                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            @error('subject') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" wire:model="title"
                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Body</label>
            <textarea wire:model="body" rows="5"
                      class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 focus:outline-none">
                Send Newsletter
            </button>
        </div>
    </form>

    @if (session()->has('success'))
        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
</div>
