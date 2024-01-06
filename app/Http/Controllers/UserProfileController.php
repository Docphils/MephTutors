<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
class UserProfileController extends Controller
{
    public function show($id)
    {
        $userProfile = UserProfile::findOrFail($id);
        // Assuming you have a corresponding view for showing user profiles
        return view('/dashboard', compact('userProfile'));
    }

    public function create()
    {
        // Assuming you have a corresponding view for creating user profiles
        return view('userProfile.create');
    }

    public function edit($id)
    {
        $userProfile = UserProfile::findOrFail($id);
        // Assuming you have a corresponding view for editing user profiles
        return view('userProfile.edit', compact('userProfile'));
    }

    public function store(Request $request, $id = null)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'age' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:Male,Female,Other',
        ]);

        $userProfileData = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $userProfileData['image'] = $imagePath;
        }

        if ($id) {
            // Update existing user profile
            $userProfile = UserProfile::findOrFail($id);
            $userProfile->update($userProfileData);
            $message = 'User profile updated successfully';
        } else {
            // Create new user profile
            $userProfile = auth()->user()->userProfile()->create($userProfileData);
            $message = 'User profile created successfully';
        }

        return redirect()->route('userProfile.show', $userProfile->id)
            ->with('success', $message);
    }

}
