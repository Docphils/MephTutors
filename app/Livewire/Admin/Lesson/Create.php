<?php

namespace App\Livewire\Admin\Lesson;

use Livewire\Component;
use App\Models\User;
use App\Models\TutorRequest;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use App\Mail\LessonAssigned;
use Livewire\Attributes\Layout;

class Create extends Component
{
    use WithFileUploads;

    public $clients = [];
    public $tutors;
    public $tutorRequest;
    public $tutorRequestId;
    public $tutor_id = null;
    public $start_date, $end_date, $location, $days_times, $subjects, $learners, $sessions, $duration;
    public $tutorGender = 'Any', $curriculum = 'British', $status = 'Pending', $paymentStatus = 'Pending';
    public $classes, $amount, $client_id, $paymentEvidence;

    public function mount()
    {
        Gate::authorize('Admin');

        $this->tutorRequest = session('tutorRequest');
        if ($this->tutorRequest) {
            // Populate component properties with the tutorRequest data
            $this->tutorRequestId = $this->tutorRequest->id;
            $this->start_date = $this->tutorRequest->start_date;
            $this->end_date = $this->tutorRequest->end_date;
            $this->location = $this->tutorRequest->location;
            $this->days_times = $this->tutorRequest->days_times;
            $this->subjects = $this->tutorRequest->subjects;
            $this->learners = $this->tutorRequest->learners;
            $this->sessions = $this->tutorRequest->sessions;
            $this->duration = $this->tutorRequest->duration;
            $this->curriculum = $this->tutorRequest->curriculum;
            $this->amount = $this->tutorRequest->amount;
            $this->tutorGender = $this->tutorRequest->tutor_gender;
            $this->client_id = $this->tutorRequest->user_id;
        }
    
        // Load additional data
        $this->clients = User::where('role', 'client')->get();
        $this->tutors = User::where('role', 'tutor')->get();
        if ($this->tutors->isNotEmpty()) {
            $this->tutor_id = $this->tutors->first()->id;
          }
        
    }

    public function submit()
    {
        $this->validate([
            'tutorRequestId' => 'required|exists:tutor_requests,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string',
            'days_times' => 'required|string',
            'subjects' => 'required|string',
            'learners' => 'required|string',
            'sessions' => 'required|numeric',
            'duration' => 'required|string',
            'tutorGender' => 'required|in:Male,Female,Any',
            'curriculum' => 'required|in:British,French,Nigerian,Blended',
            'status' => 'required|in:Pending,Adjust,Accepted,Active,Completed,Declined,Closed',
            'paymentStatus' => 'required|in:Pending,Paid,Confirmed',
            'paymentEvidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'amount' => 'required|numeric',
            'classes' => 'required|string',
            'client_id' => 'required|exists:users,id',
            'tutor_id' => 'required|exists:users,id',
        ]);

        $data = [
            'tutorRequest_id' => $this->tutorRequestId,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'location' => $this->location,
            'days_times' => $this->days_times,
            'subjects' => $this->subjects,
            'learners' => $this->learners,
            'sessions' => $this->sessions,
            'duration' => $this->duration,
            'tutorGender' => $this->tutorGender,
            'curriculum' => $this->curriculum,
            'status' => $this->status,
            'paymentStatus' => $this->paymentStatus,
            'amount' => $this->amount,
            'classes' => $this->classes,
            'client_id' => $this->client_id,
            'tutor_id' => $this->tutor_id,
            'user_id' => Auth::id(),
        ];

        if ($this->paymentEvidence) {
            $data['paymentEvidence'] = $this->paymentEvidence->store('payment_evidences', 'public');
        }

        $booking = Booking::create($data);

        Payment::create([
            'tutor_id' => $booking->tutor_id,
            'booking_id' => $booking->id,
            'amount' => $booking->amount * 0.7,
            'status' => 'Pending',
        ]);

        try {
            if ($booking->client) {
                Mail::to($booking->client->email)->send(new LessonAssigned($booking));
            }
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
        }

        session()->flash('success', 'Lesson created successfully');
        return redirect()->route('lessons.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.lesson.create');
    }
}
