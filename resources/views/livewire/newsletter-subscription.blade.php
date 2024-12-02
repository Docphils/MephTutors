<div class="p-3  shadow-md rounded-md mx-auto">
    <div class="flex items-center justify-center">
        <label class="inline-flex items-center">
            <input type="checkbox" wire:model="isSubscribed" wire:change="toggleSubscription"
                class="form-checkbox h-4 w-4 text-cyan-600 rounded-sm">
            <span class="ml-2 text-sm text-cyan-100">Subscribe to our newsletter</span>
        </label>
    </div>

    @if (session()->has('success'))
        <div class="mt-2 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
</div>
