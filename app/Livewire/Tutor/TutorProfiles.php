<?php

namespace App\Livewire\Tutor;


use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\TutorProfile;

class TutorProfiles extends Component
{
    use WithFileUploads;

    public $phone, $address, $fullName, $image, $gender, $qualification, $experience, $CV, $discipline, $careerProfile, $bankName, $accountName, $accountNumber, $DOB;
    public $tutorProfileId;

    protected $rules = [
        'phone' => 'required|numeric',
        'address' => 'required|string',
        'fullName' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gender' => 'required|in:Male,Female',
        'qualification' => 'required|in:SSCE,Diploma,NCE,HND/BSc/BEd/BA/BEng,MSc/MA,PhD',
        'experience' => 'required|in:0-1 year,2-5 years,6-10 years,Above 10 years',
        'CV' => 'required|file|mimes:pdf,doc|max:10120',
        'discipline' => 'required|string',
        'careerProfile' => 'required|string',
        'bankName' => 'required|string',
        'accountName' => 'required|string',
        'accountNumber' => 'required|numeric|digits_between:10,11',
        'DOB' => 'required|date',
    ];

    public function store()
    {
        Gate::authorize('Tutor');
        $this->validate();
        // Validate input fields
        $validatedData = $this->validate();

        // Custom validation for DOB
        $eighteenYearsAgo = Carbon::now()->subYears(18);
        if (Carbon::parse($this->DOB)->isAfter($eighteenYearsAgo)) {
            $this->addError('DOB', 'The date of birth must be at least 18 years ago.');
            return;
        }

       // Proceed with storing the tutor profile
        $tutorProfileData = $validatedData;

        // Handle image and CV uploads
        if ($this->image) {
            $tutorProfileData['image'] = $this->image->store('images', 'public');
        }

        if ($this->CV) {
            $tutorProfileData['CV'] = $this->CV->store('cvs', 'public');
        }

        if ($this->tutorProfileId) {
            // Update existing profile
            $tutorProfile = TutorProfile::findOrFail($this->tutorProfileId);
            $tutorProfile->update($tutorProfileData);
            session()->flash('message', 'Tutor profile updated successfully');
        } else {
            // Create new profile
            $tutorProfileData['user_id'] = Auth::id();
            TutorProfile::create($tutorProfileData);
            session()->flash('message', 'Tutor profile created successfully');
        }

        $this->reset();

    }

    public function render()
    {
        return view('livewire.tutor.tutor-profiles');
    }
}

