<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use Livewire\Attributes\Layout;

class Newsletter extends Component
{
    public $title;
    public $body;
    public $subject;

    public function sendNewsletter()
    {
        $content = $this->validate([
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Retrieve all subscribed users
        $subscribedUsers = User::where('is_subscribed', true)->pluck('email');

        if ($subscribedUsers->isEmpty()) {
            session()->flash('error', 'No subscribed users to send the newsletter to.');
            return;
        }

        // Send the newsletter to each subscribed user
        foreach ($subscribedUsers as $email) {
            Mail::to($email)->send(new NewsletterMail($content));
        }

        // Clear fields and show success message
        $this->reset(['title', 'body', 'subject']);
        session()->flash('success', 'Newsletter sent successfully!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.newsletter');
    }
}
