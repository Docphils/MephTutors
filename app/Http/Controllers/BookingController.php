<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\TutorRequest;
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
        $tutorRequests = TutorRequest::where('status', 'Pending')->get();
        return view('bookings.create', compact('clients', 'tutors', 'tutorRequests'));
    }

    public function edit($id)
    {
        Gate::authorize('Admin');
        $clients = User::where('role', 'client')->get();
        $tutors = User::where('role', 'tutor')->get();
        $tutorRequests = TutorRequest::whereIn('status', ['Pending', 'Accepted'])->get();
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);

        return view('bookings.edit', compact('booking', 'clients', 'tutors', 'tutorRequests'));
    }

    //Store  Method
    public function store(Request $request)
    {
        Gate::authorize('Admin');

        $request->validate([
            'tutorRequest_id' => 'required|exists:tutorRequest,id',
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
            'status' => 'required|in:Pending,Accepted,Active,Completed,Closed',
            'paymentStatus' => 'required|in:Pending,Paid,Confirmed',
            'paymentEvidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'amount' => 'required|numeric',
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

        $newBooking = Booking::create($bookingData);

        // Create payment with 70% of the booking amount
        Payment::create([
            'tutor_id' => $newBooking->tutor_id,
            'booking_id' => $newBooking->id,
            'amount' => $newBooking->amount * 0.7,
            'status' => 'Pending', // Default status
        ]);

            return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
        }

    //Update Method
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('update', $booking);

        $request->validate([
            'tutorRequest_id' => 'sometimes|exists:tutorRequest,id',
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
            'status' => 'sometimes|in:Pending,Accepted,Active,Completed,Closed',
            'classes' => 'sometimes|string',
            'amount' => 'sometimes|string',
            'paymentStatus' => 'sometimes|in:Pending,Paid,Confirmed',
            'paymentEvidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'client_id' => 'sometimes|exists:users,id',
            'tutor_id' => 'sometimes|exists:users,id',
            'tutorRemarks' => 'sometimes|string',
            'clientAcceptanceRemarks' => 'sometimes|string',
            'clientApprovalRemarks' => 'sometimes|string',
        ]);

        $bookingData = $request->except('paymentEvidence');

        if ($request->hasFile('paymentEvidence')) {
            $file = $request->file('paymentEvidence');
            $filePath = $file->store('payment_evidences', 'public'); // Store the file in the 'public/payment_evidences' directory
            $bookingData['paymentEvidence'] = $filePath; // Save the file path to the database
        }

        $booking->update($bookingData);

        // Update the payment
        $payment = Payment::where('booking_id', $booking->id)->first();
        if ($payment) {
            $payment->update([
                'tutor_id' => $booking->tutor_id,
                'amount' => $booking->amount * 0.7,
            ]);
        }

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
            'status' => 'in:Completed'
        ]);

        $booking->update([
            'tutorRemarks' => $request->tutorRemarks,
            'status' => $request->status,
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

            $acceptedBookings = Booking::where('client_id', $user->id)
                                    ->where('status', 'Accepted')
                                    ->with('tutor')
                                    ->get();
            $pendingBookings = Booking::where('client_id', $user->id)
                                    ->where('status', 'Pending')
                                    ->with('tutor')
                                    ->get();

            return view('client.lessons', compact('closedBookings', 'completedBookings', 'activeBookings', 'acceptedBookings', 'pendingBookings'));
        }


    public function clientAcceptanceRemarks(Request $request, $id)
        {
            $booking = Booking::findOrFail($id);
            Gate::authorize('Client');

            $request->validate([
                'clientAcceptanceRemarks' => 'required|string',
                'status' => 'required|in:Adjust,Accepted',
                'paymentEvidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            ]);

            $bookingData = $request->except('paymentEvidence');

            if ($request->hasFile('paymentEvidence')) {
                $file = $request->file('paymentEvidence');
                $filePath = $file->store('payment_evidences', 'public'); // Store the file in the 'public/payment_evidences' directory
                $bookingData['paymentEvidence'] = $filePath; // Save the file path to the database
            }
    
            $booking->update($bookingData);

            return redirect()->route('client.lessons')->with('success', 'Remarks updated successfully');
        }

    public function clientApprovalRemarks(Request $request, $id)
        {
            $booking = Booking::findOrFail($id);
            Gate::authorize('Client');

            $request->validate([
                'clientApprovalRemarks' => 'required|string',
                'status' => 'required|in:Declined,Closed',
            ]);

            $booking->update([
                'clientApprovalRemarks' => $request->clientAppovalRemarks,
                'status' => $request->status
            ]);

            return redirect()->route('client.lessons')->with('success', 'Remarks added successfully');
        }

    public function allBookings()
        {
            Gate::authorize('Admin');

            $clients = User::where('role', 'client')->get();
            $tutors = User::where('role', 'tutor')->get();
        
            $clientsBookings = $clients->bookings;
            $tutorsBookings = $tutors->bookings;

            return view('bookings.all', compact('clientsBookings', 'tutorsBookings'));
        }
}
