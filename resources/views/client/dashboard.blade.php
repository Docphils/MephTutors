<x-app-layout>
    <div class="grid sm:grid-cols-5">
        <!-- Sidebar-->
        <section class="flex justify-between sm:block bg-gradient-to-t from-cyan-500 to-cyan-900 shadow-lg shadow-cyan-600 sm:px-10 p-6 sm:py-10 border-l-4">
            <div class="block mb-6">
                <livewire:user-profile lazy="on-load">
            </div>
            <hr class="hidden sm:block w-full mb-4">
            <div class="">
                <div class="text-lg text-cyan-200 font-semibold underline">Coding And Robotics</div>
                <ul class="list-disc list-yellow-400">
                    <a href=""><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                         </svg>Coding Training</li>
                    </a>
                    <a href=""><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                         </svg>Coding Club/Hiring</li>
                    </a>
                    <a href=""><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                         </svg>Robotics</li>
                    </a>
                </ul>
                <div class="text-lg text-white font-semibold underline mt-4">Music</div>
                    <ul class="list-disc list-yellow-400">
                        <a href=""><li class="flex items-center text-cyan-100 hover:underline">
                            <svg class="w-3.5 h-3.5 me-2 text-white dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>Get Music Teacher</li>
                        </a>
                    </ul>
            </div>

        </section>
        
        <div class="sm:col-span-4 ">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
                    {{ __('Client Dashboard') }}
                </h2>
            </x-slot>
        <!-- Main-->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-cyan-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-2xl mb-4">Welcome, {{ $user->name }}!</h3>
        
                            @if (!$userProfile)
                                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                                    <strong>Profile Incomplete!</strong> Please complete your profile to enjoy seemless services.
                                </div>
                            @endif
        
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <div class="flex items-center">
                                        <svg class="w-12 h-12 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M6 2a1 1 0 000 2h8a1 1 0 000-2H6zM3 5a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V5zm10 6a1 1 0 112 0v2a1 1 0 11-2 0v-2zm-4 0a1 1 0 112 0v2a1 1 0 11-2 0v-2zM7 9a1 1 0 000 2h2a1 1 0 000-2H7z"/>
                                        </svg>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-semibold"> <a href="{{ route('client.tutorRequests.create') }}" class="text-blue-500 hover:underline">Request Tutor</a></h4>
                                            <p>Request a tutor for yourself or wards.</p>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <div class="flex items-center">
                                        <svg class="w-12 h-12 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9 2a1 1 0 00-1 1v14a1 1 0 001.707.707l5-5A1 1 0 0015 11H9V3a1 1 0 00-1-1zM3 7a1 1 0 011-1h4a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1V7zm0 4a1 1 0 011-1h1a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1z"/>
                                        </svg>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-semibold"><a href="{{ route('client.tutorRequests.index') }}" class="text-blue-500 hover:underline">View/Edit Tutor Requests</a></h4>
                                            <p>View and edit your requested sessions.</p>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                    <div class="flex items-center">
                                        <svg class="w-12 h-12 text-yellow-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M4 3a1 1 0 00-1 1v12a1 1 0 002 0V4a1 1 0 00-1-1zM8 4a1 1 0 00-1 1v10a1 1 0 002 0V5a1 1 0 00-1-1zm6 2a1 1 0 00-1 1v8a1 1 0 002 0V7a1 1 0 00-1-1zm4 3a1 1 0 00-1 1v4a1 1 0 002 0v-4a1 1 0 00-1-1z"/>
                                        </svg>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-semibold"><a href="{{ route('client.lessons') }}" class="text-blue-500 hover:underline">All Booked Lessons</a></h4>
                                            <p>View all your booked lessons.</p>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
        
                            <div class="mt-8">
                                <h3 class="text-xl mb-4">Statistics</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                        <h4 class="text-lg font-semibold">Total Tutor Requests</h4>
                                        <p class="text-3xl mt-2">{{$tutorRequests->count() }}</p>
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
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
 
</x-app-layout>
@include('layouts.footer')

