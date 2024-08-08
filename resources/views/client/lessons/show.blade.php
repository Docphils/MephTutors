<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Lesson Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg shadow-cyan-500">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                    <p><strong>Location:</strong> {{ $booking->location }}</p>
                    <p><strong>Days & Times:</strong> {{ $booking->days_times }}</p>
                    <p><strong>Subjects:</strong> {{ $booking->subjects }}</p>
                    <p><strong>Learners:</strong> {{ $booking->learners }}</p>
                    <p><strong>Sessions:</strong> {{ $booking->sessions }}</p>
                    <p><strong>Duration:</strong> {{ $booking->duration }}</p>
                    <p><strong>Tutor Gender:</strong> {{ $booking->tutorGender }}</p>
                    <p><strong>Curriculum:</strong> {{ $booking->curriculum }}</p>
                    <p><strong>Status:</strong> {{ $booking->status }}</p>
                    <p class="mb-4"><strong>Classes:</strong> {{ $booking->classes }}</p>
                    @can('Admin')
                        <p><strong>Tutor Remark:</strong> {{ $booking->tutorRemarks }}</p>
                        <p><strong>Client Remarks:</strong> {{ $booking->clientRemarks }}</p>
                    @endcan

                    @can('Client')
                    <form method="POST" action="{{ route('bookings.addClientRemarks', $booking->id) }}">
                        @csrf                        
                        <div class="mb-4">
                            <label for="clientRemarks" class="block font-medium text-cyan-800">Client Remarks</label>
                            <textarea name="clientRemarks" id="clientRemarks" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ $booking->clientRemarks }}</textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-cyan-700 hover:bg-cyan-900 text-white font-bold py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                    @endcan
                    @can('Tutor')
                    <form method="POST" action="{{ route('bookings.updateTutorRemarks', $booking->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status" class="block font-medium text-cyan-800">Update Status</label>
                            <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="Completed" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Completed</option>
                            </select>                            
                        </div>
                        <div class="mb-4">
                            <label for="clientRemarks" class="block font-medium text-sm text-gray-700">Tutor Remarks</label>
                            <textarea name="clientRemarks" id="clientRemarks" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ $booking->clientRemarks }}</textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Remarks</button>
                        </div>
                    </form>
                    @endcan    
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
      
