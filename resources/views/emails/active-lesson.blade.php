<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Lesson</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-cyan-900 p-6 text-white">
            <div class="flex items-center">
                <img src="{{ asset('images/MephEd.png') }}" alt="MephEd Logo" class="w-12 h-6 mr-4">
                <h1 class="text-2xl font-bold">New Booking Received</h1>
            </div>
        </div>

        <!-- Body Section -->
        <div class="p-6">
            <p class="text-lg font-medium mb-4">Hello {{ $activeLesson->tutor->tutorProfile->fullName }},</p>
            <p>You have been booked for a lesson by <strong> {{ $activeLesson->client->userProfile->fullname }}</strong>. Log in to your dashboard to see full lesson details.</p>

            <!-- Request Details -->
            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
                <ul class="space-y-2 text-sm">
                    <li><strong>Lesson ID:</strong> {{ $activeLesson['id'] }}</li>
                    <li><strong>Start Date:</strong> {{ $activeLesson['start_date'] }}</li>
                    <li><strong>Location:</strong> {{ $activeLesson['location'] }}</li>
                    <li><strong>Subjects:</strong> {{ $activeLesson['subjects'] }}</li>
                </ul>
            </div>

            <p class="mt-6 text-gray-600">We encourage you to prepare adequately before each class. Do not hesitate to reach out to our support team should you have any concerns.</p>
            <p class="mt-4 text-gray-600">Best regards,<br><strong>MephEd Support Team</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="bg-cyan-800 p-4 text-center text-white text-sm">
            &copy; {{ date('Y') }} MephEd. All rights reserved.
        </div>
    </div>
</body>
</html>
