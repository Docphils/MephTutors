<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-100leading-tight">
            {{ __('Manage Requests') }}
        </h2>
    </x-slot>
    <div class=" flex my-2 px-16 justify-between mx-auto ">
        <a href="{{route('admin.dashboard')}}" wire:navigate class="bg-cyan-700 shadow-md hover:shadow-md shadow-cyan-500 p-2 rounded-sm">Back to Dashboard</a>
    </div>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class=" overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-50 ">
                   @livewire('admin.c-r-m.index')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.footer')

   