<x-app-layout>
    <div class="py-12">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl text-cyan-900 font-bold mb-6">Get Coding/Music tutor, or School Club Instructors</h3>

                    <form action="{{ route('client.crm.store') }}" method="POST">
                        @csrf

                        <!-- Start Date -->
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium">Proposed Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- State -->
                        <div class="mb-4">
                            <label for="state" class="block text-sm font-medium">State of Residence</label>
                            <select name="state" id="state" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Imo">Imo</option>
                                <option value="Jigawa">Jigawa</option>
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
                                <option value="FCT">Federal Capital Territory (FCT)</option>                                
                            </select>
                            @error('state')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Full Address -->
                        <div class="mb-4">
                            <label for="full_address" class="block text-sm font-medium">Full Address</label>
                            <input type="text" name="full_address" id="full_address" value="{{ old('full_address') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('full_address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Learners Grade -->
                        <div class="mb-4">
                            <label for="learnersGrade" class="block text-sm font-medium">Learners Category</label>
                            <select name="learnersGrade" id="learnersGrade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Grade</option>
                                <option value="under_12">Under 12</option>
                                <option value="teen">Teen</option>
                                <option value="adult">Adult</option>
                            </select>
                            @error('learnersGrade')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Learners Number -->
                        <div class="mb-4">
                            <label for="learnersNumber" class="block text-sm font-medium">Number of Learners</label>
                            <input type="number" name="learnersNumber" id="learnersNumber" value="{{ old('learnersNumber') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('learnersNumber')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Days Per Week -->
                        <div class="mb-4">
                            <label for="daysPerWeek" class="block text-sm font-medium">How Many Days Per Week</label>
                            <input type="number" name="daysPerWeek" id="daysPerWeek" max="7" value="{{ old('daysPerWeek') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('daysPerWeek')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Days -->
                        <div class="mb-4">
                            <label for="days" class="block text-sm font-medium">Preferred Days of the Week</label>
                            <input type="text" name="days" id="days" value="{{ old('days') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('days')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium">Duration Per Day</label>
                            <input type="text" name="duration" id="duration" value="{{ old('duration') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('duration')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                         <!-- Request Type -->
                         <div class="mb-4">
                            <label for="request_type" class="block text-sm font-medium">Request Type</label>
                            <select name="request_type" id="request_type" onclick="showfields()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Type</option>
                                <option value="coding_tutor">Coding Tutor</option>
                                <option value="club">Club</option>
                            </select>
                            @error('request_type')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Conditional Fields for Coding Tutor -->
                        <div class="hidden" id="coding_tutor">
                            <!-- Languages -->
                            <div class="mb-4">
                                <label for="languages" class="block text-sm font-medium">Preferred Programming Languages</label>
                                <input type="text" name="languages" id="languages" value="{{ old('languages') }}" placeholder="Scratch, HTML, Python, ..." class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('languages')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Class Type -->
                            <div class="mb-4">
                                <label for="class_type" class="block text-sm font-medium">Class Type</label>
                                <select name="class_type" id="class_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Select Type</option>
                                    <option value="home_tutoring">Home Tutoring</option>
                                    <option value="online">Online</option>
                                </select>
                                @error('class_type')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Conditional Fields for Club -->
                        <div class="hidden" id="club" >
                            <!-- School Name -->
                            <div class="mb-4">
                                <label for="school_name" class="block text-sm font-medium">School Name</label>
                                <input type="text" name="school_name" id="school_name" value="{{ old('school_name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('school_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- School Address -->
                            <div class="mb-4">
                                <label for="school_address" class="block text-sm font-medium">School Address</label>
                                <input type="text" name="school_address" id="school_address" value="{{ old('school_address') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('school_address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="mb-4">
                            <label for="remarks" class="block text-sm font-medium">Remarks</label>
                            <textarea name="remarks" id="remarks" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                           
                        <!-- Submit Button -->
                        <div class="mb-4 text-right">
                            <button type="submit" class="bg-cyan-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
     <script>
        document.getElementById('request_type').addEventListener('change', function() {
            const element = document.getElementById('coding_tutor');
            if (this.value === 'coding_tutor') {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        });
        document.getElementById('request_type').addEventListener('change', function() {
            const element = document.getElementById('club');
            if (this.value === 'club') {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
