<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mb-4">
    <form wire:submit.prevent="submit" class="space-y-6">
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
                <div class="w-full">
                    <label for="request_type" class="block text-sm font-medium text-gray-700">Request Type</label>
                    <select id="request_type" wire:model.live="request_type"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Select Request Type</option>
                        <option value="coding_tutor">Private Coding Tutor</option>
                        <option value="club">School Club Instructor</option>
                    </select>
                    @error('request_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
           
        </div>

        <!-- Conditional Fields for Coding Tutor -->
        @if ($request_type === 'coding_tutor')
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
                    <option value="home_tutoring">Home Tutoring</option>
                    <option value="online">Online</option>
                </select>
                @error('class_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif

        <!-- Conditional Fields for Club -->
        @if ($request_type === 'club')
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="club_type" class="block text-sm font-medium text-gray-700">Club Type</label>
                <select id="club_type" wire:model="club_type" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="Coding">Coding</option>
                    <option value="Music">Music</option>
                    <option value="Chess">Chess</option>
                    <option value="STEM">STEM</option>
                    <option value="Taekwando">Taekwando</option>
                    <option value="Others">Others</option>
                </select>
                @error('club_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="school_name" class="block text-sm font-medium text-gray-700">School Name</label>
                <input type="text" id="school_name" wire:model="school_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('school_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="school_address" class="block text-sm font-medium text-gray-700">School Address</label>
                <input type="text" id="school_address" wire:model="school_address" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('school_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

        </div>
        @endif

        <!-- Remarks -->
        <div>
            <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
            <textarea id="remarks" wire:model="remarks"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
            @error('remarks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </form>
</div>
