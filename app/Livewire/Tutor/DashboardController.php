<?php

namespace App\Livewire\Tutor;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('MephEd - Tutor dashboard')]
class DashboardController extends Component
{
    public $mainPage = '';
    public $uploadVideo;
    public $tutorVideo;
    public $createProfile;

    #[On('close')]
    public function close(){
        $this->createProfile = false;
    }

    #[On('closeModal')]
    public function closeVideo(){
        $this->tutorVideo = false;
    }
    
    #[Layout('layouts.apps')]
    public function render()
    {
        $user = Auth::user();
        $tutorProfile = Auth::user()->tutorProfile;
        $bookings = Booking::where('tutor_id', $user->id)->get();
        $ongoingBookings = Booking::where('tutor_id', $user->id)->where('status', 'Active')->get();
        $completedBookings = Booking::where('tutor_id', $user->id)->where('status', 'Completed')->get();
        $closedBookings = Booking::where('tutor_id', $user->id)->where('status', 'Closed')->get();
        $pendingPayments = Payment::where('tutor_id', $user->id)->where('status', 'Pending')->count();
        $earnedPayments = Payment::where('tutor_id', $user->id)->where('status', 'Earned')->count();
        $completedPayments = Payment::where('tutor_id', $user->id)->where('status', 'Paid')->count();
        

        return view('livewire.tutor.dashboard-controller', compact('pendingPayments', 'earnedPayments', 'completedPayments', 'tutorProfile', 'user', 'ongoingBookings', 'completedBookings', 'closedBookings'));
    }
}