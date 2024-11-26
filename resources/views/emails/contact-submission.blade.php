<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MephEd - Contact Notification</title>
    <style>
        /* Reset and font styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            color: #180404;
        }

        /* Main container */
        .email-container {
            max-width: 600px;
            margin: 2rem auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .email-header {
            background-color: darkcyan;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .email-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .email-header h1 {
            margin: 10px 0 0;
            font-size: 24px;
        }

        /* Content */
        .email-body {
            padding: 20px;
            background-color: #ffffff;
            color: black;
        }

        .email-body p {
            font-size: 16px;
            margin-bottom: 1em;
            line-height: 1.5;
        }

        .details-section {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .details-section p {
            margin: 5px 0;
            font-size: 14px;
            color: #333;
        }

        .message-box {
            background-color: #f0f4f8;
            padding: 15px;
            border-radius: 6px;
            font-style: italic;
            color: #555;
        }

        /* Footer */
        .email-footer {
            background-color: darkcyan;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section with Logo -->
        <div class="email-header">
            <img src="/images/MephEd.png" alt="Logo Image" class="object-cover h-6 sm:h-8 w-24 sm:w-32">
            <h1>New Contact Form Submission</h1>
        </div>

        <!-- Main Content -->
        <div class="email-body">
            <p>Hello Admin,</p>
            <p>A new message has been submitted through the contact form. Here are the details:</p>

            <div class="details-section">
                <p><strong>Name:</strong> {{ $contact['name'] }}</p>
                <p><strong>Email:</strong> {{ $contact['email'] }}</p>
                <p><strong>Phone:</strong> {{ $contact['phone'] }}</p>
                <p><strong>Message:</strong></p>
                <div class="message-box">{{ $contact['message'] }}</div>
            </div>

            <p>Please respond promptly to this request.</p>
            <p>Best regards,<br>– The MephEd Support Team</p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            &copy; {{ date('Y') }} MephEd. All rights reserved.
        </div>
    </div>
</body>
</html>
