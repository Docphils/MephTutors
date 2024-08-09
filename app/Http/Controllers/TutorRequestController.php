<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TutorRequestController extends Controller
{

    //Admin Index
    public function index()
    {
        Gate::authorize('Admin');

        $tutorRequests = TutorRequest::with('user')->orderBy('user_id')->get();
        return view('admin.tutorRequests.index', compact('tutorRequests'));
    }

    //Client Index
    public function clientIndex()
    {
        Gate::authorize('Client');
        $userId = Auth::id();
        $pendingRequests = TutorRequest::where('user_id', $userId)
                            ->where('status', 'Pending')
                            ->get();

        $assignedRequests = TutorRequest::where('user_id', $userId)
                            ->where('status', 'Cancelled')
                            ->get();
        
        return view('client.tutorRequests.index', compact('pendingRequests','assignedRequests'));
    }

    //Admin Show
    public function show($id)
    {
        Gate::authorize('Admin');
        $tutorRequest = TutorRequest::findOrFail($id);
        return view('admin.tutorRequests.show', compact('tutorRequest'));
    }

    //Client Show
    public function clientShow($id)
    {
        Gate::authorize('Client');
        $tutorRequest = TutorRequest::findOrFail($id);
        return view('client.tutorRequests.show', compact('tutorRequest'));
    }

    //Client Create
    public function create()
    {
        Gate::authorize('Client');
        return view('client.tutorRequests.create');
    }

    //Client Store
    public function store(Request $request)
    {
        Gate::authorize('Client');   
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
            'status' => 'sometimes|in:Pending,Cancelled,Assigned',
            'amount' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $tutorRequestData = $request->all();
        $tutorRequestData['user_id'] = Auth::user()->id;

        TutorRequest::create($tutorRequestData);

        return redirect()->route('client.tutorRequests.index')->with('success', 'Request submitted successfully');
    }

    //Admin Edit
    public function edit($id)
    {
        Gate::authorize('Admin');
        $tutorRequest = TutorRequest::findOrFail($id);
        return view('admin.tutorRequests.edit', compact('tutorRequest'));
    }

    //Client Edit
    public function clientEdit($id)
    {
        Gate::authorize('Client');
        $tutorRequest = TutorRequest::findOrFail($id);
        return view('client.tutorRequests.edit', compact('tutorRequest'));
    }

    //Admin and Client Update
    public function update(Request $request, $id)
    {
        Gate::authorize('AdminOrClient');
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
            'status' => 'required|in:Assigned,Pending,Cancelled',
            'amount' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $tutorRequestData = $request->all();

        $tutorRequest = TutorRequest::findOrFail($id);
        $tutorRequest->update($tutorRequestData);

        return redirect()->route('client.tutorRequests.show', $tutorRequest->id)->with('success', 'Request updated successfully');
    }

    public function destroy($id)
    {
        Gate::authorize('Admin');

        $tutorRequest = TutorRequest::findOrFail($id);
        $tutorRequest->delete();

        return redirect()->route('admin.tutorRequests.index')->with('success', 'Request deleted successfully');
    }

   
}
