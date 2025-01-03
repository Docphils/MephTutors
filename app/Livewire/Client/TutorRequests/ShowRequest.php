<?php

namespace App\Livewire\Client\TutorRequests;

use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\TutorRequest;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Show Request|MephEd')] 
class ShowRequest extends Component
{
    public $tutorRequest;

    public function mount($id)
    {
        $this->tutorRequest = TutorRequest::findOrFail($id);
    }

    public function destroy($id)
    {
        try {
            $tutorRequest = TutorRequest::where('status', 'Pending')->findOrFail($id);
    
            $tutorRequest->delete();
    
            return redirect()->route('client.tutorRequests.index')->with('success', 'Request deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('client.tutorRequests.index')->with('error', 'Cannot delete this request as it is not in a pending state.');
        } catch (\Exception $e) {
            return redirect()->route('client.tutorRequests.index')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
    

    #[Layout('layouts.apps')]
    public function render()
    {
        return view('livewire.client.tutor-requests.show-request');
    }
}
