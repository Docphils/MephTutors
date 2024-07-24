<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class UserProfileController extends Controller
{
    public function show($id)
    {
        Gate::authorize('Admin', 'Client');

        $userProfile = UserProfile::findOrFail($id);
        $user = Auth::user();

        // Load role-specific dashboard views
        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('userProfile'));
        } elseif ($user->role === 'client') {
            return view('client.dashboard', compact('userProfile'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create()
    {
        Gate::authorize('Admin', 'Client');
        return view('userProfile.create');
    }

    public function edit($id)
    {
        Gate::authorize('Admin', 'Client');
        $userProfile = UserProfile::findOrFail($id);
        return view('userProfile.edit', compact('userProfile'));
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
            $userProfileData['user_id'] = Auth::id();
            $userProfile = UserProfile::create($userProfileData);
            $message = 'User profile created successfully';
        }

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', $message);
        } elseif ($user->role === 'client') {
            return redirect()->route('client.dashboard')->with('success', $message);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
