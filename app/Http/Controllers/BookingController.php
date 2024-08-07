<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lesson;
use App\Models\TutorProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        Gate::allows('Admin');
            $bookings = Booking::all();

        return view('bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);

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

    //Store  Method
    public function store(Request $request)
    {
        Gate::authorize('Admin');

        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string',
            'days_times' => 'required|string',
            'subjects' => 'required|string',
            'learners' => 'required|string',
            'sessions' => 'required|integer',
            'duration' => 'required|string',
            'tutorGender' => 'required|in:Male,Female,Any',
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'required|in:Pending,Active,Completed,Closed',
            'paymentStatus' => 'required|in:Pending,Paid',
            'paymentEvidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'amount' => 'required|string',
            'classes' => 'required|string',
            'client_id' => 'required|exists:users,id',
            'tutor_id' => 'required|exists:users,id',
        ]);

        $bookingData = $request->all();
        $bookingData['user_id'] = Auth::user()->id;

        if ($request->hasFile('paymentEvidence')) {
            $file = $request->file('paymentEvidence');
            $filePath = $file->store('payment_evidences', 'public'); // Store the file in the 'public/payment_evidences' directory
            $bookingData['paymentEvidence'] = $filePath; // Save the file path to the database
        }

        Booking::create($bookingData);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    }

    //Update Method
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);

        $request->validate([
            'lesson_id' => 'sometimes|exists:lessons,id',
            'start_date' => 'sometimes|date|after_or_equal:today',
            'end_date' => 'sometimes|date|after:start_date',
            'location' => 'sometimes|string',
            'days_times' => 'sometimes|string',
            'subjects' => 'sometimes|string',
            'learners' => 'sometimes|string',
            'sessions' => 'sometimes|integer',
            'duration' => 'sometimes|string',
            'tutorGender' => 'sometimes|in:Male,Female,Any',
            'curriculum' => 'sometimes|in:British,French,Nigerian,Blended',
            'status' => 'sometimes|in:Pending,Active,Completed,Closed',
            'classes' => 'sometimes|string',
            'amount' => 'sometimes|string',
            'paymentStatus' => 'sometimes|in:Pending,Paid',
            'paymentEvidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'client_id' => 'sometimes|exists:users,id',
            'tutor_id' => 'sometimes|exists:users,id',
            'tutorRemarks' => 'nullable|string',
            'clientRemarks' => 'nullable|string',
        ]);

        $bookingData = $request->except('paymentEvidence');

        if ($request->hasFile('paymentEvidence')) {
            $file = $request->file('paymentEvidence');
            $filePath = $file->store('payment_evidences', 'public'); // Store the file in the 'public/payment_evidences' directory
            $bookingData['paymentEvidence'] = $filePath; // Save the file path to the database
        }

        $booking->update($bookingData);

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
                                    ->where('status', 'Closed')
                                    ->with('tutor')
                                    ->get();

            $completedBookings = Booking::where('client_id', $user->id)
                                    ->where('status', 'Completed')
                                    ->with('tutor')
                                    ->get();

            $activeBookings = Booking::where('client_id', $user->id)
                                    ->where('status', 'Active')
                                    ->with('tutor')
                                    ->get();

            return view('client.lessons', compact('closedBookings', 'completedBookings', 'activeBookings'));
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

        return redirect()->route('client.lessons')->with('success', 'Remarks added successfully');
    }

    public function allBookings()
    {
        Gate::authorize('Admin');

        $bookings = Booking::orderBy('user_id')->get();
        return view('bookings.all', compact('bookings'));
    }
}
