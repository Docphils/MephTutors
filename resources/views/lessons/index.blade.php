<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-200 dark:text-gray-200 leading-tight">
            {{ __('Your Tutor Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mb-4 text-right mx-8">
            <a href="{{ route('lessons.create') }}" class="mx-8 text-cyan-900 bg-cyan-300 p-1 rounded-lg font-semibold shadow-lg shadow-cyan-600">Place Another Request</a>
        </div>

        <div class="text-cyan-50 text-3xl mb-4 mx-16">New Requests</div>
        <div class="max-w-7xl grid sm:grid-cols-2 gap-8 mx-auto sm:px-6 lg:px-8 my-6">
            @foreach($pendingLessons as $lesson)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold">{{ $lesson->subjects }}</h3>
                        <div class="flex justify-between">
                            <p><strong>Start Date:</strong> {{ $lesson->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $lesson->end_date }}</p>
                        </div>
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="text-blue-500">View Details</a>
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="text-blue-500 ml-4">Edit</a>
                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        

        <!--Assigned Lessons-->
        <div class="text-cyan-50 text-3xl mb-4 mx-16">Assigned Lessons</div>
        <div class="max-w-7xl grid sm:grid-cols-2 gap-8 mx-auto sm:px-6 lg:px-8 my-6">
            @foreach($activeLessons as $lesson)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold">{{ $lesson->subjects }}</h3>
                        <div class="flex justify-between">
                            <p><strong>Start Date:</strong> {{ $lesson->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $lesson->end_date }}</p>
                        </div>
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="text-blue-500">View Details</a>
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="text-blue-500 ml-4">Edit</a>
                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        
    </div>  
    @include('layouts.footer')  
</x-app-layout>
