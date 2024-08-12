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
                    <p class="mb-2 font-semibold text-lg">{{ $user->name}}</p>
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
                    {{ __('Coding/Music And Club Requests') }}
                </h2>
            </x-slot>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-2xl mb-6">My CRM Requests</h3>

                            <div class="min-w-full bg-white dark:bg-gray-700">
                                <div >
                                    <div class="grid grid-cols-4 font-bold">
                                        <div class="py-2 px-4">Request Type</div>
                                        <div class="py-2 px-4">Start Date</div>
                                        <div class="py-2 px-4">Status</div>
                                        <div class="py-2 px-4">Actions</div>
                                    </div>
                                </div>
                                <div>
                                    @foreach ($crms as $crm)
                                        <div class="grid grid-cols-4">
                                            @php
                                                $type = $crm->type;
                                                if($type == 'coding_tutor'){
                                                  $newType = 'Coding Tutor Request' ; 
                                                }else{
                                                    $newType = 'School Club Request';
                                                }
                                            @endphp
                                            <div class="border-t py-2 px-4">{{ $newType }}</div>
                                            <div class="border-t py-2 px-4">{{ $crm->start_date }}</div>
                                            <div class="border-t py-2 px-4">{{ $crm->status }}</div>
                                            <div class="border-t py-2 px-4 text-between">
                                                <a href="{{ route('client.crm.show', $crm->id)}}" onclick="request.showModal()" class="text-green-500 hover:underline">View</a>
                                                @if ($crm->status == 'Pending')
                                                    <a href="{{ route('client.crm.edit', $crm->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                                    <form action="{{ route('client.crm.destroy', $crm->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</x-app-layout>
@include('layouts.footer')
