<?php

namespace App\Livewire\Testimonials;

use Livewire\Component;
use App\Models\Testimonial;


class HomeTestimonials extends Component
{

    public $testimonials = [];

    public function mount(){
        $this->getTestimonials();
    }

    protected function getTestimonials(){
        $this->testimonials = Testimonial::where('status', 'WelcomePage')->latest()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.testimonials.home-testimonials', [
            'testimonials' => $this->testimonials,
        ]);
    }
}
