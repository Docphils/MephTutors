<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pendingLessons = Lesson::where('user_id', $userId)
                            ->where('status', 'Pending')
                            ->get();
        $activeLessons = Lesson::where('user_id', $userId)
                            ->where('status', 'Assigned')
                            ->get();
        $closedLessons = Lesson::where('user_id', $userId)
                            ->whereIn('status', ['Completed', 'Closed'])
                            ->paginate(6);
        
        return view('lessons.index', compact('pendingLessons','activeLessons', 'closedLessons'));
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.show', compact('lesson'));
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
            'status' => 'sometimes|in:Pending,Assigned,Completed,Closed',
            'amount' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        $lessonData = $request->all();
        $lessonData['user_id'] = Auth::user()->id;

        Lesson::create($lessonData);

        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully');
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.edit', compact('lesson'));
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
            'status' => 'required|in:Assigned,Pending,Completed,Closed',
            'amount' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $lessonData = $request->all();

        $lesson = Lesson::findOrFail($id);
        $lesson->update($lessonData);

        return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully');
    }

    public function destroy($id)
    {
        Gate::authorize('admin');

        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully');
    }

    public function allLessons()
    {
        Gate::authorize('Admin');

        $lessons = Lesson::with('user')->orderBy('user_id')->get();
        return view('lessons.all_lessons', compact('lessons'));
    }
}
