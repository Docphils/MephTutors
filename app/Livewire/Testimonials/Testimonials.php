<?php

namespace App\Livewire\Testimonials;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;


#[Title('Add Testimonial - MephEd')]
class Testimonials extends Component
{
    public $comment;

    public function mount(){
        Auth::check();
    }

    public function submit(){
        $validated = $this->validate([
            'comment'=> 'required|string|min:50|max:250',
        ]);

        Testimonial::create([
            'comment' => $validated['comment'],
            'user_id' => Auth::user()->id,
            'status' => 'Pending',
        ]);

        session()->flash('success', 'Testimonial saved successfully. Thank you for you feedback');
        return redirect()->route('welcome');
    }

    #[Layout('layouts.apps')]
    public function render()
    {
        return view('livewire.testimonials.testimonials');
    }
}
