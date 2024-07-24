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
        $lessons = Lesson::where('user_id', $userId)->get();
        return view('lessons.index', compact('lessons'));
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string',
            'days_times' => 'required|string',
            'subjects' => 'required|string',
            'learners' => 'required|string',
            'sessions' => 'required|string',
            'duration' => 'required|string',
            'tutor' => 'required|string',
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'required|in:Active,Completed,Closed',
            'amount' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $lessonData = $request->all();
        $lessonData['user_id'] = Auth::id();

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
            'tutor' => 'required|string',
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'required|in:Active,Completed,Closed',
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
        Gate::authorize('admin');

        $lessons = Lesson::with('user')->orderBy('user_id')->get();
        return view('lessons.all_lessons', compact('lessons'));
    }
}
