<?php

namespace App\Livewire\Tutor;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class Payments extends Component
{
    use WithPagination;

    public $activeTab = '';
    public $showModal = false; 
    public $selectedPayment;


     // Set the active tab
     public function setTab($tab)
     {
         $this->activeTab = $tab;
     }


     // Show the selected lesson in the modal
    public function showPayment($id)
    {
        $this->selectedPayment = Payment::find($id); 
        $this->showModal = true;
    } 

    public function getPayments()
    {
        $user = Auth::user();
        Gate::authorize('Tutor');

        // Retrieve bookings for the authenticated user based on the active tab
        switch ($this->activeTab) {
            case 'Pending Payments':
                return Payment::where('tutor_id', $user->id)->where('status', 'Pending')->paginate(5);
            case 'Earned Payments':
                return Payment::where('tutor_id', $user->id)->where('status', 'Earned')->paginate(5);
            case 'Completed Payments':
                return Payment::where('tutor_id', $user->id)->where('status', 'Paid')->paginate(5);
            default:
                return Payment::where('tutor_id', $user->id)->paginate(5); 
        }
    }


    public function render()
    {
       
        return view('livewire.tutor.payments', [
            'payments' => $this->getPayments(),
        ]);
    }
}
