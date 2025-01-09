<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Manage testimonials - MephEd')]
class AdminIndexTestimonials extends Component
{
    use WithPagination;

    public $status;
 

    public function mount(){
        Gate::authorize('Admin');
  
    }

    public function updatedStatus()
    {
        // Refresh testimonials whenever the status is updated
        $this->resetPage();
    }

    #[Layout('layouts.apps')]
    public function render()
    {
        $query = Testimonial::query();

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $testimonials = $query->latest()->paginate(3);

        return view('livewire.admin.admin-index-testimonials', [
            'testimonials' => $testimonials,
        ]);
    }
}
