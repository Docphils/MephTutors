<div>
    <section class="mx-auto mx-10 px-6 py-20">
        <h3 class="text-3xl font-semibold text-gray-800 text-center">What Our Clients Say</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            
            @if ($testimonials->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <p class="text-gray-600 italic">"There are no testimonials at the moment."</p>
                    <p class="mt-4 text-cyan-800 font-bold">- MephEd</p>
                </div>
            @else
            @foreach ($testimonials as $testimonial)
            <div wire:key='$testimonial->id' class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                <p class="text-gray-600 italic">"{{$testimonial->comment}}"</p>
                <p class="mt-4 text-gray-800 font-bold">- {{$testimonial->user->name}}</p>
            </div>
            @endforeach
            @endif
           
           
        </div>
        @auth
        <div class="my-5 justify-center sm:flex gap-4 mx-auto">
            <a wire:navigate href="{{ route('testimonial')}}" class="px-3 py-2 bg-cyan-600 text-white text-md font-semibold hover:shadow-lg hover:border hover:bg-cyan-900 "> Give testimonial</a>

            <a wire:navigate href="{{ route('testimonials.index')}}" class="px-3 py-2 bg-cyan-800 text-white text-md font-semibold hover:shadow-lg hover:border hover:bg-cyan-700 "> View all</a>
        </div>
            
        @endauth
    </section>
</div>
