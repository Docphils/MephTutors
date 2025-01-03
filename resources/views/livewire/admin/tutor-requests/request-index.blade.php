<div>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-100leading-tight">
            {{ __('Manage Requests') }}
        </h2>
    </x-slot>
    

    @if(session('success'))
        <div class="bg-green-50 text-green-600 mb-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-8  bg-cyan-500">
        <div class=" flex my-2 px-6 sm:px-16 justify-between mx-auto ">
            <a href="{{route('admin.dashboard')}}" wire:navigate class="bg-cyan-700 shadow-md hover:shadow-md shadow-cyan-500 p-2 rounded-sm">Back to Dashboard</a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class=" bg-cyan-50  overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    
                    <!-- Main component content-->
                    <div class="hidden sm:block border p-2 mb-1">
                        <div class="flex justify-between"> 
                            <h2 class="text-2xl font-bold mb-2">Tutor Requests</h2>
                        </div>
                        <nav class="sm:flex bg-cyan-800 text-white border mb-4 gap-4" x-data="{ activeStatus: @entangle('status') }">
                            <button wire:click.prevent="$set('status', 'all')" :class="{ 'active': activeStatus === 'all'}" class="border-r w-full">All</button>
                            <button wire:click.prevent="$set('status', 'pending')" :class="{ 'active': activeStatus === 'pending' }" class="border-r w-full" >Pending</button>
                            <button wire:click.prevent="$set('status', 'assigned')" :class="{ 'active': activeStatus === 'assigned' }" class="border-r w-full">Assigned</button>
                            <button wire:click.prevent="$set('status', 'cancelled')" :class="{ 'active': activeStatus === 'cancelled' }" class="border-r w-full">Cancelled</button>       
                            <input wire:click.prevent="$set('status', 'search')" type="text" wire:model.live="search" placeholder="Search requests..." class="rounded-md w-full p-1 border-red-400 text-sm">
                        </nav>
                
                
                        <div class="">
                            <div class="flex justify-between text-cyan-900 font-bold mb-2 mx-auto w-full">
                                <div class="w-full">Learner's Name</div>
                                <div class="w-full">Proposed Start Date</div>
                                <div class="w-full">Location</div>
                                <div class="w-full">Status</div>
                                <div class="w-full">Actions</div>
                            </div>
                            @if($status === 'all'||$status === null)
                            @foreach($tutorRequests as $request)
                                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                                    <div class="w-full">{{$request->learners}}</div>
                                    <div class="w-full">{{$request->start_date}}</div>
                                    <div class="w-full">{{$request->location}}</div>
                                    <div class="w-full">{{$request->status}}</div>
                                    <div class="w-full flex justify-between">
                                        <button wire:click.prevent="showRequest({{ $request->id }})"  class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openEditModal({{ $request->id }})"  class="w-full"><i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="w-full"><i class="fas fa-trash text-red-400 hover:text-red-600 hover:shadow-lg"></i></button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="border rounded-sm pl-2 mt-2">{{ $tutorRequests->links() }}</div>
                            @elseif($status === 'pending')
                                @foreach($pending as $request)
                                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                                    <div class="w-full">{{$request->learners}}</div>
                                    <div class="w-full">{{$request->start_date}}</div>
                                    <div class="w-full">{{$request->location}}</div>
                                    <div class="w-full">{{$request->status}}</div>
                                    <div class="w-full flex justify-between">
                                        <button wire:click.prevent="showRequest({{ $request->id }})"  class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openEditModal({{ $request->id }})"  class="w-full"><i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="w-full"><i class="fas fa-trash text-red-400 hover:text-red-600 hover:shadow-lg"></i></button>
                                    </div>
                                </div>
                                @endforeach
                                <div class="border rounded-sm pl-2 mt-2">{{ $pending->links() }}</div>
                            @elseif($status === 'assigned')
                                @foreach($assigned as $request)
                                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                                    <div class="w-full">{{$request->learners}}</div>
                                    <div class="w-full">{{$request->start_date}}</div>
                                    <div class="w-full">{{$request->location}}</div>
                                    <div class="w-full">{{$request->status}}</div>
                                    <div class="w-full flex justify-between">
                                        <button wire:click.prevent="showRequest({{ $request->id }})"  class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openEditModal({{ $request->id }})"  class="w-full"><i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="w-full"><i class="fas fa-trash text-red-400 hover:text-red-600 hover:shadow-lg"></i></button>
                                    </div>
                                </div>
                                @endforeach
                                <div class="border rounded-sm pl-2 mt-2">{{ $assigned->links() }}</div>
                            @elseif($status === 'cancelled')
                                @foreach($cancelled as $request)
                                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                                    <div class="w-full">{{$request->learners}}</div>
                                    <div class="w-full">{{$request->start_date}}</div>
                                    <div class="w-full">{{$request->location}}</div>
                                    <div class="w-full">{{$request->status}}</div>
                                    <div class="w-full flex justify-between">
                                        <button wire:click.prevent="showRequest({{ $request->id }})"  class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openEditModal({{ $request->id }})"  class="w-full"><i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="w-full"><i class="fas fa-trash text-red-400 hover:text-red-600 hover:shadow-lg"></i></button>
                                    </div>
                                </div>
                                @endforeach
                                <div class="border rounded-sm pl-2 mt-2">{{ $cancelled->links() }}</div>
                            @elseif($status === 'search')
                                @foreach($queryRequests as $request)
                                <div wire:key="$request->id" class="flex justify-between mx-auto w-full">
                                    <div class="w-full">{{$request->learners}}</div>
                                    <div class="w-full">{{$request->start_date}}</div>
                                    <div class="w-full">{{$request->location}}</div>
                                    <div class="w-full">{{$request->status}}</div>
                                    <div class="w-full flex justify-between">
                                        <button wire:click.prevent="showRequest({{ $request->id }})"  class="w-full"><i class="fas fa-eye text-cyan-600 hover:text-cyan-800 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openEditModal({{ $request->id }})"  class="w-full"><i class="fas fa-edit text-yellow-400 hover:text-yellow-600 hover:shadow-lg"></i></button>
                                        <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="w-full"><i class="fas fa-trash text-red-400 hover:text-red-600 hover:shadow-lg"></i></button>
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
                            <div class="flex gap-2 text-sm">
                                <button wire:click.prevent="$set('status', 'all')" :class="{ 'active': activeStatus === 'all' }" class="flex-1 bg-gray-200 p-2 rounded text-center">All</button>
                                <button wire:click.prevent="$set('status', 'pending')" :class="{ 'active': activeStatus === 'pending' }" class="flex-1 bg-gray-200 p-2 rounded text-center">Pending</button>
                                <button wire:click.prevent="$set('status', 'assigned')" :class="{ 'active': activeStatus === 'assigned' }" class="flex-1 bg-gray-200 p-2 rounded text-center">Assigned</button>
                                <button wire:click.prevent="$set('status', 'cancelled')" :class="{ 'active': activeStatus === 'cancelled' }" class="flex-1 bg-gray-200 p-2 rounded text-center">Cancelled</button>
                            </div>
                            
                        </div>
                
                        <!-- Requests List -->
                        <div>
                            @if($status === 'all' || $status === null)
                                @foreach($tutorRequests as $request)
                                    <div wire:key="request-{{ $request->id }}" class="border p-2 mb-2 rounded">
                                        <div class="text-sm font-bold">{{$request->learners}}</div>
                                        <div class="text-xs text-gray-500">Start: {{$request->start_date}}</div>
                                        <div class="text-xs text-gray-500">Location: {{$request->location}}</div>
                                        <div class="text-xs text-gray-500">Status: {{$request->status}}</div>
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
                                        <div class="text-sm font-bold">{{$request->learners}}</div>
                                        <div class="text-xs text-gray-500">Start: {{$request->start_date}}</div>
                                        <div class="text-xs text-gray-500">Location: {{$request->location}}</div>
                                        <div class="text-xs text-gray-500">Status: {{$request->status}}</div>
                                        <div class="flex justify-between mt-2">
                                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mt-2">{{ $pending->links() }}</div>
                            @elseif($status === 'assigned')
                                @foreach($assigned as $request)
                                    <div wire:key="assigned-{{ $request->id }}" class="border p-2 mb-2 rounded">
                                        <div class="text-sm font-bold">{{$request->learners}}</div>
                                        <div class="text-xs text-gray-500">Start: {{$request->start_date}}</div>
                                        <div class="text-xs text-gray-500">Location: {{$request->location}}</div>
                                        <div class="text-xs text-gray-500">Status: {{$request->status}}</div>
                                        <div class="flex justify-between mt-2">
                                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mt-2">{{ $assigned->links() }}</div>
                            @elseif($status === 'cancelled')
                                @foreach($cancelled as $request)
                                    <div wire:key="cancelled-{{ $request->id }}" class="border p-2 mb-2 rounded">
                                        <div class="text-sm font-bold">{{$request->learners}}</div>
                                        <div class="text-xs text-gray-500">Start: {{$request->start_date}}</div>
                                        <div class="text-xs text-gray-500">Location: {{$request->location}}</div>
                                        <div class="text-xs text-gray-500">Status: {{$request->status}}</div>
                                        <div class="flex justify-between mt-2">
                                            <button wire:click.prevent="showRequest({{ $request->id }})" class="text-blue-500">View</button>
                                            <button wire:click.prevent="openEditModal({{ $request->id }})" class="text-yellow-500">Update</button>
                                            <button wire:click.prevent="openDeleteModal({{ $request->id }})" class="text-red-500">Delete</button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mt-2">{{ $cancelled->links() }}</div>
                            @elseif($status === 'search')
                                @foreach($queryRequests as $request)
                                    <div wire:key="search-{{ $request->id }}" class="border p-2 mb-2 rounded">
                                        <div class="text-sm font-bold">{{$request->learners}}</div>
                                        <div class="text-xs text-gray-500">Start: {{$request->start_date}}</div>
                                        <div class="text-xs text-gray-500">Location: {{$request->location}}</div>
                                        <div class="text-xs text-gray-500">Status: {{$request->status}}</div>
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
                            <div class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-4">
                                <div class="bg-white p-4 rounded-lg shadow">
                                    <p><strong class="text-gray-700">Start Date:</strong> {{ $selectedRequest->start_date }}</p>
                                    <p><strong class="text-gray-700">End Date:</strong> {{ $selectedRequest->end_date }}</p>
                                    <p><strong class="text-gray-700">Location:</strong> {{ $selectedRequest->location }}</p>
                                </div>
                
                                <div class="bg-white p-4 rounded-lg shadow">
                                    <p><strong class="text-gray-700">Days & Times:</strong> {{ $selectedRequest->days_times }}</p>
                                    <p><strong class="text-gray-700">Subjects:</strong> {{ $selectedRequest->subjects }}</p>
                                    <p><strong class="text-gray-700">Learners:</strong> {{ $selectedRequest->learners }}</p>
                                </div>
                
                                <div class="bg-white p-4 rounded-lg shadow">
                                    <p><strong class="text-gray-700">Sessions:</strong> {{ $selectedRequest->sessions }}</p>
                                    <p><strong class="text-gray-700">Duration:</strong> {{ $selectedRequest->duration }}</p>
                                    <p><strong class="text-gray-700">Tutor Gender:</strong> {{ $selectedRequest->tutor_gender }}</p>
                                </div>
                
                                <div class="bg-white p-4 rounded-lg shadow">
                                    <p><strong class="text-gray-700">Curriculum:</strong> {{ $selectedRequest->curriculum }}</p>
                                    <p><strong class="text-gray-700">Amount:</strong> NGN {{ $selectedRequest->amount }}</p>
                                    <p><strong class="text-gray-700">Status:</strong> <span class="px-2 py-1 rounded-full text-white {{ $selectedRequest->status === 'Assigned' ? 'bg-green-500' : 'bg-yellow-500' }}">{{ $selectedRequest->status }}</span></p>
                                </div>
                            </div>
                
                            <div class="bg-white p-4 rounded-lg shadow my-4">
                                <p><strong class="text-gray-700">Remarks:</strong> {{ $selectedRequest->remarks }}</p>
                            </div>
                            
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
                                <select wire:model="status" id="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
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
            </div>
        </div>
    </div>

    @include('layouts.footer') 
</div>
