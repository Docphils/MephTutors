<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Crm;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CodingAndClubsIndex extends Component
{
    use WithPagination;

    public $selectedRequest;
    public $start_date, $state, $full_address, $learnersGrade, $learnersNumber, $daysPerWeek, $days, $duration;
    public $status, $request_type, $class_type, $languages, $remarks;

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
        'languages' => 'required|string',
        'class_type' => 'required|in:online,home_tutoring',
        'remarks' => 'nullable|string',
    ];

        
    private function resetForm(){
        $this->reset(['languages', 'class_type', 'start_date','state', 'full_address', 'learnersGrade', 'learnersNumber','daysPerWeek', 'days', 'duration', 'request_type', 'remarks']);
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
            'languages' => $this->languages,
            'class_type' => $this->class_type,
            'remarks' => $this->remarks,
            'user_id' => Auth::id()
        ];

        // Save CRM request
        Crm::create($crmData);

        session()->flash('success', 'Request Submitted Successfully');

        $this->resetForm();
    }

    public function render()
    {
        $codingRequests = Crm::where('request_type', 'coding_tutor')->where('user_id', Auth::id())->latest()->paginate(5);

        return view('livewire.client.coding-and-clubs-index', compact('codingRequests'));
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
