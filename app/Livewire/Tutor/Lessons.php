<?php

namespace App\Livewire\Tutor;


use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Lessons extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $activeTab = '';
    public $showModal = false; 
    public $selectedLesson;
    public $tutorRemarks, $status;

    public $showCompletedModal = false;
   
    // Set the active tab
    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    // Show the selected lesson in the modal
    public function showLesson($id)
    {
        $this->selectedLesson = Booking::find($id); 
        $this->showModal = true;
    } 

    // Open Completed Modal
    public function editCompleted($id)
    {
        $this->selectedLesson = Booking::findOrFail($id);
        Gate::authorize('Tutor');

        // Ensure the booking status is 'Completed' before showing the approval modal
        if ($this->selectedLesson->status !== 'Active') {
            session()->flash('error', 'You can only edit completion remarks for active lessons.');
            return;
        }

        $this->resetFields();
        $this->showCompletedModal = true;
    }

   

    // Tutor Completed Remarks
    public function submitCompleted()
    {
        Gate::authorize('Tutor');

        // Ensure the status of the booking is still 'Active' before updating
        if ($this->selectedLesson->status !== 'Active') {
            session()->flash('error', 'You cannot submit approval remarks for lessons that are not active.');
            return;
        }

        $this->validate([
            'tutorRemarks' => 'required|string',
            'status' => 'required|in:Completed',
        ]);

        $this->selectedLesson->update([
            'tutorRemarks' => $this->tutorRemarks,
            'status' => $this->status
        ]);

        $this->resetFields();
        $this->showCompletedModal = false;

        session()->flash('success', 'Remarks added successfully');
    }

    // Reset fields
    public function resetFields()
    {
        $this->tutorRemarks = '';
        $this->status = '';
    }

    
    public function getLessons()
    {
        $user = Auth::user();
        Gate::authorize('Tutor');

        // Retrieve bookings for the authenticated user based on the active tab
        switch ($this->activeTab) {
            case 'Closed Lessons':
                return Booking::where('tutor_id', $user->id)->where('status', 'Closed')->paginate(10);
            case 'Completed Lessons':
                return Booking::where('tutor_id', $user->id)->where('status', 'Completed')->paginate(10);
            case 'Active Lessons':
                return Booking::where('tutor_id', $user->id)->where('status', 'Active')->paginate(10);
            case 'Accepted Lessons':
            default:
                return Booking::where('tutor_id', $user->id)->paginate(10); 
        }
    }

    public function render()
    {
        return view('livewire.tutor.lessons', [
            'lessons' => $this->getLessons(),
        ]);
    }}
