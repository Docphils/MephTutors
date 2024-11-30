<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updated Coding or Club</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-cyan-900 p-6 text-white">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/MephEd.png') }}" alt="MephEd Logo" class="w-12 h-6 mr-4">
                @if ($updatedRequest['request_type'] == 'coding_tutor')
                    <h1 class="text-2xl font-bold">Coding Request Updated</h1>
                @else
                    <h1 class="text-2xl font-bold">Club Request Updated</h1>
                @endif 
            </div>
        </div>

        <!-- Body Section -->
        <div class="p-6">
            <p class="text-lg font-medium mb-4">Hello {{ $updatedRequest->user->userProfile->fullname }},</p>
            <p>The status of your request with ID: <strong>#{{$updatedRequest['id'] }}</strong> has been changed. Kindly review the request details and contact our support team if you have any issues with this.</p>

            <!-- Request Details -->
            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
                <ul class="space-y-2 text-sm">
                    <li><strong>Lesson ID:</strong> {{ $updatedRequest['id'] }}</li>
                    <li><strong>Request Type:</strong> {{ $updatedRequest['request_type'] }}</li>
                    <li><strong>Status:</strong> {{ $updatedRequest['status'] }}</li>
                </ul>
            </div>

            <p class="mt-6 text-gray-600">Feel free to reach out to us should you disagree with the status change.</p>
            <p class="mt-4 text-gray-600">Best regards,<br><strong>MephEd Support Team</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="bg-cyan-800 p-4 text-center text-white text-sm">
            &copy; {{ date('Y') }} MephEd. All rights reserved.
        </div>
    </div>
</body>
</html>
