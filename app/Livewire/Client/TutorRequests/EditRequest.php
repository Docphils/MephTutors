<?php

namespace App\Livewire\Client\TutorRequests;

use Livewire\Component;
use App\Models\TutorRequest;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Edit Request|MephEd')] 
class EditRequest extends Component
{

    public $tutorRequestId;
    public $start_date;
    public $end_date;
    public $location;
    public $days_times;
    public $subjects;
    public $learners;
    public $sessions;
    public $duration;
    public $tutor_gender;
    public $curriculum;
    public $status;
    public $amount;
    public $remarks;

    public function mount($id)
    {
        Gate::authorize('Client');
        $tutorRequest = TutorRequest::findOrFail($id);

        $this->tutorRequestId = $tutorRequest->id;
        $this->start_date = $tutorRequest->start_date;
        $this->end_date = $tutorRequest->end_date;
        $this->location = $tutorRequest->location;
        $this->days_times = $tutorRequest->days_times;
        $this->subjects = $tutorRequest->subjects;
        $this->learners = $tutorRequest->learners;
        $this->sessions = $tutorRequest->sessions;
        $this->duration = $tutorRequest->duration;
        $this->tutor_gender = $tutorRequest->tutor_gender;
        $this->curriculum = $tutorRequest->curriculum;
        $this->status = $tutorRequest->status;
        $this->amount = $tutorRequest->amount;
        $this->remarks = $tutorRequest->remarks;
    }

    public function update()
    {
        Gate::authorize('AdminOrClient');

        $this->validate([
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

        $tutorRequest = TutorRequest::findOrFail($this->tutorRequestId);
        $tutorRequest->update([
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
        ]);

        session()->flash('success', 'Request updated successfully.');

        return redirect()->route('client.tutorRequests.show', $tutorRequest->id);
    }

   

    #[Layout('layouts.apps')]
    public function render()
    {
        return view('livewire.client.tutor-requests.edit-request');
    }
}
