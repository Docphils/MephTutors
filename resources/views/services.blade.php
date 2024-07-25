<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MephEd - Our Services</title>
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
     <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cyan-300 font-sans leading-normal tracking-normal">
    <!-- Header Section -->
    <header class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white py-6 shadow-lg">
        <div class="container mx-auto sm:flex justify-between items-center px-6">
            <h1 class="text-4xl mr-2 font-extrabold">MephEd</h1>
            <nav class="md:space-x-4 text-lg">
                <a href="{{ url('/')}}" class="hover:text-gray-200 transition">Home</a>
                <a href="{{ url('/services')}}" class="hover:text-gray-200 transition">Services</a>
                <a href="#" class="hover:text-gray-200 transition">About</a>
                <a href="#" class="hover:text-gray-200 transition">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Services Section -->
    <main class="container mx-auto py-20 px-6">
        <section class="py-20">
            <h3 class="text-3xl font-semibold text-gray-800 text-center">Our Services</h3>
            <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto mt-4">At MephEd, we offer a variety of services to help you excel in your education and personal development. Explore our offerings below.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="/images/home_tutoring.jpg" alt="Home Tutoring" class="w-full h-48 object-cover rounded-t-lg">
                    <h4 class="text-xl font-bold text-gray-800 mt-4">Home Tutoring</h4>
                    <p class="mt-4 text-gray-600">Personalized home tutoring for all subjects and levels.</p>
                    <a href="#" class="text-blue-500 hover:text-blue-600 mt-4 block">Learn more</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="/images/coding-classes.jpg" alt="Coding Classes" class="w-full h-48 object-cover rounded-t-lg">
                    <h4 class="text-xl font-bold text-gray-800 mt-4">Coding Classes</h4>
                    <p class="mt-4 text-gray-600">Learn coding from basic to advanced levels with our expert tutors.</p>
                    <a href="#" class="text-blue-500 hover:text-blue-600 mt-4 block">Learn more</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="/images/robotics.jpg" alt="Robotics" class="w-full h-48 object-cover rounded-t-lg">
                    <h4 class="text-xl font-bold text-gray-800 mt-4">Robotics</h4>
                    <p class="mt-4 text-gray-600">Explore the world of robotics with hands-on projects and classes.</p>
                    <a href="#" class="text-blue-500 hover:text-blue-600 mt-4 block">Learn more</a>
                </div>
            </div>
        </section>
    </main>

    <div class="relative overflow-hidden bg-cyan-800 pt-16 pb-32 space-y-24">
        <div class="relative">
            <div class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8 ">
                <div class="mx-auto max-w-xl px-6 lg:mx-0 lg:max-w-none lg:py-16 lg:px-0 ">
    
                    <div>
                        <div>
                            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="h-8 w-8 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z">
                                    </path>
                                </svg>
                            </span>
                        </div>
    
                        <div class="mt-6">
                            <h2 class="text-3xl font-bold tracking-tight text-white">
                                Home Tutoring:
                            </h2>
                            <p class="mt-4 text-lg text-gray-300">
                                Personalized home tutoring for all subjects and levels.
                            </p>
                            <div class="mt-6">
                                <a class="inline-flex rounded-lg bg-pink-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-pink-600 hover:bg-pink-700 hover:ring-pink-700"
                                    href="/login">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 sm:mt-16 lg:mt-0">
                    <div class="-mr-48 pl-6 md:-mr-16 lg:relative lg:m-0 lg:h-full lg:px-0">
                        <img loading="lazy" width="647" height="486"
                            class="w-full rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5 lg:absolute lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                            style="color:transparent" src="images/home-tutoring.jpg">
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <div class="relative">
            <div class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8 ">
                <div class="mx-auto max-w-xl px-6 lg:mx-0 lg:max-w-none lg:py-16 lg:px-0 lg:col-start-2">
                    <div>
                        <div>
                            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="h-8 w-8 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-3xl font-bold tracking-tight text-white">
                                Sentiment Analysis:
                            </h2>
                            <p class="mt-4 text-lg text-gray-300">
                                The product has built-in sentiment analysis capabilities, allowing it to determine the
                                sentiment (positive, negative, or neutral) expressed in text or customer feedback.
                            </p>
                            <div class="mt-6">
                                <a class="inline-flex rounded-lg bg-pink-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-pink-600 hover:bg-pink-700 hover:ring-pink-700"
                                    href="/login">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 sm:mt-16 lg:mt-0">
                    <div class="-ml-48 pr-6 md:-ml-16 lg:relative lg:m-0 lg:h-full lg:px-0">
                        <img alt="Inbox user interface" loading="lazy" width="647" height="486"
                            class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:right-0 lg:h-full lg:w-auto lg:max-w-none"
                            style="color:transparent" src="https://images.unsplash.com/photo-1599134842279-fe807d23316e">
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <div class="relative">
            <div class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8 ">
                <div class="mx-auto max-w-xl px-6 lg:mx-0 lg:max-w-none lg:py-16 lg:px-0 ">
                    <div>
                        <div>
                            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="h-8 w-8 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-3xl font-bold tracking-tight text-white">
                                Natural Language Generation (NLG):
                            </h2>
                            <p class="mt-4 text-lg text-gray-300">
                                The AI product can generate human-like written content, summaries, or reports based on
                                structured data or analysis results.
                            </p>
                            <div class="mt-6">
                                <a class="inline-flex rounded-lg bg-pink-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-pink-600 hover:bg-pink-700 hover:ring-pink-700"
                                    href="/login">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 sm:mt-16 lg:mt-0">
                    <div class="-mr-48 pl-6 md:-mr-16 lg:relative lg:m-0 lg:h-full lg:px-0">
                        <img loading="lazy" width="646" height="485"
                            class="w-full rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5 lg:absolute lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                            style="color:transparent"
                            src="https://images.unsplash.com/photo-1483478550801-ceba5fe50e8e">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gradient-to-r from-blue-500 to-teal-500 text-white py-6">
        <div class="container flex mx-auto justify-between">
            <p>&copy; 2024 MephEd. All rights reserved.</p>
            <div class="grid">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms of Service</a>
            </div>
            <div class="grid">
                <a href="#" class="hover:underline">Facebook</a>
                <a href="#" class="hover:underline">Twitter</a>
                <a href="#" class="hover:underline">Instagram</a>
            </div>
        </div>
    </footer>

    
</body>
</html>
