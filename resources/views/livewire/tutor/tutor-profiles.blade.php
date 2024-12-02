<div  class="fixed inset-0 flex items-center justify-center z-50">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black opacity-50"></div>

    @if ($tutorProfile && !$show)
        <div class="max-w-3xl mx-auto px-10 py-6 bg-white shadow-md rounded-lg max-h-[80vh] overflow-y-auto relative text-black grid">
            <button type="button" class="text-right text-red-400 hover:text-red-600 text-sm font-semibold mb-2" wire:click.prevent="close"> Close </button>
            <button type="button" wire:click.prevent="loadProfile({{$tutorProfile->id}})" class="text-lg font-semibold text-cyan-600 hover:underline hover:text-cyan-700">Edit Profile</button>
        </div>

    @endif

    @if ($show)
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg max-h-[80vh] overflow-y-auto relative text-black">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700">Tutor Profile</h2>
            <button type="button" wire:click.prevent="close" class="text-right text-red-400 hover:text-red-600 text-sm font-semibold mb-2">x</button>
        </div>

        <form wire:submit.prevent="store" class="space-y-4">
        
            <!-- Address -->
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700">Full name</label>
                <input type="text" wire:model="fullName" id="fullname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('fullName') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" wire:model="address" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('address') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class=" sm:flex sm:justify-between gap-4">
                <!-- Phone -->
                <div class="w-full">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" wire:model="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <!-- Gender -->
                <div  class="w-full">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select wire:model="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            

            <div class=" sm:flex sm:justify-between gap-4">
                <!-- Qualification -->
                <div class="w-full">
                    <label for="qualification" class="block text-sm font-medium text-gray-700">Qualification</label>
                    <select wire:model="qualification" id="qualification" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Select Qualification</option>
                        <option value="SSCE">SSCE</option>
                        <option value="Diploma">Diploma</option>
                        <option value="NCE">NCE</option>
                        <option value="HND/BSc/BEd/BA/BEng">HND/BSc/BEd/BA/BEng</option>
                        <option value="MSc/MA">MSc/MA</option>
                        <option value="PhD">PhD</option>
                    </select>
                    @error('qualification') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Experience -->
                <div class="w-full">
                    <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
                    <select wire:model="experience" id="experience" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Select Experience</option>
                        <option value="0-1 year">0-1 year</option>
                        <option value="2-5 years">2-5 years</option>
                        <option value="6-10 years">6-10 years</option>
                        <option value="Above 10 years">Above 10 years</option>
                    </select>
                    @error('experience') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class=" sm:flex sm:justify-between gap-4">
                <!-- Discipline -->
                <div class="w-full">
                    <label for="discipline" class="block text-sm font-medium text-gray-700">Discipline</label>
                    <input type="text" wire:model="discipline" id="discipline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('discipline') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <!-- Date of Birth -->
                <div class="w-full">
                    <label for="DOB" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" wire:model="DOB" id="DOB" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('DOB') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Career Profile -->
            <div>
                <label for="careerProfile" class="block text-sm font-medium text-gray-700">Career Profile</label>
                <textarea wire:model="careerProfile" id="careerProfile" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('careerProfile') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class=" sm:flex sm:justify-between gap-4">
                <!-- Bank Name -->
                <div class="w-full">
                    <label for="bankName" class="block text-sm font-medium text-gray-700">Bank Name</label>
                    <input type="text" wire:model="bankName" id="bankName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('bankName') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Account Name -->
                <div class="w-full">
                    <label for="accountName" class="block text-sm font-medium text-gray-700">Account Name</label>
                    <input type="text" wire:model="accountName" id="accountName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('accountName') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Account Number -->
            <div>
                <label for="accountNumber" class="block text-sm font-medium text-gray-700">Account Number</label>
                <input type="text" wire:model="accountNumber" id="accountNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('accountNumber') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class=" sm:flex sm:justify-between gap-4">
                <!-- Profile Image -->
                <div class="w-full">
                    <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
                    <input type="file" wire:model="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- CV Upload -->
                <div class="w-full">
                    <label for="CV" class="block text-sm font-medium text-gray-700">CV (PDF or DOC)</label>
                    <input type="file" wire:model="CV" id="CV" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('CV') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    {{ $tutorProfileId ? 'Update Profile' : 'Create Profile' }}
                </button>
            </div>

            <!-- Success Message -->
            @if (session()->has('success'))
                <div class="mt-4 text-green-600 text-sm">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>
    @endif

</div>