<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class NewsletterSubscription extends Component
{

    public $isSubscribed;

    public function mount()
    {
        // Set initial subscription status from the logged-in user
        $this->isSubscribed = Auth::user()->is_subscribed;
    }

    public function toggleSubscription()
    {
        $user = User::find(Auth::id());;
        $user->update(['is_subscribed' => $this->isSubscribed]);

        session()->flash('success', $this->isSubscribed ? 'Successful!' : 'Unsubscribed!');
    }


    public function render()
    {
        return view('livewire.newsletter-subscription');
    }
}
