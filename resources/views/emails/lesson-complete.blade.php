<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Lesson</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-cyan-900 p-6 text-white">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/MephEd.png') }}" alt="MephEd Logo" class="w-12 h-6 mr-4">
                <h1 class="text-2xl font-bold">Lesson completed</h1>
            </div>
        </div>

        <!-- Body Section -->
        <div class="p-6">
            <p class="text-lg font-medium mb-4">Hello {{ $completedLesson->client->userProfile->fullname }},</p>
            <p>The tutor has marked your lesson with ID: <strong>#{{$completedLesson['id'] }}</strong> as completed. Log in to your dashboard to confirm this or decline.</p>

            <!-- Request Details -->
            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
                <ul class="space-y-2 text-sm">
                    <li><strong>Lesson ID:</strong> {{ $completedLesson['id'] }}</li>
                    <li><strong>Tutor's Name:</strong> {{ $completedLesson->tutor->tutorProfile->fullName }}</li>
                    <li><strong>Location:</strong> {{ $completedLesson['location'] }}</li>
                    <li><strong>Subjects:</strong> {{ $completedLesson['subjects'] }}</li>
                </ul>
            </div>

            <p class="mt-6 text-gray-600">Please note that you are required to confirm the lesson as completed or decline it within 24hours. Failure to respond to this status change within 24hours, the lesson will automatically be closed.</p>
            <p class="mt-4 text-gray-600">Best regards,<br><strong>MephEd Support Team</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="bg-cyan-800 p-4 text-center text-white text-sm">
            &copy; {{ date('Y') }} MephEd. All rights reserved.
        </div>
    </div>
</body>
</html>
