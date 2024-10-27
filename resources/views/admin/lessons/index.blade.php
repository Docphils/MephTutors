<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-100 leading-tight">
            {{ __('Manage Booked Lessons') }}
        </h2>
    </x-slot>
    <div class="w-full flex my-2 px-2 sm:px-16 justify-between mx-auto ">
        <a href="{{route('admin.dashboard')}}" wire:navigate class="bg-cyan-700 shadow-md hover:shadow-md shadow-cyan-500 p-2 rounded-sm">Back to Dashboard</a>
        <a href="{{route('bookings.create')}}" wire:navigate class="bg-cyan-100 shadow-sm hover:shadow-lg hover:underline shadow-cyan-50  text-cyan-800 p-2 rounded-sm">Assign New Lesson</a>        
    </div>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cyan-50  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                   @livewire('admin.lesson.index')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.footer')
