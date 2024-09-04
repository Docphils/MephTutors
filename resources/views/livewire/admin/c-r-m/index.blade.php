<div>
    @if(session('success'))
        <div class="bg-green-50 text-green-600 mb-2">
            {{ session('success') }}
        </div>
    @endif
    <div class="hidden sm:block border p-2 mb-1">
        <div class="flex justify-between"> 
            <h2 class="text-2xl font-bold mb-2">Tutor Requests</h2>
        </div>
        <nav class="sm:flex border mb-4 gap-4" x-data="{ activeStatus: @entangle('status') }">
            <button wire:click.prevent="$set('status', 'all')" :class="{ 'active': activeStatus === 'all'}" class="border-r w-full">All</button>
            <button wire:click.prevent="$set('status', 'pending')" :class="{ 'active': activeStatus === 'pending' }" class="border-r w-full" >Pending</button>
            <button wire:click.prevent="$set('status', 'ongoing')" :class="{ 'active': activeStatus === 'ongoing' }" class="border-r w-full">Ongoing</button>
            <button wire:click.prevent="$set('status', 'cancelled')" :class="{ 'active': activeStatus === 'cancelled' }" class="border-r w-full">Cancelled</button>       
            <button wire:click.prevent="$set('status', 'closed')" :class="{ 'active': activeStatus === 'closed' }" class="border-r w-full">Closed</button>
            <input wire:click.prevent="$set('status', 'search')" type="text" wire:model.live="search" placeholder="Search requests..." class="rounded-md w-full p-1 text-gray-900 border-red-400 text-sm">
        </nav>


        <div class="">
            <div class="flex justify-between text-cyan-100 font-bold mb-2 mx-auto w-full">
                <div class="w-full">Request Type</div>
                <div class="w-full">Proposed Start Date</div>
                <div class="w-full">State</div>
                <div class="w-full">Status</div>
                <div class="w-full">Actions</div>
            </div>
            @if($status === 'all'||$status === null)
            @foreach($tutorRequests as $request)
                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$request->request_type}}</div>
                    <div class="w-full">{{$request->start_date}}</div>
                    <div class="w-full">{{$request->state}}</div>
                    <div class="w-full">{{$request->status}}</div>
                    <div class="w-full  justify-between">
                        <button wire:click.prevent="showRequest({{ $request->id }})">View</button>
                        <button wire:click.prevent="openEditModal({{ $request->id }})">Update</button>
                        <button wire:click.prevent="openDeleteModal({{ $request->id }})">Delete</button>
                    </div>
                </div>
            @endforeach
            <div class="border rounded-sm pl-2 mt-2">{{ $tutorRequests->links() }}</div>
            @elseif($status === 'pending')
                @foreach($pending as $request)
                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$request->request_type}}</div>
                    <div class="w-full">{{$request->start_date}}</div>
                    <div class="w-full">{{$request->state}}</div>
                    <div class="w-full">{{$request->status}}</div>
                    <div class="w-full  justify-between">
                        <button wire:click.prevent="showRequest({{ $request->id }})">View</button>
                        <button wire:click.prevent="openEditModal({{ $request->id }})">Update</button>
                        <button wire:click.prevent="openDeleteModal({{ $request->id }})">Delete</button>
                    </div>
                </div>
                @endforeach
                <div class="border rounded-sm pl-2 mt-2">{{ $pending->links() }}</div>
            @elseif($status === 'ongoing')
                @foreach($ongoing as $request)
                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$request->request_type}}</div>
                    <div class="w-full">{{$request->start_date}}</div>
                    <div class="w-full">{{$request->state}}</div>
                    <div class="w-full">{{$request->status}}</div>
                    <div class="w-full  justify-between">
                        <button wire:click.prevent="showRequest({{ $request->id }})">View</button>
                        <button wire:click.prevent="openEditModal({{ $request->id }})">Update</button>
                        <button wire:click.prevent="openDeleteModal({{ $request->id }})">Delete</button>
                    </div>
                </div>
                @endforeach
                <div class="border rounded-sm pl-2 mt-2">{{ $ongoing->links() }}</div>
            @elseif($status === 'cancelled')
                @foreach($cancelled as $request)
                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$request->request_type}}</div>
                    <div class="w-full">{{$request->start_date}}</div>
                    <div class="w-full">{{$request->state}}</div>
                    <div class="w-full">{{$request->status}}</div>
                    <div class="w-full  justify-between">
                        <button wire:click.prevent="showRequest({{ $request->id }})">View</button>
                        <button wire:click.prevent="openEditModal({{ $request->id }})">Update</button>
                        <button wire:click.prevent="openDeleteModal({{ $request->id }})">Delete</button>
                    </div>
                </div>
                @endforeach
                <div class="border rounded-sm pl-2 mt-2">{{ $cancelled->links() }}</div>
                @elseif($status === 'closed')
                @foreach($closed as $request)
                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$request->request_type}}</div>
                    <div class="w-full">{{$request->start_date}}</div>
                    <div class="w-full">{{$request->state}}</div>
                    <div class="w-full">{{$request->status}}</div>
                    <div class="w-full  justify-between">
                        <button wire:click.prevent="showRequest({{ $request->id }})">View</button>
                        <button wire:click.prevent="openEditModal({{ $request->id }})">Update</button>
                        <button wire:click.prevent="openDeleteModal({{ $request->id }})">Delete</button>
                    </div>
                </div>
                @endforeach
                <div class="border rounded-sm pl-2 mt-2">{{ $closed->links() }}</div>
            @elseif($status === 'search')
                @foreach($queryRequests as $request)
                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                    <div class="w-full">{{$request->request_type}}</div>
                    <div class="w-full">{{$request->start_date}}</div>
                    <div class="w-full">{{$request->state}}</div>
                    <div class="w-full">{{$request->status}}</div>
                    <div class="w-full  justify-between">
                        <button wire:click.prevent="showRequest({{ $request->id }})">View</button>
                        <button wire:click.prevent="openEditModal({{ $request->id }})">Update</button>
                        <button wire:click.prevent="openDeleteModal({{ $request->id }})">Delete</button>
                    </div>
                </div>
                @endforeach
                <div class="border rounded-sm pl-2 mt-2">{{ $queryRequests->links() }}</div>
            @endif
        </div>
    </div>

    <!-- New Mobile View -->
    <div class="block sm:hidden border p-2 mb-1">
        <h2 class="text-xl font-bold mb-2">Tutor Requests</h2>

        <!-- Filter Buttons -->
        <div class="mb-4" x-data="{ activeStatus: @entangle('status') }">
            <!-- Search Bar -->
            <div class="mb-4">
                <input wire:click.prevent="$set('status', 'search')" :class="{ 'active': activeStatus === 'search' }"  type="text" wire:model.live="search" placeholder="Search requests..." class="rounded-md w-full p-1 border border-red-400 text-sm">
            </div>
            <div class="flex gap-2">
                <button wire:click.prevent="$set('status', 'all')" :class="{ 'active': activeStatus === 'all' }" class="flex-1 bg-cyan-600 p-2 rounded text-center">All</button>
                <button wire:click.prevent="$set('status', 'pending')" :class="{ 'active': activeStatus === 'pending' }" class="flex-1 bg-cyan-600 p-2 rounded text-center">Pending</button>
                <button wire:click.prevent="$set('status', 'ongoing')" :class="{ 'active': activeStatus === 'ongoing' }" class="flex-1 bg-cyan-600 p-2 rounded text-center">Ongoing</button>
                <button wire:click.prevent="$set('status', 'cancelled')" :class="{ 'active': activeStatus === 'cancelled' }" class="flex-1 bg-cyan-600 p-2 rounded text-center">Cancelled</button>
                <button wire:click.prevent="$set('status', 'closed')" :class="{ 'active': activeStatus === 'closed' }" class="flex-1 bg-cyan-600 p-2 rounded text-center">Closed</button>
            </div>
            
        </div>

        <!-- Requests List -->
        <div class="">
            @if($status === 'all' || $status === null)
                @foreach($tutorRequests as $request)
                    <div wire:key="request-{{ $request->id }}" class="border p-2 mb-2 rounded">
                        <div class="text-sm font-bold">Request Type: {{$request->request_type}}</div>
                        <div class="text-xs ">Start: {{$request->start_date}}</div>
                        <div class="text-xs ">State: {{$request->state}}</div>
                        <div class="text-xs ">Status: {{$request->status}}</div>
                        <div class="flex justify-between mt-2">
                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">{{ $tutorRequests->links() }}</div>
            @elseif($status === 'pending')
                @foreach($pending as $request)
                    <div wire:key="pending-{{ $request->id }}" class="border p-2 mb-2 rounded">
                        <div class="text-sm font-bold">Request Type: {{$request->request_type}}</div>
                        <div class="text-xs ">Start: {{$request->start_date}}</div>
                        <div class="text-xs ">State: {{$request->state}}</div>
                        <div class="text-xs ">Status: {{$request->status}}</div>
                        <div class="flex justify-between mt-2">
                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">{{ $pending->links() }}</div>
            @elseif($status === 'ongoing')
                @foreach($ongoing as $request)
                    <div wire:key="assigned-{{ $request->id }}" class="border p-2 mb-2 rounded">
                        <div class="text-sm font-bold">Request Type: {{$request->request_type}}</div>
                        <div class="text-xs ">Start: {{$request->start_date}}</div>
                        <div class="text-xs ">State: {{$request->state}}</div>
                        <div class="text-xs ">Status: {{$request->status}}</div>
                        <div class="flex justify-between mt-2">
                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">{{ $ongoing->links() }}</div>
            @elseif($status === 'cancelled')
                @foreach($cancelled as $request)
                    <div wire:key="cancelled-{{ $request->id }}" class="border p-2 mb-2 rounded">
                        <div class="text-sm font-bold">Request Type: {{$request->request_type}}</div>
                        <div class="text-xs ">Start: {{$request->start_date}}</div>
                        <div class="text-xs ">State: {{$request->state}}</div>
                        <div class="text-xs ">Status: {{$request->status}}</div>
                        <div class="flex justify-between mt-2">
                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">{{ $cancelled->links() }}</div>
                @elseif($status === 'closed')
                @foreach($closed as $request)
                    <div wire:key="cancelled-{{ $request->id }}" class="border p-2 mb-2 rounded">
                        <div class="text-sm font-bold">Request Type: {{$request->request_type}}</div>
                        <div class="text-xs ">Start: {{$request->start_date}}</div>
                        <div class="text-xs ">State: {{$request->state}}</div>
                        <div class="text-xs ">Status: {{$request->status}}</div>
                        <div class="flex justify-between mt-2">
                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">{{ $closed->links() }}</div>
            @elseif($status === 'search')
                @foreach($queryRequests as $request)
                    <div wire:key="search-{{ $request->id }}" class="border p-2 mb-2 rounded">
                        <div class="text-sm font-bold">Request Type: {{$request->request_type}}</div>
                        <div class="text-xs ">Start: {{$request->start_date}}</div>
                        <div class="text-xs ">State: {{$request->state}}</div>
                        <div class="text-xs ">Status: {{$request->status}}</div>
                        <div class="flex justify-between mt-2">
                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">{{ $queryRequests->links() }}</div>
            @endif
        </div>
    </div>


   <!-- Show Modal -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 overflow-y-auto">
        <div class="bg-gradient-to-r from-cyan-100 to-cyan-400 p-4 sm:p-6 rounded-lg shadow-lg mt-8 top-4 sm:mt-0 sm:top-0 w-full sm:w-auto max-w-lg sm:max-w-none">
            <div class="sm:hidden py-12"></div>
            <h2 class="block text-xl sm:text-2xl font-bold text-cyan-700 my-4">Tutor Request Details</h2>
            <div class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-4 mb-2 text-gray-900">
                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Start Date:</strong> {{ $selectedRequest->start_date }}</p>
                    <p><strong class="text-gray-700">State</strong> {{ $selectedRequest->state }}</p>
                    <p><strong class="text-gray-700">Address:</strong> {{ $selectedRequest->full_address }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Days & Times:</strong> {{ $selectedRequest->learnersGrade }}</p>
                    <p><strong class="text-gray-700">Request Type:</strong> {{ $selectedRequest->request_type }}</p>
                    <p><strong class="text-gray-700">Number of Learners:</strong> {{ $selectedRequest->learnersNumber }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Days Per Week:</strong> {{ $selectedRequest->daysPerWeek }}</p>
                    <p><strong class="text-gray-700">Class Days:</strong> {{ $selectedRequest->days }}</p>
                    <p><strong class="text-gray-700">Duration</strong> {{ $selectedRequest->duration }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <p><strong class="text-gray-700">Status:</strong> <span class="px-2 py-1 rounded-full text-white {{ $selectedRequest->status === 'Ongoing' ? 'bg-green-500' : 'bg-yellow-500' }}">{{ $selectedRequest->status }}</span></p>
                    <p><strong class="text-gray-700">Remarks:</strong> {{ $selectedRequest->remarks }}</p>
                </div>
            </div>
            @if ($selectedRequest->request_type === 'coding_tutor')
                <div class="bg-white p-4 rounded-lg shadow mb-4 text-gray-900">
                    <p><strong class="text-gray-700">Coding Languages:</strong> {{ $selectedRequest->laguages }}</p>
                    <p><strong class="text-gray-700">Class Type:</strong> {{ $selectedRequest->class_type }}</p>
                </div>
                @else
                <div class="bg-white p-4 rounded-lg shadow mb-4 text-gray-900">
                    <p><strong class="text-gray-700">School's Address:</strong> {{ $selectedRequest->laguages }}</p>
                    <p><strong class="text-gray-700">School Name</strong> {{ $selectedRequest->class_type }}</p>
                </div>
                @endif

            <button wire:click="closeModal" class="w-full sm:w-auto px-4 py-1 bg-red-600 text-gray-100 rounded-lg hover:bg-red-400">Close</button>
        </div>
    </div>
    @endif

    <!-- Delete Modal -->
    @if($deleteModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-red-100 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-red-700 mb-4">Delete Request</h2>
            <p class="text-gray-700 mb-6">Are you sure you want to delete this request? This action cannot be undone.</p>
        
            <div class="flex justify-end space-x-4">
                <button wire:click="deleteRequest" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Yes, Delete
                </button>
                <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    @endif
    <!-- Edit Modal -->
    @if($editModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Update Request Status</h2>
            
            <!-- Form fields -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select wire:model="status" id="status" class="block text-gray-900 w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Assigned">Assigned</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <button wire:click="updateRequest" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save
                </button>
                <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
