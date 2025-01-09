<div>
    <section class="mx-auto mx-10 px-6 py-20 h-full">
        <a wire:navigate href="{{ route('admin.dashboard')}}" class="mb-4 px-3 py-2 bg-cyan-600 text-white text-md font-semibold hover:shadow-lg hover:border hover:bg-cyan-900 "><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <h3 class="text-3xl font-semibold text-white text-center ">What Clients Say</h3>
        <div class="flex items-center gap-4 w-full justify-end">
            <label for="status" class="text-bold">Status:</label>
            <select wire:model.live="status" class="text-gray-900" id="status">
                <option value="">All</option>
                <option value="Approved">Approved</option>
                <option value="Pending">Pending</option>
                <option value="WelcomePage">Rejected</option>
                <option value="Hidden">Rejected</option>
            </select>
        </div>
        
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
            <!-- Pagination Links -->
            <div class="mt-4 md:col-span-3" wire:preserve-scroll>
                {{ $testimonials->links() }}
            </div>
            @endif
           
           
        </div>
       
    </section>
    @include('layouts.footer')
</div>
