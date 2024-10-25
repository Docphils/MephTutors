<div class="grid sm:grid-cols-5">
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
        <div class="">
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
                <button type="button" wire:click.prevent="$set('mainPage', 'profile')" class="flex gap-2 items-center">
                    <i class="fas fa-user text-cyan-100 w-6"></i><span>Profile</span>
                </button>
            </div>
            <div class="sm:mb-4">
                <button type="button" wire:click.prevent="$set('mainPage', 'community')" class="flex gap-2 items-center">
                    <i class="fab fa-whatsapp text-green-300 w-6"></i><span>Tutor community</span>
                </button>
            </div>
            
        </div>

    </section>
    
    <div class="sm:col-span-4 ">
        
        <!-- Main-->
        <div class="relative w-full">
            <img src="/images/banner2.jpg" alt="Banner image" class="object-cover w-full max-h-24">
            <div class="absolute inset-0 items-center text-center py-6 text-lg sm:text-xl md:text-3xl font-semibold"><span class="bg-cyan-500 p-1 rounded-sm">Teach for Excellence with MephEd</span> </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-cyan-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl mb-4">Welcome, {{ $user->name }}!</h3>    
                        @if (!$tutorProfile)
                            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                                <strong>Profile Incomplete!</strong> Please complete your profile to enjoy seemless services.
                            </div>
                        @endif
    
                        @if ($mainPage === 'clubs')
                            <livewire:client.coding-and-clubs />
                        @elseif ($mainPage === 'coding') 
                            <livewire:client.coding-and-clubs-index />                                   
                        @else
                        
    
                        <div class="mt-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Earned Payments </h4>
                                    <h4 class="text-sm">Please review and approve within 24hrs</h4>
                                    <p class="text-3xl mt-2">{{ $earnedPayments }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Pending Payments</h4>
                                    <p class="text-3xl mt-2">{{ $pendingPayments }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Completed Payments </h4>
                                    <h4 class="text-sm">Please review and approve within 24hrs</h4>
                                    <p class="text-3xl mt-2">{{ $completedPayments }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Closed Lessons</h4>
                                    <p class="text-3xl mt-2">{{ $closedBookings->count() }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Completed Lessons </h4>
                                    <h4 class="text-sm">Please review and approve within 24hrs</h4>
                                    <p class="text-3xl mt-2">{{ $completedBookings->count() }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Closed Lessons</h4>
                                    <p class="text-3xl mt-2">{{ $closedBookings->count() }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Completed Lessons </h4>
                                    <h4 class="text-sm">Please review and approve within 24hrs</h4>
                                    <p class="text-3xl mt-2">{{ $completedBookings->count() }}</p>
                                </div>
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <h4 class="text-lg font-semibold">Closed Lessons</h4>
                                    <p class="text-3xl mt-2">{{ $closedBookings->count() }}</p>
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
