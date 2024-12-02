<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terms of Service - MephEd</title>
  
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

   <!-- Scripts -->
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
  <header class="bg-cyan-600 text-white py-6">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold">MephEd Terms of Service</h1>
      <p class="text-sm mt-1">Effective Date: 1st January, 2025</p>
    </div>
  </header>

  <main class="container mx-auto px-4 py-10">
    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">1. Overview of Services</h2>
      <p class="leading-relaxed">
        MephEd connects clients with skilled tutors and instructors for various educational and extracurricular needs. Our offerings include:
      </p>
      <ul class="list-disc ml-6 space-y-2">
        <li>Deploying home lesson teachers for personalized tutoring sessions.</li>
        <li>Deploying coding instructors for both home tutoring and online classes.</li>
        <li>Deploying club instructors to schools and organizations for extracurricular activities such as Chess, Music, Taekwondo, Coding, STEM, etc.</li>
      </ul>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">2. Client Responsibilities</h2>
      <p class="leading-relaxed">
        As a Client, you agree to:
      </p>
      <ul class="list-disc ml-6 space-y-2">
        <li>Provide accurate details about your needs to help us assign suitable tutors or instructors.</li>
        <li>Pay all agreed fees promptly as per the invoice provided.</li>
        <li>Offer feedback on the tutor's performance, including approval of services rendered.</li>
        <li>Maintain a safe and respectful environment for instructors and tutors deployed to your location.</li>
      </ul>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">3. Tutor Responsibilities</h2>
      <p class="leading-relaxed">
        As a Tutor or Instructor, you agree to:
      </p>
      <ul class="list-disc ml-6 space-y-2">
        <li>Provide professional and high-quality educational services to clients.</li>
        <li>Respect the client's time and requirements as agreed upon during assignment.</li>
        <li>Mark lessons as completed via the MephEd platform promptly.</li>
      </ul>
      <p class="leading-relaxed mt-4">
        Payment Policy for Tutors:
      </p>
      <ul class="list-disc ml-6 space-y-2">
        <li>Receive 70% of the fee paid by the client after the client has approved your service.</li>
        <li>Ensure compliance with all local and federal laws related to your service delivery.</li>
      </ul>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">4. Payments and Refunds</h2>
      <p class="leading-relaxed">
        Payment terms for Clients:
      </p>
      <ul class="list-disc ml-6 space-y-2">
        <li>Invoices must be paid before services commence unless otherwise agreed.</li>
        <li>Refunds, if applicable, are subject to MephEd's review and will be processed within 5 working days.</li>
      </ul>
      <p class="leading-relaxed mt-4">
        Payment terms for Tutors:
      </p>
      <ul class="list-disc ml-6 space-y-2">
        <li>Payouts are processed monthly or upon reaching a specific earnings threshold.</li>
        <li>Ensure that your account details provided for payouts are accurate.</li>
      </ul>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">5. Limitation of Liability</h2>
      <p class="leading-relaxed">
        MephEd is not responsible for disputes arising between Clients and Tutors. However, we will mediate conflicts where possible to ensure mutual satisfaction.
      </p>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">6. Governing Law</h2>
      <p class="leading-relaxed">
        These Terms are governed by and construed in accordance with the laws of the Federal Republic of Nigeria.
      </p>
    </section>

    <section class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">7. Contact Information</h2>
      <p class="leading-relaxed">
        For questions about these Terms, please contact us at <a href="mailto:info@mephed.ng" class="text-blue-600 hover:underline">info@mephed.ng</a>.
      </p>
    </section>
  </main>

  @include('layouts.footer')
  @livewireScripts
</body>
</html>
