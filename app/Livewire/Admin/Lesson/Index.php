<?php

namespace App\Livewire\Admin\Lesson;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    use WithPagination;

    public $status = null;
    public $selectedBooking = null;
    public $showModal = false;
    public $deleteModal = false;

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

    public function openDeleteModal($id)
    {
        $this->selectedBooking = Booking::findOrFail($id);
        $this->deleteModal = true;
    }

    public function deleteBooking()
    {
        $booking = Booking::findOrFail($this->selectedBooking->id);
        $booking->delete();

        $this->deleteModal = false;
        $this->mount();
        
    }

    public function render()
    {
        $bookings = Booking::latest()->paginate(10);
        $pending = Booking::where('status', 'Pending')->paginate(10);
        $adjust = Booking::where('status', 'Adjust')->paginate(10);
        $accepted = Booking::where('status', 'Accepted')->paginate(10);
        $active = Booking::where('status', 'Active')->paginate(10);
        $completed = Booking::where('status', 'Completed')->paginate(10);
        $declined = Booking::where('status', 'Declined')->paginate(10);
        $closed = Booking::where('status', 'Closed')->paginate(10);


        return view('livewire.admin.lesson.index', compact('bookings', 'pending', 'adjust', 'accepted', 'active', 'completed', 'declined', 'closed'));
    }
}


