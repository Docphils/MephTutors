<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Request Email</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-cyan-900 p-6 text-white">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/MephEd.png') }}" alt="MephEd Logo" class="w-12 h-6 mr-4">
                <h1 class="text-2xl font-bold">Closed Lesson and Earned Payment Notification</h1>
            </div>
        </div>

        <!-- Body Section -->
        <div class="p-6">
            <p class="text-lg font-medium mb-4">Hello Admin,</p>
            <p>This is to notify you that a lesson has just been closed and the tutor is due for payment. See details below:</p>

            <!-- Request Details -->
            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
                <ul class="space-y-2 text-sm">
                    <li><strong>Lesson ID:</strong> {{ $closedLesson['id'] ?? 'N/A' }}</li>
                    <li><strong>Tutor's Name:</strong> {{ $closedLesson->tutor->tutorProfile->fullName ?? 'N/A' }}</li>
                    <li><strong>Payment ID:</strong> {{ $closedLesson->payment->id ?? 'N/A' }}</li>
                    <li><strong>Status:</strong> {{ $closedLesson['status'] ?? 'N/A' }}</li>
                </ul>
            </div>

            <p class="mt-6 text-gray-600">Do well to effect necessary actions promptly</p>
            <p class="mt-4 text-gray-600">Best regards,<br><strong>MephEd Support Team</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="bg-cyan-800 p-4 text-center text-white text-sm">
            &copy; {{ date('Y') }} MephEd. All rights reserved.
        </div>
    </div>
</body>
</html>
