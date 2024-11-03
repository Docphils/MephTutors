<div class="grid sm:grid-cols-5 min-h-full">
    <!-- Sidebar-->
    <section class="flex justify-between sm:block bg-gradient-to-t from-cyan-500 to-cyan-900 shadow-lg shadow-cyan-600 sm:px-10 p-6 sm:py-10 border-l-4 min-h-full">
        <div class="block mb-6">
            <!-- Profile Display -->
            @if ($tutorProfile)
                <div class="sm:text-center mb-3">
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $tutorProfile->image) }}" alt="Profile image" class="h-14 w-14 rounded-full object-cover border-2 border-white shadow-sm shadow-white">
                    </div>
                    <div class="hidden sm:block mb-2">
                        <p class="font-semibold">{{ $tutorProfile->fullName }}</p>
                        <p class="text-xs text-green-400">{{ strToUpper($tutorProfile->user->role) }}</p>
                    </div>
                </div>
            @endif
        </div>
        <hr class="hidden sm:block w-full mb-6">
        <!--Menu Buttons-->
        <div class="text-xs md:text-base">
            <div class="sm:mb-4">
                <button type="button" wire:click.prevent="$set('mainPage', 'lessons')" class="flex gap-2 items-center">
                    <i class="fas fa-book text-cyan-100 w-6"></i><span>Lessons</span>
                </button>
            </div>
            <div class="sm:mb-4">
                <button type="button" wire:click.prevent="$set('mainPage', 'coding')" class="flex gap-2 items-center">
                    <i class="fas fa-code text-cyan-100 w-6"></i><span>Coding</span>
                </button>
            </div>
            <div class="sm:mb-4">
                <button type="button" wire:click.prevent="$set('mainPage', 'clubs')" class="flex gap-2 items-center">
                    <i class="fas fa-users text-cyan-100 w-6"></i><span>Clubs</span>
                </button>
            </div>
            <div class="sm:mb-4">
                <button type="button" wire:click.prevent="$set('mainPage', 'payments')" class="flex gap-2 items-center">
                    <i class="fas fa-money-bill-wave text-cyan-100 w-6"></i><span>Payments</span>
                </button>
            </div>
            <div class="sm:mb-4">
                <button type="button" wire:click.prevent="$set('createProfile', true)" class="flex gap-2 items-center">
                    <i class="fas fa-user text-cyan-100 w-6"></i><span>Profile</span>
                </button>
            </div>
            @if ($tutorProfile)
            <div class="sm:mb-4">
                <button type="button" wire:click.prevent="$set('tutorVideo', true)" class="flex gap-2 items-center">
                    <i class="fas fa-video text-cyan-100 w-6"></i><span>Upload Video</span>
                </button>
            </div> 
            @endif
            <div class="sm:mb-4">
                <a href="https://chat.whatsapp.com/Gum1YqOp0G31WlyyokKxE0" target="_blank" class="flex gap-2 items-center">
                    <i class="fab fa-whatsapp text-green-300 w-6"></i><span>Tutor community</span>
                </a>
            </div>
            
        </div>

    </section>
    
    <div class="sm:col-span-4 ">
        @if ($uploadVideo)
            <livewire:tutor.professional-video />
        @endif

        @if ($createProfile)
            <livewire:tutor.tutor-profiles @saved="close" />
        @endif
        
        <!-- Main-->
        <div class="relative w-full">
            <div wire:offline class="text-center text-red-600 bg-red-100 px-5 py-1 rounded">
                This device is currently offline.
            </div>
            <img src="/images/banner2.jpg" alt="Banner image" class="object-cover w-full max-h-24">
            <div class="absolute inset-0 items-center text-center py-6 text-lg sm:text-xl md:text-3xl font-semibold"><span class="bg-cyan-500 p-1 rounded-sm">Teach for Excellence with MephEd</span> </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-cyan-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl mb-4">Hello, {{ $user->name }}!</h3>    
                        @if (!$tutorProfile)
                            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                                <strong>Profile Incomplete!</strong> Please complete your profile to enjoy seemless services.
                            </div>
                        @endif
    
                        @if ($tutorVideo)
                            <livewire:tutor.video />
                        @endif
                        @if ($mainPage === 'lessons')
                            <livewire:tutor.lessons />
                        @elseif ($mainPage === 'payments') 
                            <livewire:tutor.payments />                                   
                        @else
                        
    
                        <div class="mt-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Pending Payments</h4>
                                    <h4 class="text-sm">Payment will be due once lesson is completed</h4>
                                    <p class="text-3xl mt-2 text-right">{{ $pendingPayments }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Earned Payments </h4>
                                    <h4 class="text-sm">Earned payments will be disbursed within 24hrs on business days</h4>
                                    <p class="text-3xl mt-2 text-right">{{ $earnedPayments }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Completed Payments </h4>
                                    <p class="text-3xl mt-2 text-right">{{ $completedPayments }}</p>
                                </div>
                                
                            </div>
                        </div>
     
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
