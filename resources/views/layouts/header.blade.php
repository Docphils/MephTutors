

 <!-- Header Section -->
 <header class="bg-gradient-to-r from-cyan-500 to-cyan-900 text-white py-6 shadow-lg">
    <div class="container mx-auto sm:flex justify-between items-center px-6">
        <h1 class="text-4xl mr-2 font-extrabold">Meph<span class="text-cyan-300">Ed</span></h1>
        <nav class="md:space-x-4 text-lg">
            <a href="{{ url('/')}}" class="hover:text-gray-200 transition {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/services')}}" class="hover:text-gray-200 transition {{ request()->is('services') ? 'active' : '' }}">Services</a>
            <a href="{{ url('/about')}}" class="hover:text-gray-200 transition {{ request()->is('about') ? 'active' : '' }}">About</a>
            <a href="{{ url('/contact')}}" class="hover:text-gray-200 transition {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        </nav>
        <div class="md:space-x-4 text-lg">
            @if (Route::has('login'))
            <div class="">
                @auth
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-200 transition {{ request()->is('admin.dashboard') ? 'active' : '' }}">
                    {{ __('Admin Dashboard') }}
                </a>
                @elseif(Auth::user()->role === 'client')
                    <a href="{{ route('client.dashboard') }}"class="hover:text-gray-200 transition {{ request()->is('client.dashboard') ? 'active' : '' }}">
                        {{ __('Client Dashboard') }}
                    </a>
                @elseif(Auth::user()->role === 'tutor')
                    <a href="{{ route('tutor.dashboard') }}" class="hover:text-gray-200 transition {{ request()->is('tutor.dashboard') ? 'active' : '' }}">
                        {{ __('Tutor Dashboard') }}
                    </a>
                @endif                    
            
            @else
                    <a href="{{ route('login') }}" class=" hover:text-gray-200 ">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-cyan-800 hover:bg-cyan-100 rounded-lg p-1 hover:text-gray-600 transition">Sign Up</a>
                    @endif
                @endauth
            </div>
        @endif

        </div>
    </div>
</header>