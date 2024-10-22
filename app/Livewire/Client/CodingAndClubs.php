<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Crm;

class CodingAndClubs extends Component
{
    public $start_date, $state, $full_address, $learnersGrade, $learnersNumber, $daysPerWeek, $days, $duration;
    public $status, $request_type, $school_name, $school_address, $languages, $class_type, $club_type, $remarks;
    public $showCodingTutorFields = false;

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
            'languages' => 'nullable|string',
            'class_type' => 'nullable|in:home_tutoring,online',
            'school_name' => 'nullable|string',
            'school_address' => 'nullable|string',
            'club_type' => 'nullable|in:Coding,Music,Chess,STEM,Taekwando,Others',
            'remarks' => 'nullable|string',
        ];

        
    public function updatedRequestType($value)
    {
        $this->showCodingTutorFields = $value === 'coding_tutor';
        $this->resetFields();
    }

    private function resetFields()
    {
        if ($this->showCodingTutorFields) {
            $this->reset(['school_name', 'school_address', 'club_type']);
        } else {
            $this->reset(['languages', 'class_type']);
        }
    }
    private function resetForm(){
        $this->reset(['school_name', 'school_address', 'club_type', 'start_date','state', 'full_address', 'languages', 'class_type', 'learnersGrade', 'learnersNumber','daysPerWeek', 'days', 'duration', 'request_type', 'remarks']);
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
            'school_name' => $this->school_name,
            'school_address' => $this->school_address,
            'club_type' => $this->club_type,
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
        return view('livewire.client.coding-and-clubs');
    }
}
