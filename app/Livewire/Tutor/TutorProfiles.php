<?php

namespace App\Livewire\Tutor;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\TutorProfile;


class TutorProfiles extends Component
{
    use WithFileUploads;

    public $phone, $address, $fullName, $image, $gender, $qualification, $experience, $CV, $discipline, $careerProfile, $bankName, $accountName, $accountNumber, $DOB;
    public $tutorProfileId;
    public $show;

    protected function rules()
    {
        return [
        'phone' => 'required|numeric',
        'address' => 'required|string',
        'fullName' => 'required|string|max:255',
        'image' => $this->tutorProfileId ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gender' => 'required|in:Male,Female',
        'qualification' => 'required|in:SSCE,Diploma,NCE,HND/BSc/BEd/BA/BEng,MSc/MA,PhD',
        'experience' => 'required|in:0-1 year,2-5 years,6-10 years,Above 10 years',
        'CV' => $this->tutorProfileId ? 'nullable|file|mimes:pdf,doc|max:10120' : 'required|file|mimes:pdf,doc|max:10120',
        'discipline' => 'required|string',
        'careerProfile' => 'required|string|min:150|max:500',
        'bankName' => 'required|string',
        'accountName' => 'required|string',
        'accountNumber' => 'required|numeric|digits_between:10,11',
        'DOB' => 'required|date',
    ];
    }

    public function loadProfile($tutorProfileId)
    {
        $this->tutorProfileId = $tutorProfileId;
        $this->show = true;
        
        if ($this->tutorProfileId) {
            $tutorProfile = TutorProfile::findOrFail($this->tutorProfileId);

            // Populate form fields with existing profile data
            $this->phone = $tutorProfile->phone;
            $this->address = $tutorProfile->address;
            $this->fullName = $tutorProfile->fullName;
            $this->gender = $tutorProfile->gender;
            $this->qualification = $tutorProfile->qualification;
            $this->experience = $tutorProfile->experience;
            $this->discipline = $tutorProfile->discipline;
            $this->careerProfile = $tutorProfile->careerProfile;
            $this->bankName = $tutorProfile->bankName;
            $this->accountName = $tutorProfile->accountName;
            $this->accountNumber = $tutorProfile->accountNumber;
            $this->DOB = $tutorProfile->DOB;

        }
    }

    
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

        // Retrieve the tutor profile if it exists
        $tutorProfile = TutorProfile::find($this->tutorProfileId);

        // Image upload handling
        if ($this->image) {
            if ($tutorProfile && $tutorProfile->image) {
                Storage::disk('public')->delete($tutorProfile->image); // Delete old image if exists
            }
            $tutorProfileData['image'] = $this->image->store('images', 'public'); // Store new image
        } elseif ($tutorProfile) {
            $tutorProfileData['image'] = $tutorProfile->image; // Retain existing image
        }

        // CV upload handling
        if ($this->CV) {
            if ($tutorProfile && $tutorProfile->CV) {
                Storage::disk('public')->delete($tutorProfile->CV); // Delete old CV if exists
            }
            $tutorProfileData['CV'] = $this->CV->store('cvs', 'public'); // Store new CV
        } elseif ($tutorProfile) {
            $tutorProfileData['CV'] = $tutorProfile->CV; // Retain existing CV
        }

        if ($this->tutorProfileId) {
            // Update existing profile
            $tutorProfile->update($tutorProfileData);
            session()->flash('message', 'Tutor profile updated successfully');
            $this->dispatch('saved');
        } else {
            // Create new profile
            $tutorProfileData['user_id'] = Auth::id();
            TutorProfile::create($tutorProfileData);
            session()->flash('message', 'Tutor profile created successfully');
            $this->dispatch('saved');
        }

        $this->reset();
    }

    public function close(){
        $this->dispatch('close');
    }

    public function render()
    {
        $tutorProfile = Auth::user()->tutorProfile;
        return view('livewire.tutor.tutor-profiles', compact('tutorProfile'));
    }
}
