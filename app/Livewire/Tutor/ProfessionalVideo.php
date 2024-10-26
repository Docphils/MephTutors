<?php

namespace App\Livewire\Tutor;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\TutorProfile;

class ProfessionalVideo extends Component
{
    use WithFileUploads;

    public $video;
    public $tutorProfileId;

    protected $rules = [
        'video' => 'required|mimes:mp4|max:20480', // MP4 format, max size 20MB
    ];

    public function store()
    {
        Gate::authorize('Tutor');
        $this->validate();

        // Retrieve the tutor profile
        $tutorProfile = TutorProfile::where('user_id', Auth::id())->first();

        if (!$tutorProfile) {
            session()->flash('error', 'You must create your tutor profile before submitting a video.');
            return;
        }

        // Check if a video already exists and delete it
        if ($tutorProfile->video) {
            Storage::disk('public')->delete($tutorProfile->video);
        }

        // Store the new video
        if ($this->video) {
            $videoPath = $this->video->store('profileVideos', 'public');
            $tutorProfile->update(['video' => $videoPath]);
            session()->flash('message', 'Professional video updated successfully');
        }

        $this->reset('video');
    }

    public function render()
    {
        return view('livewire.tutor.professional-video');
    }
}
