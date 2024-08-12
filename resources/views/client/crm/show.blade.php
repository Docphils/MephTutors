<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Request Details') }}
        </h2>
    </x-slot>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg w-1/2 mx-auto my-4 p-4">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between">
                            <p><strong>Request Type:</strong> {{ $request->request_type }}</p>
                            <p><strong>Start Date:</strong> {{ $request->start_date }}</p>
                        </div>
                </div>
            </div>
    
</x-app-layout>