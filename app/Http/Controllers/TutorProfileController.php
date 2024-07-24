<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use Illuminate\Support\Facades\Auth;

class TutorProfileController extends Controller
{
    public function show($id)
    {
        $tutorProfile = TutorProfile::findOrFail($id);
        return view('tutor.dashboard', compact('tutorProfile'));
    }

    public function create()
    {
        return view('tutorProfile.create');
    }

    public function edit($id)
    {
        $tutorProfile = TutorProfile::findOrFail($id);
        return view('tutorProfile.edit', compact('tutorProfile'));
    }

    public function store(Request $request, $id = null)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'age' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:Male,Female',
        ]);

        $tutorProfileData = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $ututorProfileData['image'] = $imagePath;
        }

        if ($id) {
            // Update existing user profile
            $tutorProfile = TutorProfile::findOrFail($id);
            $tutorProfile->update($tutorProfileData);
            $message = 'Tutor profile updated successfully';
        } else {
            // Create new user profile
            $tutorProfileData['user_id'] = Auth::id();
            $tutorProfile = TutorProfile::create($tutorProfileData);
            $message = 'Tutor profile created successfully';
        }

        return redirect()->route('tutor.dashboard')->with('success', $message);
    }
}

