<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;


#[Title('Terms of Service - MephEd')] 
class TermsOfService extends Component
{
    public $tutor = false;

    public function mount()
    {
        if (Auth::check() && Auth::user()->role === 'tutor') {
            $this->tutor = true; 
        }
    }


    #[Layout('layouts.visitor')]
    public function render()
    {
        return view('livewire.terms-of-service', [
            'tutor' => $this->tutor, 
        ]);
    }
}
