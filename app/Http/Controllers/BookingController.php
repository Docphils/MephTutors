<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if(Gate::allows('Admin'))
        {
            $bookings = Booking::all();
        }else
        {
            $bookings = Booking::where('user_id', $user->id)->get();
        }

        return view('bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('view', $booking);

        return view('bookings.show', compact('booking'));
    }

    public function create()
    {
        Gate::authorize('Admin');
        $clients = User::where('role', 'client')->get();
        $tutors = User::where('role', 'tutor')->get();
        $lessons = Lesson::where('status', 'Pending')->get();
        return view('bookings.create', compact('clients', 'tutors', 'lessons'));
    }

    public function edit($id)
    {
        Gate::authorize('Admin');
        $clients = User::where('role', 'client')->get();
        $tutors = User::where('role', 'tutor')->get();
        $lessons = Lesson::where('status', 'Pending')->get();
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);

        return view('bookings.edit', compact('booking', 'clients', 'tutors', 'lessons'));
    }

    public function store(Request $request)
    {
        Gate::authorize('Admin');

        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'start_date' => 'required|date',
            'location' => 'required|string',
            'days_times' => 'required|string',
            'subjects' => 'required|string',
            'learners' => 'required|string',
            'sessions' => 'required|integer',
            'duration' => 'required|string',
            'tutorGender' => 'required|in:Male,Female,Any',
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'required|in:Active,Completed,Closed',
            'classes' => 'required|string',
            'client_id' => 'required|exists:users,id',
            'tutor_id' => 'required|exists:users,id',
        ]);
        dd($request);
        $bookingData = $request->all();
        $bookingData['user_id'] = Auth::user()->id;

        Booking::create($bookingData);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);

        $request->validate([
            'lesson_id' => 'sometimes|exists:lessons,id',
            'start_date' => 'sometimes|date',
            'location' => 'sometimes|string',
            'days_times' => 'sometimes|string',
            'subjects' => 'sometimes|string',
            'learners' => 'sometimes|string',
            'sessions' => 'sometimes|integer',
            'duration' => 'sometimes|string',
            'tutorGender' => 'sometimes|in:Male,Female,Any',
            'curriculum' => 'sometimes|in:British,French,Nigerian,Blended',
            'status' => 'sometimes|in:Assigned,Cancelled,Pending,Completed',
            'classes' => 'sometimes|string',
            'client_id' => 'sometimes|exists:users,id',
            'tutor_id' => 'sometimes|exists:users,id',
            'tutorRemarks' => 'nullable|string',
            'clientRemarks' => 'nullable|string',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        Gate::authorize('Admin');

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully');
    }

    public function addTutorRemarks(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        Gate::authorize('Tutor');

        $request->validate([
            'tutorRemarks' => 'required|string',
        ]);

        $booking->update([
            'tutorRemarks' => $request->tutorRemarks,
            'status' => 'Completed'
        ]);

        return redirect()->route('bookings.index')->with('success', 'Remarks added successfully');
    }


    //Client's Bookings
    public function clientBookings(Request $request)
        {
            $user = Auth::user();
            Gate::authorize('Client');

            // Retrieve bookings for the authenticated user
            $closedBookings = Booking::where('client_id', $user->id)
                                    ->whereIn('status', ['Completed', 'Cancelled'])
                                    ->get();

            $pendingBookings = Booking::where('client_id', $user->id)
                                    ->where('status', 'Pending')
                                    ->get();

            $activeBookings = Booking::where('client_id', $user->id)
                                    ->where('status', 'Assigned')
                                    ->get();

            return view('client.bookings.index', compact('closedBookings', 'pendingBookings', 'activeBookings'));
        }


    public function addClientRemarks(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        Gate::authorize('Client');

        $request->validate([
            'clientRemarks' => 'required|string',
        ]);

        $booking->update([
            'clientRemarks' => $request->clientRemarks
        ]);

        return redirect()->route('bookings.index')->with('success', 'Remarks added successfully');
    }

    public function allBookings()
    {
        Gate::authorize('Admin');

        $bookings = Booking::orderBy('user_id')->get();
        return view('bookings.all', compact('bookings'));
    }
}
