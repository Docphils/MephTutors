<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl mb-6">Edit CRM Request</h3>

                    <form action="{{ route('client.crm.update', $crm->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Request Type -->
                        <div class="mb-4">
                            <label for="request_type" class="block text-sm font-medium">Request Type</label>
                            <select name="request_type" id="request_type" x-model="request_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="coding_tutor" {{ $crm->request_type == 'coding_tutor' ? 'selected' : '' }}>Coding Tutor</option>
                                <option value="club" {{ $crm->request_type == 'club' ? 'selected' : '' }}>Club</option>
                            </select>
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

                        <!-- Full Address -->
                        <div class="mb-4">
                            <label for="full_address" class="block text-sm font-medium">Full Address</label>
                            <input type="text" name="full_address" id="full_address" value="{{ old('full_address', $crm->full_address) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('full_address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Conditional Fields -->
                        <div x-show="request_type == 'coding_tutor'" x-transition>
                            <!-- Languages -->
                            <div class="mb-4">
                                <label for="languages" class="block text-sm font-medium">Languages</label>
                                <input type="text" name="languages" id="languages" value="{{ old('languages', $crm->languages) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('languages')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Class Type -->
                            <div class="mb-4">
                                <label for="class_type" class="block text-sm font-medium">Class Type</label>
                                <select name="class_type" id="class_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="home_tutoring" {{ $crm->class_type == 'home_tutoring' ? 'selected' : '' }}>Home Tutoring</option>
                                    <option value="online" {{ $crm->class_type == 'online' ? 'selected' : '' }}>Online</option>
                                </select>
                                @error('class_type')
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
                        </div>

                        <div x-show="request_type == 'club'" x-transition>
                            <!-- School Name -->
                            <div class="mb-4">
                                <label for="school_name" class="block text-sm font-medium">School Name</label>
                                <input type="text" name="school_name" id="school_name" value="{{ old('school_name', $crm->school_name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('school_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- School Address -->
                            <div class="mb-4">
                                <label for="school_address" class="block text-sm font-medium">School Address</label>
                                <input type="text" name="school_address" id="school_address" value="{{ old('school_address', $crm->school_address) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('school_address')
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
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
