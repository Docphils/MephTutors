<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


class UserProfileController extends Controller
{
    public function show($id)
    {
        Gate::authorize('AdminOrClient');
        $user = Auth::user();
        $userProfile = $user->userProfile;
        

        // Load role-specific dashboard views
        if ($user->role === 'admin') {
            return view('admin.userProfile.show', compact('userProfile'));
        } elseif ($user->role === 'client') {
            return view('client.userProfile.show', compact('userProfile'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create()
    {
        Gate::authorize('AdminOrClient'); 
        $user = Auth::user();
        if($user->role ==='admin'){
            return view('admin.userProfile.create');
        }elseif($user->role === 'client'){
            return view('client.userProfile.create');
        }else{
            abort(403, 'Unauthorized Action');
        } 
       
    }

    public function edit($id)
    {
        Gate::authorize('AdminOrClient');
        $user = Auth::user();
        $userProfile = $user->userProfile->findOrFail($id);
        if($user->role ==='admin'){
            return view('admin.userProfile.create', compact('userProfile'));
        }elseif($user->role === 'client'){
            return view('client.userProfile.create', compact('userProfile'));
        }else{
            abort(403, 'Unauthorized Action');
        } 
    }

    public function store(Request $request, $id = null)
    {
        $request->validate([
            'fullname' => 'required|string',
            'phone' => 'required|string|max:16',
            'address' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:Male,Female',
            'DOB' => ['required', 'date',
                function ($attribute, $value, $fail) {
                    $eighteenYearsAgo = Carbon::now()->subYears(18);
                    if (Carbon::parse($value)->isAfter($eighteenYearsAgo)) {
                        $fail('The ' . $attribute . ' must be a date before ' . $eighteenYearsAgo->format('Y-m-d'));
                    }
                },
            ],
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
