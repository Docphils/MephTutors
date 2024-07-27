<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cyan-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                    @if (!Auth::user()->userProfile)
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <strong>Profile Incomplete!</strong> Please <a href="{{ route('userProfile.create') }}" class="text-blue-500 hover:underline">update your profile</a> to enjoy full features.
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                            <div class="flex items-center">
                                <svg class="w-12 h-12 text-green-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M6 2a1 1 0 000 2h8a1 1 0 000-2H6zM3 5a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V5zm10 6a1 1 0 112 0v2a1 1 0 11-2 0v-2zm-4 0a1 1 0 112 0v2a1 1 0 11-2 0v-2zM7 9a1 1 0 000 2h2a1 1 0 000-2H7z"/>
                                </svg>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold"><a href="{{ route('lessons.create') }}" class="text-blue-500 hover:underline">Request Tutor</a></h4>
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
                                    <h4 class="text-lg font-semibold"><a href="{{ route('lessons.index') }}" class="text-blue-500 hover:underline">View/Edit Lessons</a></h4>
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
                                    <h4 class="text-lg font-semibold"><a href="{{ route('bookings.index') }}" class="text-blue-500 hover:underline">View Bookings</a></h4>
                                    <p>View your booked lessons.</p>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->userProfile)
                        <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                            <div class="flex items-center">
                                <svg class="w-12 h-12 text-purple-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M8 4a1 1 0 000 2h8a1 1 0 100-2H8zm-4 4a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 01-1 1H5a1 1 0 01-1-1V8zm10 4a1 1 0 112 0v2a1 1 0 11-2 0v-2zm-4 0a1 1 0 112 0v2a1 1 0 11-2 0v-2zM7 10a1 1 0 000 2h2a1 1 0 000-2H7z"/>
                                </svg>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold">
                                        <a href="{{ route('userProfile.edit', ['id' => Auth::user()->userProfile->id]) }}" class="text-blue-500 hover:underline">Edit Profile</a>
                                    </h4>                                                                        
                                    <p>Want to update your profile information? Use the link.</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl mb-4">Statistics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                <h4 class="text-lg font-semibold">Total Lessons</h4>
                                <p class="text-3xl mt-2">12</p>
                            </div>
                            <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                <h4 class="text-lg font-semibold">Completed Bookings</h4>
                                <p class="text-3xl mt-2">8</p>
                            </div>
                            <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                <h4 class="text-lg font-semibold">Pending Bookings</h4>
                                <p class="text-3xl mt-2">4</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.footer')

