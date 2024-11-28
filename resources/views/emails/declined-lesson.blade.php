<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declined Lesson</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-cyan-900 p-6 text-white">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/MephEd.png') }}" alt="MephEd Logo" class="w-12 h-6 mr-4">
                <h1 class="text-2xl font-bold">Lesson completion declined</h1>
            </div>
        </div>

        <!-- Body Section -->
        <div class="p-6">
            <p class="text-lg font-medium mb-4">Hello {{ $declinedLesson->tutor->tutorProfile->fullName }},</p>
            <p>The client declined your marking of a lesson as completed. Check your dashboard for details and contact our support team to resolve the issues raised.</p>

            <!-- Request Details -->
            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
                <ul class="space-y-2 text-sm">
                    <li><strong>Lesson ID:</strong> {{ $declinedLesson['id'] }}</li>
                    <li><strong>Client's Name:</strong> {{ $declinedLesson->client->userProfile->fullname }}</li>
                    <li><strong>Location:</strong> {{ $declinedLesson['location'] }}</li>
                    <li><strong>Subjects:</strong> {{ $declinedLesson['subjects'] }}</li>
                </ul>
            </div>

            <p class="mt-6 text-gray-600">Do well to attend to the issues raised promptly</p>
            <p class="mt-4 text-gray-600">Best regards,<br><strong>MephEd Support Team</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="bg-cyan-800 p-4 text-center text-white text-sm">
            &copy; {{ date('Y') }} MephEd. All rights reserved.
        </div>
    </div>
</body>
</html>
