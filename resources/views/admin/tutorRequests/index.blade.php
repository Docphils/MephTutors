    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-cyan-100leading-tight">
                {{ __('Manage Requests') }}
            </h2>
        </x-slot>
        <div class=" flex my-2 px-16 justify-between mx-auto ">
            <a href="{{route('admin.dashboard')}}" wire:navigate class="bg-cyan-700 shadow-md hover:shadow-md shadow-cyan-500 p-2 rounded-sm">Back to Dashboard</a>
            <!--<a href="{{route('bookings.create')}}" wire:navigate class="bg-cyan-100 shadow-sm hover:shadow-lg hover:underline shadow-cyan-50  text-cyan-800 p-2 rounded-sm">Assign New Request</a>-->        
        </div>
        <div class="py-8  bg-sky-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
                <div class=" bg-sky-50  overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 ">
                       @livewire('admin.tutorRequests.index')
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    
       