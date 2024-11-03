<x-guest-layout>

<div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg overflow-hidden my-8">
    <div class="bg-indigo-600 px-6 py-4 text-white text-center">
        <h1 class="text-2xl font-semibold">You've Received a New Contact Form Submission</h1>
    </div>

    <div class="p-6">
        <p class="text-gray-700 text-lg mb-4">
            Hello Admin,
        </p>
        <p class="text-gray-600 mb-6">
            A new message has been submitted through the contact form. Here are the details:
        </p>

        <div class="border-t border-gray-200 pt-4">
            <p class="text-gray-800 text-sm mb-1"><strong>Name:</strong> {{ $contact['name'] }}</p>
            <p class="text-gray-800 text-sm mb-1"><strong>Email:</strong> {{ $contact['email'] }}</p>
            <p class="text-gray-800 text-sm mb-1"><strong>Phone:</strong> {{ $contact['phone'] }}</p>
            <p class="text-gray-800 text-sm mb-4"><strong>Message:</strong></p>
            <p class="text-gray-600 p-4 bg-gray-50 rounded-md">{{ $contact['message'] }}</p>
        </div>

        <p class="text-gray-500 text-sm mt-6">
            Thank you for responding promptly to this request. <br> – MephEd Support Team
        </p>
    </div>

    <div class="bg-gray-100 px-6 py-4 text-center text-gray-600 text-xs">
        <p>&copy; {{ date('Y') }} MephEd. All rights reserved.</p>
    </div>
</div>


</x-guest-layout>