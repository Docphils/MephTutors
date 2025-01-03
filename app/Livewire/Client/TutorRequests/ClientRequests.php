<?php

namespace App\Livewire\Client\TutorRequests;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\TutorRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Show Request|MephEd')]
class ClientRequests extends Component
{
    public $pendingRequests;
    public $assignedRequests;

    public function mount()
    {
        Gate::authorize('Client');

        $userId = Auth::id();
        $this->pendingRequests = TutorRequest::where('user_id', $userId)
            ->where('status', 'Pending')
            ->get();

        $this->assignedRequests = TutorRequest::where('user_id', $userId)
            ->where('status', 'Assigned')
            ->get();
    }

    #[Layout('layouts.apps')]
    public function render()
    {
        return view('livewire.client.tutor-requests.client-requests', [
            'pendingRequests' => $this->pendingRequests,
            'assignedRequests' => $this->assignedRequests,
        ]);
    }
}
