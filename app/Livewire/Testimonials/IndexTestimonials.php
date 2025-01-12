<?php

namespace App\Livewire\Testimonials;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Testimonials - MephEd')]
class IndexTestimonials extends Component
{
    use WithPagination;


    #[Layout('layouts.visitor')]
    public function render()
    {
        $testimonials = Testimonial::where('status', 'Approved')->orWhere('status', 'WelcomePage')->latest()->paginate(9);
        
        return view('livewire.testimonials.index-testimonials', [
            'testimonials' => $testimonials,
        ]);
    }
}
