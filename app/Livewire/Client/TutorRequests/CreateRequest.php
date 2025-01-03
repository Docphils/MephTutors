<?php

namespace App\Livewire\Client\TutorRequests;

use App\Models\TutorRequest;
use App\Mail\TutorRequestNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Request tutor - MephEd')] 
class CreateRequest extends Component
{
    public $start_date;
    public $end_date;
    public $location;
    public $days_times;
    public $subjects;
    public $learners;
    public $sessions;
    public $duration;
    public $tutor_gender = 'Any';
    public $curriculum = 'Nigerian';
    public $status = 'Pending';
    public $amount;
    public $remarks;

  
    public function mount(){
        Gate::authorize('Client');
    }

    public function rules()
    {
        return [
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
        ];
    }

    public function submit()
    {
        $this->validate();

        $tutorRequestData = $this->allFields();
        $tutorRequestData['user_id'] = Auth::id();

        $tutorRequest = TutorRequest::create($tutorRequestData);

        try {
            Mail::to('admin@mephed.ng')->send(new TutorRequestNotification($tutorRequest));
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            session()->flash('error', 'Request submitted, but notification failed. Please contact our support team.');
            return;
        }

        session()->flash('success', 'Request submitted successfully.');
        return redirect()->route('client.tutorRequests.index');
    }

    private function allFields()
    {
        return [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'location' => $this->location,
            'days_times' => $this->days_times,
            'subjects' => $this->subjects,
            'learners' => $this->learners,
            'sessions' => $this->sessions,
            'duration' => $this->duration,
            'tutor_gender' => $this->tutor_gender,
            'curriculum' => $this->curriculum,
            'status' => $this->status,
            'amount' => $this->amount,
            'remarks' => $this->remarks,
        ];
    }

    #[Layout('layouts.apps')]
    public function render()
    {
        return view('livewire.client.tutor-requests.create-request');
    }
}
