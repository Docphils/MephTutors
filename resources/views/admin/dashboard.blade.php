<x-app-layout>
    <div class="grid sm:grid-cols-5">
        <!-- Sidebar-->
        <section class="bg-gradient-to-t from-cyan-500 to-cyan-900 shadow-lg shadow-cyan-600 pl-16 pr-6 p-6 sm:py-16 border-l-4">
            <div class="hidden sm:block mb-6">
                @if ($userProfile)
                <div class="text-center mb-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $userProfile->image) }}" alt="Profile image" class="h-14 w-14 rounded-full object-cover border-2 border-white shadow-sm shadow-white">
                    </div>
                    <p class="mt-1 font-semibold text-lg">{{ $userProfile->fullname}}</p>
                    @php
                        $role = strtoupper($user->role);
                    @endphp
                    <p class="mb-2 font-bold text-md">Role: {{$role}}</p>
                </div>
                <div class="">Gender: {{ $userProfile->gender }}</div>
                <div class="">Address: {{ $userProfile->address }}</div>
                <div class="flex items-center">
                    <h4 class="text-md font-semibold px-2 py-1 rounded-lg bg-white">
                        <a href="{{ route('userProfile.edit', ['id' => $userProfile->id]) }}" class="text-cyan-600 hover:underline">Edit Profile</a>
                    </h4>                                                                        
                </div>
                @endif
            </div>
            <hr class="hidden sm:block w-full mb-4">
            <div class="">
                <div class="text-lg text-cyan-200 font-semibold underline">Admin Panel</div>
                <ul class="list-disc list-yellow-400">
                    <a href="{{ route('admin.users') }}" wire:navigate><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>Manage Users</li>
                    </a>
                    <a wire:navigate href="{{route('tutorRequests.index')}}"><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>Manage Requests</li>
                    </a>
                    <a href="{{route('lessons.index')}}" wire:navigate><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>Manage Lessons</li>
                    </a>
                    <a href="{{route('admin.payments.index')}}"><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>Manage Payments</li>
                    </a>
                    <a href=""><li class="flex items-center hover:underline">
                        <svg class="w-3.5 h-3.5 me-2 text-cyan-300 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>CRM</li>
                    </a>
                </ul>
            </div>
        </section>
        
        <div class="sm:col-span-4 ">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h2>
            </x-slot>
            <div class=" py-12 px-10 text-lg bg-cyan-500">
                <div class="">Pending Tutor Requests </div>
                <div class="">Requests for Adjustment</div>
                <div class="">Accepted Tutor Requests</div>
            </div>

            <!-- Main-->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-cyan-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-2xl mb-4">Welcome, {{ $user->name }}!</h3>
        
                            @if (!$userProfile)
                                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                                    <strong>Profile Incomplete!</strong> Please <a href="{{ route('userProfile.create') }}" class="text-blue-500 hover:underline">update your profile</a> to enjoy full features.
                                </div>
                            @endif
        
                            <div class="mt-8">
                                <h3 class="text-xl mb-4">Statistics</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                        <h4 class="text-lg font-semibold">Total Users</h4>
                                        <p class="text-3xl mt-2">{{ $users->count() }}</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                        <h4 class="text-lg font-semibold">Total Tutor Requests</h4>
                                        <p class="text-3xl mt-2">{{ $tutorRequests->count() }}</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                        <h4 class="text-lg font-semibold">Active Bookings</h4>
                                        <p class="text-3xl mt-2">{{ $bookings->count() }}</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                        <h4 class="text-lg font-semibold">Completed Bookings</h4>
                                        <p class="text-3xl mt-2">{{ $completedBookings->count() }}</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                        <h4 class="text-lg font-semibold">Payments Earned</h4>
                                        <p class="text-3xl mt-2">{{ $earnedPayments->count() }}</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
                                        <h4 class="text-lg font-semibold">New Coding/Music Requests</h4>
                                        <p class="text-3xl mt-2">{{ $newCRM->count() }}</p>
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
