<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Your Tutor Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mb-4 text-right mx-6">
            <a href="{{ route('client.tutorRequests.create') }}" class="mx-6 text-cyan-900 bg-cyan-300 p-1 rounded-lg font-semibold shadow-lg shadow-cyan-600">Make New Request</a>
        </div>

        @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 10000)"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" 
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
        <div class="text-cyan-50 text-3xl mb-2 mx-6 sm:mx-16">New Requests</div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-sm sm:rounded-lg border border-b-2 border-b-cyan-900">
                <div class="px-6 p-3 sm:p-6 text-gray-900 dark:text-gray-100">
                        <div class="relative font-bold text-lg flex justify-between justify-items-start items-center  px-6 p-3 border border-b-2 border-b-cyan-900">
                            <div class="w-full">Subjects</div>
                            <div class="w-full">Start Date</div>
                            <div class="w-full">End Date</div>
                            <div class="w-1/2">Action</div>
                        </div>
                        @foreach($pendingRequests as $request)
                        <div class="relative flex justify-around w-full items-center px-6 py-3 border border-b-2 border-b-cyan-900">
                            <div class="w-full font-semibold">{{ $request->subjects }}</div>
                            <div class="w-full"> {{ $request->start_date }}</div>
                            <div class="w-full"> {{ $request->end_date }}</div>
                            <a href="{{ route('client.tutorRequests.show', $request->id) }}" class="w-1/2 text-blue-500">View Details</a>
                        </div>
                        
                        @endforeach
                    </div>
                </div>
        </div>
        

        <!--Assigned Requests-->
        <div class="text-cyan-50 text-3xl mb-2 mx-6 sm:mx-16">Assigned Requests</div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
                <div class="bg-cyan-50 dark:bg-gray-800 overflow-hidden shadow-sm rounded-sm sm:rounded-lg border border-b-2 border-b-cyan-900">
                    <div class="px-6 p-3 sm:p-6 text-gray-900 dark:text-gray-100">
                        <div class="relative font-bold text-lg flex justify-between justify-items-start items-center  px-6 p-3 border border-b-2 border-b-cyan-900">
                            <div class="w-full">Subjects</div>
                            <div class="w-full">Start Date</div>
                            <div class="w-full">End Date</div>
                            <div class="w-1/2">Action</div>
                        </div>
                        @foreach($assignedRequests as $request)
                        <div class="relative flex justify-around w-full items-center px-6 py-3 border border-b-2 border-b-cyan-900">
                            <div class="w-full font-semibold">{{ $request->subjects }}</div>
                            <div class="w-full"> {{ $request->start_date }}</div>
                            <div class="w-full"> {{ $request->end_date }}</div>
                            <a href="{{ route('client.tutorRequests.show', $request->id) }}" class="w-1/2 text-blue-500">View Details</a>
                        </div>
                        
                        @endforeach
                    </div>
                </div>
        </div>

        
    </div>  
    @include('layouts.footer')  
</x-app-layout>
