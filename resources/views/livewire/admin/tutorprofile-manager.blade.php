<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Tabs for Qualification and Discipline Filtering -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-black">Tutor Profiles</h2>

        <input type="text" wire:model.debounce.300ms="search" placeholder="Search by name..." class="px-4 py-2 border rounded-lg w-1/3 mb-4">

        <div class="lg:flex gap-2 mb-6 space-y-2 lg:space-y-0">
            <!-- Qualification Tabs -->
            <button wire:click="setTab('All')" class="px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-600 {{ $activeTab == 'All' ? 'font-bold' : '' }}">
                All
            </button>
            <button wire:click="setTab('SSCE')" class="px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-600 {{ $activeTab == 'SSCE' ? 'font-bold' : '' }}">
                SSCE
            </button>
            <button wire:click="setTab('Diploma')" class="px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-600 {{ $activeTab == 'Diploma' ? 'font-bold' : '' }}">
                Diploma
            </button>
            <button wire:click="setTab('NCE')" class="px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-600 {{ $activeTab == 'NCE' ? 'font-bold' : '' }}">
                NCE
            </button>
            <button wire:click="setTab('HND/BSc/BEd/BA/BEng')" class="px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-600 {{ $activeTab == 'HND/BSc/BEd/BA/BEng' ? 'font-bold' : '' }}">
                Degree
            </button>
            <button wire:click="setTab('MSc/MA')" class="px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-600 {{ $activeTab == 'MSc/MA' ? 'font-bold' : '' }}">
                MSc/MA
            </button>
            <button wire:click="setTab('PhD')" class="px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-600 {{ $activeTab == 'PhD' ? 'font-bold' : '' }}">
                PhD
            </button>

            <!-- Discipline Tabs -->
            <button wire:click="setTab('Science')" class="px-4 py-2 rounded-lg text-white bg-teal-500 hover:bg-teal-600 {{ $activeTab == 'Science' ? 'font-bold' : '' }}">
                Science
            </button>
            <button wire:click="setTab('Arts')" class="px-4 py-2 rounded-lg text-white bg-teal-500 hover:bg-teal-600 {{ $activeTab == 'Arts' ? 'font-bold' : '' }}">
                Arts
            </button>
            <button wire:click="setTab('Commerce')" class="px-4 py-2 rounded-lg text-white bg-teal-500 hover:bg-teal-600 {{ $activeTab == 'Commerce' ? 'font-bold' : '' }}">
                Commerce
            </button>
        </div>
    </div>

    <!-- Display Tutor Profiles -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="min-w-full divide-y divide-gray-200">
            <div class="bg-gray-50">
                <div class="grid grid-cols-5">
                    <div class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase divacking-wider">Full Name</div>
                    <div class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qual.</div>
                    <div class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exp.</div>
                    <div class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</div>
                    <div class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</div>
                </div>
            </div>
            <div class="bg-white divide-y divide-gray-200">
                @foreach($tutorProfiles as $profile)
                <div class="grid grid-cols-5">
                    <div class="px-4 py-3 text-sm text-gray-700">{{ $profile->fullName }}</div>
                    <div class="px-4 py-3 text-sm text-gray-700">{{ $profile->qualification }}</div>
                    <div class="px-4 py-3 text-sm text-gray-700">{{ $profile->experience }}</div>
                    <div class="px-4 py-3 text-sm text-gray-700">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $profile->status == 'Approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $profile->status }}
                        </span>
                    </div>
                    <div class="px-4 py-3 text-sm text-gray-700">
                        <button wire:click="showTutorProfile({{ $profile->id }})" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">Show</button>
                        <button wire:click="editTutorProfile({{ $profile->id }})" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="p-4">
            {{ $tutorProfiles->links() }}
        </div>
    </div>

     <!-- Detail Modal -->
     @if($showDetailModal)
     <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 text-black">
         <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
             <h3 class="text-lg font-semibold mb-4">Tutor Profile Details</h3>
             <p><strong>Full Name:</strong> {{ $selectedProfile->fullName }}</p>
             <p><strong>Qualification:</strong> {{ $selectedProfile->qualification }}</p>
             <p><strong>Discipline:</strong> {{ $selectedProfile->discipline }}</p>
             <p><strong>Experience:</strong> {{ $selectedProfile->experience }}</p>
             <p><strong>Status:</strong> {{ $selectedProfile->status }}</p>
             <div class="mt-4 flex justify-end">
                 <button wire:click="$set('showDetailModal', false)" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Close</button>
             </div>
         </div>
     </div>
     @endif

    <!-- Modal for Editing Status and Approval Remark -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-black">
            <h3 class="text-lg font-semibold mb-4">Edit Tutor Profile</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select wire:model="status" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select Status</option>
                    <option value="Approved">Approved</option>
                    <option value="Review">Review</option>
                </select>
                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Approval Remark</label>
                <textarea wire:model="approvalRemark" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="3"></textarea>
                @error('approvalRemark') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                <button wire:click="saveTutorProfile" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
            </div>
        </div>
    </div>
    @endif
</div>
