<?php

namespace App\Livewire\Admin\TutorRequests;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TutorRequest;
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    use WithPagination;

    public $status = null;
    public $selectedRequest = null;
    public $showModal = false;
    public $deleteModal = false;
    public $editModal = false;
    public $search = '';

    protected $listeners = [
        'closeModal' => 'closeModal',
        'openDeleteModal' => 'openDeleteModal',
        'deleteRequest' => 'deleteRequest'
    ];

    public function mount()
    {
        Gate::authorize('Admin');
        
    }

    public function showRequest($id)
    {
        $this->selectedRequest = TutorRequest::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->deleteModal = false;
        $this->editModal = false;
    }

    public function openDeleteModal($id)
    {
        $this->selectedRequest = TutorRequest::findOrFail($id);
        $this->deleteModal = true;
    }

    public function deleteRequest()
    {
        $request = TutorRequest::findOrFail($this->selectedRequest->id);
        $request->delete();

        $this->deleteModal = false;
        $this->resetPage(); 
        $this->selectedRequest = null;
        
    }

    public function openEditModal($id)
    {
        $this->selectedRequest = TutorRequest::findOrFail($id);
        $this->status = $this->selectedRequest->status; // Initialize the status for editing
        $this->editModal = true;
    }

    public function updateRequest()
    {
        $this->validate([
            'status' => 'required|in:Pending,Assigned,Cancelled',
        ]);

        $tutorRequest = TutorRequest::findOrFail($this->selectedRequest->id);
        $tutorRequest->update([
            'status' => $this->status,
        ]);

        $this->editModal = false;
        $this->resetPage(); // Reset pagination
        $this->selectedRequest = null;
    }

    public function render()
    {
        $query = TutorRequest::query();


        if ($this->search) {
            $query->where('location', 'like', '%' . $this->search . '%')
                  ->orWhere('start_date', 'like', '%' . $this->search . '%')
                  ->orWhere('learners', 'like', '%' . $this->search . '%')
                  ->orWhere('subjects', 'like', '%' . $this->search . '%');
        }

        $queryRequests = $query->latest()->paginate(50);

        $tutorRequests = TutorRequest::latest()->paginate(10);
        $pending = TutorRequest::where('status', 'Pending')->paginate(10);
        $assigned = TutorRequest::where('status', 'Assigned')->paginate(10);
        $cancelled = TutorRequest::where('status', 'Cancelled')->paginate(10);


        return view('livewire.admin.tutor-requests.index', compact('queryRequests', 'tutorRequests', 'pending', 'assigned', 'cancelled'));
    }
}

