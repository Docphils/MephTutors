<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl mb-6">Edit CRM Request</h3>

                    <form action="{{ route('admin.crm.update', $crm->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Request Type -->
                        <div class="mb-4">
                            <label for="request_type" class="block text-sm font-medium">Request Type</label>
                            <input type="text" name="request_type" id="request_type" value="{{ old('request_type', $crm->request_type) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('request_type')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $crm->start_date) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium">Status</label>
                            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="Pending" {{ $crm->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Ongoing" {{ $crm->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="Closed" {{ $crm->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Full Address -->
                        <div class="mb-4">
                            <label for="full_address" class="block text-sm font-medium">Full Address</label>
                            <input type="text" name="full_address" id="full_address" value="{{ old('full_address', $crm->full_address) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('full_address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remarks -->
                        <div class="mb-4">
                            <label for="remarks" class="block text-sm font-medium">Remarks</label>
                            <textarea name="remarks" id="remarks" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('remarks', $crm->remarks) }}</textarea>
                            @error('remarks')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
