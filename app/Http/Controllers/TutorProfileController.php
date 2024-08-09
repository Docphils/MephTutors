<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


class TutorProfileController extends Controller
{
    public function show($id)
    {
        Gate::authorize('Tutor');

        $tutorProfile = TutorProfile::findOrFail($id);
        return view('tutor.tutorProfile.show', compact('tutorProfile'));
    }

    public function create()
    {
        Gate::authorize('Tutor');
        return view('tutor.tutorProfile.create');
    }

    public function edit($id)
    {
        Gate::authorize('Tutor');
        $tutorProfile = TutorProfile::findOrFail($id);
        return view('tutor.tutorProfile.edit', compact('tutorProfile'));
    }

    public function store(Request $request, $id = null)
    {
        Gate::authorize('Tutor');
        $request->validate([
            'phone' => 'required|numeric',
            'address' => 'required|string',
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
            'DOB' => ['required', 'date',
                function ($attribute, $value, $fail) {
                    $eighteenYearsAgo = Carbon::now()->subYears(18);
                    if (Carbon::parse($value)->isAfter($eighteenYearsAgo)) {
                        $fail('The ' . $attribute . ' must be a date before ' . $eighteenYearsAgo->format('Y-m-d'));
                    }
                },
            ],
        ]);

        $tutorProfileData = $request->except('image', 'CV');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $tutorProfileData['image'] = $imagePath;
        }

        // Handle CV upload
        if ($request->hasFile('CV')) {
            $cvPath = $request->file('CV')->store('cvs', 'public');
            $tutorProfileData['CV'] = $cvPath;
        }

        if ($id) {
            // Update existing tutor profile
            $tutorProfile = TutorProfile::findOrFail($id);
            $tutorProfile->update($tutorProfileData);
            $message = 'Tutor profile updated successfully';
        } else {
            // Create new tutor profile
            $tutorProfileData['user_id'] = Auth::id();
            $tutorProfile = TutorProfile::create($tutorProfileData);
            $message = 'Tutor profile created successfully';
        }

        return redirect()->route('tutor.tutorProfile.show')->with('success', $message);
    }

}

