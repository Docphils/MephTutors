<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSubmissionNotification;

class ContactForm extends Component
{
    public $name, $email, $phone, $message;

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email',
        'phone' => 'required|string|min:6|max:20',
        'message' => 'required|string',  
    ];

    public function save(){
        $this->validate();

        $contact = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ];

        Contact::create($contact);

        // Get all users with the 'admin' role
        $admins = User::where('role', 'admin')->get();

        // Send email to each admin
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new ContactSubmissionNotification($contact));
        }
        session()->flash('success', 'Thank you for contacting MephEd. Our support team will be in touch with you shortly');

        $this->reset(['name', 'email', 'phone', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
