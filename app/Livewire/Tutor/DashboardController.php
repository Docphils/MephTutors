<?php

namespace App\Livewire\Tutor;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Component
{
    public $mainPage = '';
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