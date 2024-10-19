<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\UserProfile as Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public $userProfile;
    public $fullname, $address, $image, $gender, $DOB, $phone;
    public $editMode = false;

    protected $rules = [
        'fullname' => 'required|string',
        'address' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gender' => 'required|in:Male,Female',
        'DOB' => 'required|date',
        'phone' => 'required|string|max:16|regex:/^[0-9\s\-\+\(\)]*$/',
    ];

    public function mount()
    {
        Gate::authorize('AdminOrClient');

        $this->userProfile = Auth::user()->userProfile;

        if ($this->userProfile) {
            $this->loadUserProfileData();
        }
    }

    public function loadUserProfileData()
    {
        $this->fullname = $this->userProfile->fullname;
        $this->address = $this->userProfile->address;
        $this->gender = $this->userProfile->gender;
        $this->DOB = $this->userProfile->DOB;
        $this->phone = $this->userProfile->phone;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'fullname' => $this->fullname,
            'address' => $this->address,
            'gender' => $this->gender,
            'DOB' => $this->DOB,
            'phone' => $this->phone,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        if ($this->userProfile) {
            // Update profile
            $this->userProfile->update($data);
            session()->flash('success', 'Profile updated successfully.');
        } else {
            // Create profile
            $data['user_id'] = Auth::id();
            Profile::create($data);
            session()->flash('success', 'Profile created successfully.');
        }

        $this->closeModal();
    }

    public function edit()
    {
        $this->editMode = true;
    }

    public function closeModal()
    {
        $this->editMode = false;
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
