<div class="container mx-auto py-8 min-h-svh">
    <x-slot name="header" class="">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight flex items-center justify-between">
            <div class="">
                {{ __('Coding Tutor Requests') }}
            </div>

            <div class="">
                <a wire:navigate href="{{ route('client.dashboard') }}" class="text-cyan-50 bg-cyan-700 p-1 rounded-sm font-semibold hover:shadow-lg hover:shadow-cyan-400 hover:bg-cyan-800">Dashboard</a>
            </div>
        </h2>
        
    </x-slot>
    <div class="flex flex-col space-y-12">
        
        <!-- Coding Tutor Requests Section -->
        @if (!$makeRequest)
            <div class="bg-white shadow rounded-lg p-6 text-gray-900">
                @if (session('success'))
                    <div class="bg-green-50 p-1 my-1 text-green-600 ">
                        {{ session('success') }}
                    </div>
                @endif
                <button type="button" wire:click="$set('makeRequest', true)" class="p-2 rounded-sm mb-2 bg-cyan-900 hover:bg-cyan-700 text-white shadow-sm hover:shadow-lg">Get Coding Tutor</button>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Coding Tutor Requests</h2>

                @if($codingRequests->isNotEmpty())
                    <div class="overflow-x-auto">
                        <div class="w-full bg-gray-100 p-4">
                            <!-- Header for larger screens -->
                            <div class="hidden md:grid grid-cols-6 gap-4 bg-gray-300 py-3 px-4 rounded-md font-semibold text-gray-700">
                                <div>Start Date</div>
                                <div>State</div>
                                <div>Languages</div>
                                <div>Class Type</div>
                                <div>Status</div>
                                <div>Action</div>
                            </div>
                            
                            @foreach($codingRequests as $request)
                            <div class="bg-white shadow-md rounded-md p-4 mb-4 md:grid md:grid-cols-6 md:gap-4 items-center border">
                                <!-- For mobile, show each field in rows -->
                                <div class="md:hidden mb-2">
                                    <span class="block font-semibold text-gray-700">Start Date:</span>
                                    <span class="text-gray-600">{{ $request->start_date }}</span>
                                </div>
                                <div class="hidden md:block">{{ $request->start_date }}</div>
                                
                                <div class="md:hidden mb-2">
                                    <span class="block font-semibold text-gray-700">State:</span>
                                    <span class="text-gray-600">{{ $request->state }}</span>
                                </div>
                                <div class="hidden md:block">{{ $request->state }}</div>
                        
                                <div class="md:hidden mb-2">
                                    <span class="block font-semibold text-gray-700">Languages:</span>
                                    <span class="text-gray-600">{{ $request->languages }}</span>
                                </div>
                                <div class="hidden md:block">{{ $request->languages }}</div>
                        
                                <div class="md:hidden mb-2">
                                    <span class="block font-semibold text-gray-700">Class Type:</span>
                                    <span class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $request->class_type)) }}</span>
                                </div>
                                <div class="hidden md:block">{{ ucfirst(str_replace('_', ' ', $request->class_type)) }}</div>
                        
                                <!-- Status with badge styling -->
                                <div class="md:hidden mb-2">
                                    <span class="block font-semibold text-gray-700">Status:</span>
                                    <span class="inline-block px-3 py-1 text-xs rounded-full {{ $request->status == 'Ongoing' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                        {{ $request->status }}
                                    </span>
                                </div>
                                <div class="hidden md:block">
                                    <span class="inline-block px-3 py-1 text-xs rounded-full {{ $request->status == 'Ongoing' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                        {{ $request->status }}
                                    </span>
                                </div>
                        
                                <!-- Action button -->
                                <div class="">
                                    <button wire:click="show({{ $request->id }})" class="text-blue-500 hover:text-blue-700 underline">Details</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="mt-4">
                        {{ $codingRequests->links() }}
                    </div>
                @else
                    <p class="text-gray-600">No coding tutor requests found.</p>
                @endif
            </div>
        @endif

        @if($selectedRequest)
            <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 text-gray-900">
                <div class="reltive w-full max-w-3xl max-h-[80vh] bg-white rounded-lg shadow-lg overflow-x-hidden">
                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-sky-500 to-cyan-600 text-white px-6 py-4 flex justify-between">
                        <h3 class="text-lg font-semibold">Request Details</h3>
                        <p class="text-red-500 font-bold text-xl"><button type="button" wire:click="close">X</button></p>
                    </div>
        
                    <!-- Modal Content -->
                    <div class="p-6 space-y-6">
        
                        <!-- General Information Card -->
                        <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-md shadow">
                            <h4 class="font-semibold text-green-700 mb-2">General Information</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div><strong>Request Type:</strong> {{ ucfirst(str_replace('_', ' ', $selectedRequest->request_type)) }}</div>
                                <div><strong>Start Date:</strong> {{ $selectedRequest->start_date }}</div>
                                <div><strong>Status:</strong>
                                    <span class="inline-block px-3 py-1 rounded-full text-white {{ $selectedRequest->status == 'Ongoing' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                        {{ $selectedRequest->status }}
                                    </span>
                                </div>
                                <div><strong>State:</strong> {{ $selectedRequest->state }}</div>
                            </div>
                        </div>
        
                            <!-- Coding Tutor Specific Card -->
                            <div class="bg-blue-100 border-l-4 border-blue-500 p-4 rounded-md shadow">
                                <h4 class="font-semibold text-blue-700 mb-2">Coding Tutor Details</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div><strong>Languages:</strong> {{ $selectedRequest->languages ?? 'N/A' }}</div>
                                    <div><strong>Class Type:</strong> {{ ucfirst(str_replace('_', ' ', $selectedRequest->class_type)) }}</div>
                                    <div><strong>Learners:</strong> {{ $selectedRequest->learnersNumber }}</div>
                                </div>
                            </div>
                       
                        <!-- Remarks Card -->
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded-md shadow">
                            <h4 class="font-semibold text-yellow-700 mb-2">Remarks</h4>
                            <div>{{ $selectedRequest->remarks ?? 'N/A' }}</div>
                        </div>
        
                    </div>
                </div>
            </div>
        @endif
        @if ($makeRequest)
            <form wire:submit.prevent="submit" class="space-y-6 bg-white p-6 text-gray-900 rounded-md mx-8">
                <div class="text-xl font-semibold">Request Coding Tutor</div>
                <!-- Common Fields -->
                <div class="grid grid-cols-1 gap-4">
                    
                    <div class="sm:flex sm:gap-4">
                        <!-- Start Date -->
                        <div class="w-full">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" id="start_date" wire:model="start_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
        
                        <!-- State -->
                        <div class="w-full">
                            <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                            <select id="state" wire:model="state" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select State</option>
                                <option value="Abia">Abia</option>
                                <option value="Adamawa">Adamawa</option>
                                <option value="AkwaIbom">Akwa Ibom</option>
                                <option value="Anambra">Anambra</option>
                                <option value="Bauchi">Bauchi</option>
                                <option value="Bayelsa">Bayelsa</option>
                                <option value="Benue">Benue</option>
                                <option value="Borno">Borno</option>
                                <option value="CrossRiver">Cross River</option>
                                <option value="Delta">Delta</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Edo">Edo</option>
                                <option value="Enugu">Enugu</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Jigawa">Jigawa</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Imo">Imo</option>
                                <option value="Kaduna">Kaduna</option>
                                <option value="Kano">Kano</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kebbi">Kebbi</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Nasarawa">Nasarawa</option>
                                <option value="Niger">Niger</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Osun">Osun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Sokoto">Sokoto</option>
                                <option value="Taraba">Taraba</option>
                                <option value="Yobe">Yobe</option>
                                <option value="Zamfara">Zamfara</option>
                                <option value="FCT">FCT</option>
                            </select>
                            @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
        
                    </div>
                
                    <!-- Full Address -->
                    <div>
                        <label for="full_address" class="block text-sm font-medium text-gray-700">Full Address</label>
                        <input type="text" id="full_address" wire:model="full_address" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('full_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
        
                    <div class="sm:flex sm:gap-4">
                        <!-- Learner's Grade -->
                        <div class="w-full">
                            <label for="learnersGrade" class="block text-sm font-medium text-gray-700">Learners' Age Grade</label>
                            <select id="learnersGrade" wire:model="learnersGrade" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select Grade</option>
                                <option value="under_12">Under 12</option>
                                <option value="teen">Teen</option>
                                <option value="adult">Adult</option>
                            </select>
                            @error('learnersGrade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <!-- Learner's Number -->
                        <div class="w-full">
                            <label for="learnersNumber" class="block text-sm font-medium text-gray-700">Number of Learners</label>
                            <input type="number" id="learnersNumber" wire:model="learnersNumber" required min="1"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('learnersNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                
                    <div class="sm:flex sm:gap-4">
                        <!-- Days Per Week -->
                        <div class="w-full">
                            <label for="daysPerWeek" class="block text-sm font-medium text-gray-700">Days Per Week</label>
                            <input type="number" id="daysPerWeek" wire:model="daysPerWeek" required min="1" max="7"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('daysPerWeek') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <!-- Duration -->
                        <div class="w-full">
                            <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                            <input type="text" id="duration" wire:model="duration" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="sm:flex sm:gap-4">
                        <!-- Days -->
                        <div class="w-full">
                            <label for="days" class="block text-sm font-medium text-gray-700">Days of the Week</label>
                            <input type="text" id="days" wire:model="days" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
        
                        <!-- Request Type -->
                        <div class="w-full hidden">
                            <label for="request_type" class="block text-sm font-medium text-gray-700">Request Type</label>
                            <select id="request_type" wire:model.live="request_type"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select Request Type</option>
                                <option value="coding_tutor" selected>Private Coding Tutor</option>
                            </select>
                            @error('request_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                
                </div>
        
                <!-- Conditional Fields for Coding Tutor -->
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="languages" class="block text-sm font-medium text-gray-700">Programming Languages</label>
                        <input type="text" id="languages" wire:model="languages" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('languages') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
        
                    <div>
                        <label for="class_type" class="block text-sm font-medium text-gray-700">Class Type</label>
                        <select id="class_type" wire:model="class_type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Select Type</option>
                            <option value="home_tutoring">Home Tutoring</option>
                            <option value="online">Online</option>
                        </select>
                        @error('class_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
        
        
                <!-- Remarks -->
                <div>
                    <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                    <textarea id="remarks" wire:model="remarks"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    @error('remarks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        
                <!-- Submit Button -->
                <div class="flex justify-between">
                    <button type="reset" wire:click="$set('makeRequest', null)" class="py-2 px-4 rounded-md bg-gray-300 hover:bg-red-500 text-gray-900 shadow-sm hover:shadow-lg">Close</button>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-900 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>
            </form>
        @endif
        
    </div>

</div>

