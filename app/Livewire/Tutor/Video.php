<?php

namespace App\Livewire\Tutor;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Video extends Component
{
    use WithFileUploads;

    public $video;

    protected $rules = [
        'video' => 'required|file|mimes:mp4|max:10240'
    ];

    public function close(){
        $this->dispatch('closeModal');
    }

    public function store()
    {
        Gate::authorize('Tutor');
    
        // Validate input fields
        $validatedData = $this->validate();
    
        // Retrieve the tutor profile if it exists
        $tutorProfile = Auth::user()->tutorProfile;
    
        // Video upload handling
        if ($this->video) {
            if ($tutorProfile && $tutorProfile->video) {
                Storage::disk('public')->delete($tutorProfile->video);
            }
            $validatedData['video'] = $this->video->store('video', 'public');
        } elseif ($tutorProfile) {
            $validatedData['video'] = $tutorProfile->video;
        }
    
        if ($tutorProfile) {
            // Update existing profile
            $tutorProfile->update($validatedData);
            session()->flash('message', 'Video updated successfully');
        }
    
        // Reset specific fields
        $this->reset();
    }
    

    public function render()
    {
        return view('livewire.tutor.video');
    }
}
