<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl mb-6">CRM Requests Overview</h3>

                    @foreach ($users as $user)
                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-semibold">{{ $user->name }}</h4>
                                    <p class="text-sm">{{ $user->email }}</p>
                                    <p class="text-sm">Total Requests: {{ $user->crm->count() }}</p>
                                </div>
                                <button @click="open = !open" class="text-blue-500 hover:underline">View Requests</button>
                            </div>
                            <div x-show="open" x-transition class="mt-4">
                                <table class="min-w-full bg-white dark:bg-gray-700">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4">Request Type</th>
                                            <th class="py-2 px-4">Start Date</th>
                                            <th class="py-2 px-4">Status</th>
                                            <th class="py-2 px-4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->crm as $request)
                                            <tr>
                                                <td class="border-t py-2 px-4">{{ $request->request_type }}</td>
                                                <td class="border-t py-2 px-4">{{ $request->start_date }}</td>
                                                <td class="border-t py-2 px-4">{{ $request->status }}</td>
                                                <td class="border-t py-2 px-4">
                                                    <a href="{{ route('admin.crm.show', $request->id) }}" @click="openModal = true; modalContent = 'show'" class="text-green-500 hover:underline">View</a>
                                                    <a href="{{ route('admin.crm.edit', $request->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                                    <form action="{{ route('admin.crm.destroy', $request->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div x-data="{ openModal: false, modalContent: '' }" x-show="openModal" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                        CRM Request Details
                    </h3>
                    <div class="mt-2">
                        <!-- Dynamic content based on modalContent -->
                        <p x-text="modalContent"></p>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button @click="openModal = false" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
