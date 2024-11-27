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
use Illuminate\Support\Facades\Storage;
use App\Mail\LessonAssigned;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class BookingController extends Controller
{
    public function index()
    {
        Gate::authorize('Admin');
            

        return view('admin.lessons.index');
    }


  

    //Update Method
    public function update(Request $request, $id)
    { 
        $booking = Booking::findOrFail($id);
        Gate::authorize('Admin');
        $request->validate([
            'tutorRequest_id' => 'sometimes|exists:tutor_requests,id',
            'start_date' => 'sometimes|date|after_or_equal:today',
            'end_date' => 'sometimes|date|after:start_date',
            'location' => 'sometimes|string',
            'days_times' => 'sometimes|string',
            'subjects' => 'sometimes|string',
            'learners' => 'sometimes|string',
            'sessions' => 'sometimes|numeric',
            'duration' => 'sometimes|string',
            'tutorGender' => 'sometimes|in:Male,Female,Any',
            'curriculum' => 'sometimes|in:British,French,Nigerian,Blended',
            'status' => 'sometimes|in:Pending,Adjust,Accepted,Active,Completed,Declined,Closed',
            'classes' => 'sometimes|string',
            'amount' => 'sometimes|numeric',
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
        
            // Check if the file object is not null
            if ($file) {
                // Store the file using the Storage facade
                $filePath = Storage::disk('public')->put('payment_evidences', $file);
                $bookingData['paymentEvidence'] = $filePath;
            }
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

        return redirect()->route('lessons.index')->with('success', 'LEsson updated successfully');
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
            Gate::authorize('Client');

            return view('client.lessons.index');
        }

        
}
