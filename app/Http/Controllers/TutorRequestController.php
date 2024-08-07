<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TutorRequestController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pendingRequests = TutorRequest::where('user_id', $userId)
                            ->where('status', 'Pending')
                            ->get();
        $activeRequests = TutorRequest::where('user_id', $userId)
                            ->where('status', 'Assigned')
                            ->get();
        
        return view('lessons.index', compact('pendingRequests','activeRequests'));
    }

    public function show($id)
    {
        $tutorRequest = TutorRequest::findOrFail($id);
        return view('lessons.show', compact('tutorRequest'));
    }

    public function create()
    {
        return view('lessons.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string',
            'days_times' => 'required|string',
            'subjects' => 'required|string',
            'learners' => 'required|string',
            'sessions' => 'required|string',
            'duration' => 'required|string',
            'tutor_gender' => 'required|in:Male,Female,Any',            
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'sometimes|in:Pending,Assigned',
            'amount' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $tutorRequestData = $request->all();
        $tutorRequestData['user_id'] = Auth::user()->id;

        TutorRequest::create($tutorRequestData);

        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully');
    }

    public function edit($id)
    {
        $tutorRequest = TutorRequest::findOrFail($id);
        return view('lessons.edit', compact('tutorRequest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string',
            'days_times' => 'required|string',
            'subjects' => 'required|string',
            'learners' => 'required|string',
            'sessions' => 'required|string',
            'duration' => 'required|string',
            'tutor_gender' => 'required|in:Male,Female,Any',
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'required|in:Assigned,Pending',
            'amount' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $tutorRequestData = $request->all();

        $tutorRequest = TutorRequest::findOrFail($id);
        $tutorRequest->update($tutorRequestData);

        return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully');
    }

    public function destroy($id)
    {
        Gate::authorize('admin');

        $tutorRequest = TutorRequest::findOrFail($id);
        $tutorRequest->delete();

        return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully');
    }

    public function allLessons()
    {
        Gate::authorize('Admin');

        $tutorRequest = TutorRequest::with('user')->orderBy('user_id')->get();
        return view('lessons.all_lessons', compact('lessons'));
    }
}
