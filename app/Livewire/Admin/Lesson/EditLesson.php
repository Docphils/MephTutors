<?php

namespace App\Livewire\Admin\Lesson;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class EditLesson extends Component
{

    use WithFileUploads;

    public $bookingId;
    public $clients;
    public $tutors;
    public $booking;

    public $tutorRequest_id, $start_date, $location, $days_times, $subjects, $learners, $sessions, $duration, $tutorGender, $curriculum, $status, $classes, $client_id, $tutor_id, $paymentEvidence;

    public function mount($id)
    {
        Gate::authorize('Admin');

        $this->booking = Booking::findOrFail($id);
        $this->bookingId = $id;

        $this->tutorRequest_id = $this->booking->tutorRequest_id;
        $this->start_date = $this->booking->start_date;
        $this->location = $this->booking->location;
        $this->days_times = $this->booking->days_times;
        $this->subjects = $this->booking->subjects;
        $this->learners = $this->booking->learners;
        $this->sessions = $this->booking->sessions;
        $this->duration = $this->booking->duration;
        $this->tutorGender = $this->booking->tutorGender;
        $this->curriculum = $this->booking->curriculum;
        $this->status = $this->booking->status;
        $this->classes = $this->booking->classes;
        $this->client_id = $this->booking->client_id;
        $this->tutor_id = $this->booking->tutor_id;

        $this->clients = User::where('role', 'Client')->get();
        $this->tutors = User::where('role', 'Tutor')->get();
    }

    public function update()
    {
        Gate::authorize('Admin');

        $validatedData = $this->validate([
            'tutorRequest_id' => 'required|exists:tutor_requests,id',
            'start_date' => 'required|date|after_or_equal:today',
            'location' => 'required|string',
            'days_times' => 'required|string',
            'subjects' => 'required|string',
            'learners' => 'required|string',
            'sessions' => 'required|numeric',
            'duration' => 'required|string',
            'tutorGender' => 'required|in:Male,Female,Any',
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'required|in:Pending,Adjust,Accepted,Active,Completed,Declined,Closed',
            'classes' => 'required|string',
            'client_id' => 'required|exists:users,id',
            'tutor_id' => 'required|exists:users,id',
            'paymentEvidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        if ($this->paymentEvidence) {
            $validatedData['paymentEvidence'] = $this->paymentEvidence->store('payment_evidences', 'public');
        }

        $this->booking->update($validatedData);

        $payment = Payment::where('booking_id', $this->booking->id)->first();
        if ($payment) {
            $payment->update([
                'tutor_id' => $this->booking->tutor_id,
                'amount' => $this->booking->amount * 0.7,
            ]);
        }

        session()->flash('success', 'Lesson updated successfully');
        return redirect()->route('lessons.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.lesson.edit-lesson');
    }
}
