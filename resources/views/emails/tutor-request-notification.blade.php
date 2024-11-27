<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Request Notification</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-cyan-800 p-6 text-white">
            <div class="flex items-center">
                <img src="{{ asset('images/MephEd.png') }}" alt="MephEd Logo" class="w-8 h-6 rounded-full mr-4">
                <h1 class="text-2xl font-bold">New Tutor Request Submitted</h1>
            </div>
        </div>

        <!-- Body Section -->
        <div class="p-6">
            <p class="text-lg font-medium mb-4">Hello Admin,</p>
            <p>A new tutor request has been submitted by <strong> {{ $client->userProfile->fullname }}</strong>. Here are the details:</p>

            <!-- Request Details -->
            <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow">
                <ul class="space-y-2 text-sm">
                    <li><strong>Start Date:</strong> {{ $tutorRequest['start_date'] }}</li>
                    <li><strong>End Date:</strong> {{ $tutorRequest['end_date'] }}</li>
                    <li><strong>Location:</strong> {{ $tutorRequest['location'] }}</li>
                    <li><strong>Days & Times:</strong> {{ $tutorRequest['days_times'] }}</li>
                    <li><strong>Subjects:</strong> {{ $tutorRequest['subjects'] }}</li>
                    <li><strong>Number of Learners:</strong> {{ $tutorRequest['learners'] }}</li>
                    <li><strong>Sessions:</strong> {{ $tutorRequest['sessions'] }}</li>
                    <li><strong>Duration:</strong> {{ $tutorRequest['duration'] }}</li>
                    <li><strong>Preferred Tutor Gender:</strong> {{ $tutorRequest['tutor_gender'] }}</li>
                    <li><strong>Curriculum:</strong> {{ $tutorRequest['curriculum'] }}</li>
                    <li><strong>Amount:</strong> {{ $tutorRequest['amount'] }}</li>
                    <li><strong>Remarks:</strong> {{ $tutorRequest['remarks'] ?? 'None' }}</li>
                </ul>
            </div>

            <p class="mt-6 text-gray-600">Kindly review and take the necessary actions.</p>
            <p class="mt-4 text-gray-600">Best regards,<br><strong>MephEd Support Team</strong></p>
        </div>

        <!-- Footer Section -->
        <div class="bg-cyan-800 p-4 text-center text-white text-sm">
            &copy; {{ date('Y') }} MephEd. All rights reserved.
        </div>
    </div>
</body>
</html>
