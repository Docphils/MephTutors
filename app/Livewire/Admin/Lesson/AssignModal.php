<?php

namespace App\Livewire\Admin\Lesson;

use Livewire\Component;
use App\Models\TutorRequest;

class AssignModal extends Component
{
    public $tutorRequests;
    public $tutorRequestId = null;
    public $openModal = false;
    public $tutorRequest;

    public function modal()
    {
        $this->openModal = true; 
        $this->tutorRequests = TutorRequest::where('status', 'Pending')->get(); 

        if ($this->tutorRequestId) {
            $this->tutorRequest = TutorRequest::findOrFail($this->tutorRequestId); 

            // Redirect with tutor request data.
            return redirect()->route('bookings.create')->with(['tutorRequest' => $this->tutorRequest]);
        }
    }
    public function selectRequest($tutorRequestId){
        $this->tutorRequest = TutorRequest::findOrfail($tutorRequestId)->get();


        return redirect()->route('bookings.create')->with(['tutorRequest' => $this->tutorRequest]);
        $this->openModal = false;

    }


    public function render()
    {
        return view('livewire.admin.lesson.assign-modal');
    }
}
