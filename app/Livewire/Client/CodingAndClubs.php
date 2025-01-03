<?php

namespace App\Livewire\Client;

use App\Mail\ClubRequestEmail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Crm;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Attributes\Title;


#[Title('Club Request | MephEd')]
class CodingAndClubs extends Component
{
    use WithPagination;

    public $selectedRequest;
    public $start_date, $state, $full_address, $learnersGrade, $learnersNumber, $daysPerWeek, $days, $duration;
    public $status, $school_name, $school_address, $club_type, $remarks;
    public $makeRequest;
    public $request_type = "club";

      protected  $rules = [
            'start_date' => 'required|date|after_or_equal:today',
            'state' => 'required|in:Abia,Adamawa,AkwaIbom,Anambra,Bauchi,Bayelsa,Benue,Borno,CrossRiver,Delta,Ebonyi,Edo,Enugu,Gombe,Jigawa,Ekiti,Imo,Kaduna,Kano,Katsina,Kebbi,Kogi,Kwara,Lagos,Nasarawa,Niger,Ogun,Ondo,Osun,Oyo,Plateau,Rivers,Sokoto,Taraba,Yobe,Zamfara,FCT',
            'full_address' => 'required|string',
            'learnersGrade' => 'required|in:under_12,teen,adult',
            'learnersNumber' => 'required|integer',
            'daysPerWeek' => 'required|integer|max:7',
            'days' => 'required|string',
            'duration' => 'required|string',
            'request_type' => 'required|in:coding_tutor,club',
            'school_name' => 'required|string',
            'school_address' => 'required|string',
            'club_type' => 'required|in:Coding,Music,Chess,STEM,Taekwando,Others',
            'remarks' => 'nullable|string',
        ];

        
    private function resetForm(){
        $this->reset(['school_name', 'school_address', 'club_type', 'start_date','state', 'full_address', 'learnersGrade', 'learnersNumber','daysPerWeek', 'days', 'duration', 'request_type', 'remarks']);
    }

    public function submit()
    {
        Gate::authorize('Client');

        $this->validate();

        // Prepare data for saving
        $crmData = [
            'start_date' => $this->start_date,
            'state' => $this->state,
            'full_address' => $this->full_address,
            'learnersGrade' => $this->learnersGrade,
            'learnersNumber' => $this->learnersNumber,
            'daysPerWeek' => $this->daysPerWeek,
            'days' => $this->days,
            'duration' => $this->duration,
            'request_type' => $this->request_type,
            'school_name' => $this->school_name,
            'school_address' => $this->school_address,
            'club_type' => $this->club_type,
            'remarks' => $this->remarks,
            'user_id' => Auth::id()
        ];

        // Save CRM request
        $clubRequest = Crm::create($crmData);

        $clubRequest = $clubRequest->refresh()->load('user.userProfile');

        
        try{
            Mail::to('admin@mephed.ng')->send(new ClubRequestEmail($clubRequest));
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());

            session()->flash('success', 'Request submitted successfully (but notification was not sent). Please contact our support team');
        }
        session()->flash('success', 'Request Submitted Successfully');

        $this->resetForm();
        $this->makeRequest = null;
    }

    #[Layout('layouts.apps')]
    public function render()
    {
        $clubRequests = Crm::where('request_type', 'club')->where('user_id', Auth::id())->latest()->paginate(5);

        return view('livewire.client.coding-and-clubs', compact('clubRequests'));
    }

    public function show($requestId)
    {
        // Find the request by its ID
        $this->selectedRequest = Crm::where('id', $requestId)
            ->where('user_id', Auth::id())
            ->first();
    }

    public function close()
    {
        $this->selectedRequest = null;
    }
}
