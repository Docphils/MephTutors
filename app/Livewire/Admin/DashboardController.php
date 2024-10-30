<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Crm;
use App\Models\Payment;
use App\Models\TutorRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Component
{
    public $Main = '';



    public function render()
    {
        $users = User::all();
        $tutors = User::where('role', 'tutor')->get();
        $clients = User::where('role', 'client')->get();
        $administrators = User::where('role', 'admin')->get();
        $user = Auth::user();
        $userProfile = $user->userProfile;
        $bookings = Booking::all();
        $tutorRequests = TutorRequest::all();
        $pendingRequests = TutorRequest::where('status', 'Pending')->get();
        $cancelledRequests = TutorRequest::where('status', 'Cancelled')->get();
        $assignedRequests = TutorRequest::where('status', 'Assigned')->get();
        $activeBookings = Booking::where('status', 'Active')->with('tutor')->get();
        $completedBookings = Booking::where('status', 'Completed')->with('tutor')->get();
        $closedBookings = Booking::where('status', 'Closed')->with('tutor')->get();
        $adjustBookings = Booking::where('status', 'Adjust')->with('tutor')->get();
        $declinedBookings = Booking::where('status', 'Declined')->with('tutor')->get();
        $pendingBookings = Booking::where('status', 'Pending')->with('tutor')->get();
        $acceptedBookings = Booking::where('status', 'Accepted')->with('tutor')->get();
        $newCRM = Crm::where('status', 'Pending');
        $ongoingCRM = Crm::where('status', 'Ongoing');
        $closedCRM = Crm::where('status', 'Closed');
        $payments = Payment::all();
        $earnedPayments = Payment::where('status', 'Earned')->get();

        return view('livewire.admin.dashboard-controller', compact('newCRM', 'ongoingCRM', 'closedCRM','userProfile', 'user', 'users', 'tutors', 'clients', 'administrators', 'tutorRequests', 'bookings', 'activeBookings', 'completedBookings', 'closedBookings', 'adjustBookings', 'acceptedBookings', 'declinedBookings', 'pendingBookings', 'payments', 'earnedPayments'));
    }
}
