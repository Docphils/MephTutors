<?php

namespace App\Livewire\Admin\Lesson;

use App\Mail\ActiveLessonEmail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    use WithPagination;

    public $status;
    public $selectedBooking = null;
    public $showModal = false;
    public $deleteModal = false;
    public $search = '';
    public $lessonStatus;

    public $showActivationModal = false;

    protected $listeners = [
        'closeModal' => 'closeModal',
        'openDeleteModal' => 'openDeleteModal',
        'deleteBooking' => 'deleteBooking'
    ];

    public function mount()
    {
        Gate::authorize('Admin');
        
    }

    public function showBooking($id)
    {
        $this->selectedBooking = Booking::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->deleteModal = false;
    }

    
    // Open Activation Modal
    public function editActivation($id)
    {
        $this->selectedBooking = Booking::findOrFail($id);

        // Ensure the booking status is 'Accepted' before showing the acceptance modal
        if ($this->selectedBooking->status !== 'Accepted') {
            session()->flash('error', 'You can only activate accepted lessons.');
            return;
        }

        $this->showActivationModal = true;
        
    }

     // Client Acceptance Remarks
     public function submitActivation()
     { 
         // Ensure the status of the booking is still 'Pending' before updating
         if ($this->selectedBooking->status !== 'Accepted') {
             session()->flash('error', 'You cannot activate lessons that have not been accepted.');
             return;
         }
         
         $this->validate([
             'lessonStatus' => 'required|in:Active',
         ]);
 
         $lessonData = [
             'status' => $this->lessonStatus
         ];
         
         $this->selectedBooking->update($lessonData);
         $activeLesson = $this->selectedBooking->refresh()->load('tutor');
 
         try {
             Mail::to($activeLesson->tutor->email)->send(new ActiveLessonEmail($activeLesson));
             session()->flash('success', 'Lesson activated successfully');
         } catch (\Exception $e) {
             Log::error('Mail sending failed: ' . $e->getMessage());
 
             session()->flash('success', 'Lesson activated successfully (but email was not sent to tutor).');
         }
         $this->selectedBooking = null;
         $this->showActivationModal = false;
         
        
     }

    public function openDeleteModal($id)
    {
        $this->selectedBooking = Booking::findOrFail($id);
        $this->deleteModal = true;
    }

    public function deleteBooking()
    {
        $booking = Booking::findOrFail($this->selectedBooking->id);
        $booking->payments()->delete();
        $booking->delete();

        $this->deleteModal = false;
        $this->resetPage(); 
        $this->selectedBooking = null;
        
    }

    public function render()
    {
        $query = Booking::query(); 


        if ($this->search) {
            $query->where('location', 'like', '%' . $this->search . '%')
                  ->orWhere('client_id', 'like', '%' . $this->search . '%')
                  ->orWhere('learners', 'like', '%' . $this->search . '%')
                  ->orWhere('tutor_id', 'like', '%' . $this->search . '%');
        }

        $queryBookings = $query->latest()->paginate(50);

        $bookings = Booking::latest()->paginate(10);
        $pending = Booking::where('status', 'Pending')->paginate(10);
        $adjust = Booking::where('status', 'Adjust')->paginate(10);
        $accepted = Booking::where('status', 'Accepted')->paginate(10);
        $active = Booking::where('status', 'Active')->paginate(10);
        $completed = Booking::where('status', 'Completed')->paginate(10);
        $declined = Booking::where('status', 'Declined')->paginate(10);
        $closed = Booking::where('status', 'Closed')->paginate(10);


        return view('livewire.admin.lesson.index', compact('queryBookings', 'bookings', 'pending', 'adjust', 'accepted', 'active', 'completed', 'declined', 'closed'));
    }
}


