<?php

namespace App\Livewire\Admin\CRM;

use App\Mail\UpdatedCodingOrClubEmail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Crm;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $this->selectedRequest = Crm::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->deleteModal = false;
        $this->editModal = false;
        $this->status = null;
    }

    public function openDeleteModal($id)
    {
        $this->selectedRequest = Crm::findOrFail($id);
        $this->deleteModal = true;
    }

    public function deleteRequest()
    {
        $request = Crm::findOrFail($this->selectedRequest->id);
        $request->delete();

        $this->deleteModal = false;
        $this->resetPage(); 
        $this->selectedRequest = null;
        
    }

    public function openEditModal($id)
    {
        $this->selectedRequest = Crm::findOrFail($id);
        $this->status = $this->selectedRequest->status; 
        $this->editModal = true;
    }

    public function updateRequest()
    {
        $this->validate([
            'status' => 'required|in:Pending,Ongoing,Closed,Cancelled',
        ]);

        $tutorRequest = Crm::findOrFail($this->selectedRequest->id);
        $tutorRequest->update([
            'status' => $this->status,
        ]);

        $updatedRequest = $tutorRequest->refresh()->load('user.userProfile');

        try{
            Mail::to($updatedRequest->user->email)->send(new UpdatedCodingOrClubEmail($updatedRequest));
            session()->flash('success', 'Request status changed successfully');
        } catch (\Exception $e) {;
            Log::error('Mail sending failed: ' . $e->getMessage());

            session()->flash('success', 'Request submitted successfully (but notification was not sent). Please contact our support team');
        }

        $this->editModal = false;
        $this->resetPage(); 
        $this->selectedRequest = null;
    }

    public function render()
    {
        $query = Crm::query();


        if ($this->search) {
            $query->where('state', 'like', '%' . $this->search . '%')
                  ->orWhere('start_date', 'like', '%' . $this->search . '%')
                  ->orWhere('user_id', 'like', '%' . $this->search . '%')
                  ->orWhere('class_type', 'like', '%' . $this->search . '%');
        }

        $queryRequests = $query->latest()->paginate(20);

        $tutorRequests = crm::latest()->paginate(20);
        $pending = crm::where('status', 'Pending')->paginate(20);
        $ongoing = crm::where('status', 'Ongoing')->paginate(20);
        $cancelled = crm::where('status', 'Cancelled')->paginate(20);
        $closed = crm::where('status', 'Closed')->paginate(20);


        return view('livewire.admin.c-r-m.index', compact('queryRequests', 'tutorRequests', 'pending', 'ongoing', 'closed', 'cancelled'));
    }
}
